<template>
    <Modal :show="show" @close="closeModal" max-width="lg">
      <div class="p-6">
        <h2 class="text-lg font-medium mb-4">{{ title }}</h2>
        
        <form @submit.prevent="submit">
          <div class="grid grid-cols-1 gap-4">
            <div v-for="field in fields" :key="field.name">
              <InputLabel :for="field.name" :value="field.label" />
              
              <!-- Select Input -->
              <select
                v-if="field.type === 'select'"
                v-model="form[field.name]"
                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                :required="field.required"
              >
                <option value="" disabled selected>Select an option</option>
                <option 
                  v-for="option in field.options" 
                  :key="option.value" 
                  :value="option.value"
                >
                  {{ option.label }}
                </option>
              </select>
              
              <!-- Textarea -->
              <textarea
                v-else-if="field.type === 'textarea'"
                v-model="form[field.name]"
                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                :required="field.required"
                :rows="field.rows || 3"
              ></textarea>
              
              <!-- Checkbox -->
              <div v-else-if="field.type === 'checkbox'" class="mt-2">
                <input
                  type="checkbox"
                  v-model="form[field.name]"
                  :id="field.name"
                  class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                >
              </div>
              
              <!-- Default Text Input -->
              <TextInput
                v-else
                :id="field.name"
                v-model="form[field.name]"
                :type="field.type || 'text'"
                class="mt-1 block w-full"
                :required="field.required"
              />
              
              <InputError class="mt-2" :message="form.errors[field.name]" />
            </div>
          </div>
  
          <div class="mt-6 flex justify-end space-x-4">
            <SecondaryButton @click="closeModal" :disabled="form.processing">
              Cancel
            </SecondaryButton>
            
            <DangerButton
              v-if="showDelete && editingId"
              type="button"
              @click="confirmDelete"
              class="mr-auto"
              :disabled="form.processing"
            >
              Delete
            </DangerButton>
            
            <PrimaryButton
              type="submit"
              :disabled="form.processing"
            >
              <span v-if="form.processing">
                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Processing...
              </span>
              <span v-else>
                {{ actionButtonText }}
              </span>
            </PrimaryButton>
          </div>
        </form>
      </div>
    </Modal>
  
    <!-- Delete Confirmation Modal -->
    <ConfirmationModal :show="showDeleteConfirmation" @close="showDeleteConfirmation = false">
      <template #title>
        Confirm Deletion
      </template>
      
      <template #content>
        Are you sure you want to delete this item? This action cannot be undone.
      </template>
      
      <template #footer>
        <SecondaryButton @click="showDeleteConfirmation = false">
          Cancel
        </SecondaryButton>
        
        <DangerButton
          class="ml-2"
          @click="deleteItem"
          :disabled="form.processing"
        >
          Delete
        </DangerButton>
      </template>
    </ConfirmationModal>
  </template>
  
  <script setup>
  import { ref, watch } from 'vue';
  import { useForm } from '@inertiajs/vue3';
  import Modal from '@/Components/Modal.vue';
  import ConfirmationModal from '@/Components/ConfirmationModal.vue';
  import InputLabel from '@/Components/InputLabel.vue';
  import TextInput from '@/Components/TextInput.vue';
  import InputError from '@/Components/InputError.vue';
  import PrimaryButton from '@/Components/PrimaryButton.vue';
  import SecondaryButton from '@/Components/SecondaryButton.vue';
  import DangerButton from '@/Components/DangerButton.vue';
  
  const props = defineProps({
    show: Boolean,
    title: String,
    fields: {
      type: Array,
      required: true,
      validator: (fields) => fields.every(f => 'name' in f && 'label' in f)
    },
    initialData: Object,
    actionButtonText: {
      type: String,
      default: 'Save'
    },
    submitRoute: String,
    method: {
      type: String,
      default: 'post'
    },
    deleteRoute: {
      type: String,
      default: null
    },
    showDelete: {
      type: Boolean,
      default: false
    }
  });
  
  const emit = defineEmits(['close', 'success', 'deleted']);
  
  const form = useForm({});
  const showDeleteConfirmation = ref(false);
  const editingId = ref(null);
  
  // Initialize form with fields
  const initializeForm = () => {
    const formData = {};
    
    props.fields.forEach(field => {
      // Handle different field types
      if (field.type === 'checkbox') {
        formData[field.name] = props.initialData?.[field.name] || false;
      } else {
        formData[field.name] = props.initialData?.[field.name] || '';
      }
    });
    
    form.defaults(formData);
    form.reset();
    
    if (props.initialData?.id) {
      editingId.value = props.initialData.id;
    }
  };
  
  // Watch for changes in initialData
  watch(() => props.initialData, initializeForm, { immediate: true });
  
  const submit = () => {
    const submitMethod = props.method === 'put' ? 'put' : 'post';
    
    form.transform(data => ({
      ...data,
      _method: submitMethod
    })).post(props.submitRoute, {
      preserveScroll: true,
      onSuccess: () => {
        emit('success');
        closeModal();
      }
    });
  };
  
  const confirmDelete = () => {
    showDeleteConfirmation.value = true;
  };
  
  const deleteItem = () => {
    if (!props.deleteRoute || !editingId.value) return;
    
    form.delete(route(props.deleteRoute, editingId.value), {
      preserveScroll: true,
      onSuccess: () => {
        emit('deleted');
        closeModal();
        showDeleteConfirmation.value = false;
      }
    });
  };
  
  const closeModal = () => {
    form.reset();
    editingId.value = null;
    emit('close');
  };
  </script>
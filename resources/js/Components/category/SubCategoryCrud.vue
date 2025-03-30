<template>
    <div>
      <button @click="openCreateModal" class="btn-primary mb-4">
        <PlusIcon class="h-4 w-4 mr-1" /> Create SubCategory
      </button>
  
      <BaseCrudModal
        :show="showCreateModal"
        title="Create New SubCategory"
        :fields="fields"
        action-button-text="Create"
        submit-route="sub-categories.store"
        @close="closeCreateModal"
        @success="$emit('refresh')"
      />
  
      <BaseCrudModal
        :show="!!editingItem"
        title="Edit SubCategory"
        :fields="fields"
        :initial-data="editingItem"
        action-button-text="Update"
        submit-route="sub-categories.update"
        method="put"
        show-delete
        delete-route="sub-categories.destroy"
        @close="editingItem = null"
        @success="$emit('refresh')"
        @deleted="$emit('refresh')"
      />
    </div>
  </template>
  
  <script setup>
  import { ref, computed } from 'vue';
  import BaseCrudModal from '../BaseCrudModal.vue';
  import { PlusIcon } from '@heroicons/vue/outline';
  
  const props = defineProps({
    categories: {
      type: Array,
      default: () => []
    }
  });
  
  const fields = computed(() => [
    { 
      name: 'name', 
      label: 'Name', 
      required: true 
    },
    { 
      name: 'category_id', 
      label: 'Category', 
      type: 'select',
      required: true,
      options: props.categories.map(category => ({
        value: category.id,
        label: category.name
      }))
    },
    { 
      name: 'description', 
      label: 'Description', 
      type: 'textarea',
      rows: 3,
      required: false 
    }
  ]);
  
  const showCreateModal = ref(false);
  const editingItem = ref(null);
  
  const openCreateModal = () => {
    showCreateModal.value = true;
  };
  
  const closeCreateModal = () => {
    showCreateModal.value = false;
  };
  
  const edit = (item) => {
    editingItem.value = item;
  };
  
  defineExpose({ edit });
  </script>
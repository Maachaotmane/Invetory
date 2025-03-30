<template>
    <div>
      <button @click="openCreateModal" class="btn-primary mb-4">
        <PlusIcon class="h-4 w-4 mr-1" /> Create Category
      </button>
  
      <BaseCrudModal
        :show="showCreateModal"
        title="Create New Category"
        :fields="fields"
        action-button-text="Create"
        submit-route="categories.store"
        @close="closeCreateModal"
        @success="$emit('refresh')"
      />
  
      <BaseCrudModal
        :show="!!editingItem"
        title="Edit Category"
        :fields="fields"
        :initial-data="editingItem"
        action-button-text="Update"
        submit-route="categories.update"
        method="put"
        show-delete
        delete-route="categories.destroy"
        @close="editingItem = null"
        @success="$emit('refresh')"
        @deleted="$emit('refresh')"
      />
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { PlusIcon } from '@heroicons/vue/outline';
  import BaseCrudModal from '../BaseCrudModal.vue';
  
  const fields = [
    { name: 'name', label: 'Name', required: true },
    { 
      name: 'x_axis', 
      label: 'X Axis', 
      type: 'select',
      options: [
        { value: 'measures', label: 'Measures' },
        { value: 'units', label: 'Units' },
        { value: 'brands', label: 'Brands' }
      ],
      required: true 
    },
    { 
      name: 'y_axis', 
      label: 'Y Axis', 
      type: 'select',
      options: [
        { value: 'measures', label: 'Measures' },
        { value: 'units', label: 'Units' },
        { value: 'brands', label: 'Brands' }
      ],
      required: true 
    }
  ];
  
  const showCreateModal = ref(false);
  const editingItem = ref(null);
  
  const openCreateModal = () => showCreateModal.value = true;
  const closeCreateModal = () => showCreateModal.value = false;
  const edit = (item) => editingItem.value = item;
  
  defineExpose({ edit });
  </script>
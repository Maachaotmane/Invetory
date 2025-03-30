<template>
    <div>
      <button @click="openCreateModal" class="btn-primary mb-4">
        Create Type
      </button>
  
      <BaseCrudModal
        :show="showCreateModal"
        title="Create New Type"
        :fields="fields"
        action-button-text="Create"
        submit-route="types.store"
        @close="closeCreateModal"
        @success="$emit('refresh')"
      />
  
      <BaseCrudModal
        :show="!!editingItem"
        title="Edit Type"
        :fields="fields"
        :initial-data="editingItem"
        action-button-text="Update"
        submit-route="types.update"
        method="put"
        @close="editingItem = null"
        @success="$emit('refresh')"
      />
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import BaseCrudModal from '../BaseCrudModal.vue';
  
  const fields = [
    { name: 'name', label: 'Name', required: true },
    { name: 'category_id', label: 'Category ID', type: 'number', required: true }
  ];
  
  const showCreateModal = ref(false);
  const editingItem = ref(null);
  
  const openCreateModal = () => showCreateModal.value = true;
  const closeCreateModal = () => showCreateModal.value = false;
  const edit = (item) => editingItem.value = item;
  
  defineExpose({ edit });
  </script>
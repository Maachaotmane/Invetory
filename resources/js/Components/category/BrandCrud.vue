<template>
    <div>
      <button @click="openCreateModal" class="btn-primary mb-4">
        Create Brand
      </button>
  
      <BaseCrudModal
        :show="showCreateModal"
        title="Create New Brand"
        :fields="fields"
        action-button-text="Create"
        submit-route="brands.store"
        @close="closeCreateModal"
        @success="$emit('refresh')"
      />
  
      <BaseCrudModal
        :show="!!editingItem"
        title="Edit Brand"
        :fields="fields"
        :initial-data="editingItem"
        action-button-text="Update"
        submit-route="brands.update"
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
    { name: 'description', label: 'Description', required: false }
  ];
  
  const showCreateModal = ref(false);
  const editingItem = ref(null);
  
  const openCreateModal = () => showCreateModal.value = true;
  const closeCreateModal = () => showCreateModal.value = false;
  const edit = (item) => editingItem.value = item;
  
  defineExpose({ edit });
  </script>
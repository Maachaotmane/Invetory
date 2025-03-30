<template>
    <div>
      <button @click="openCreateModal" class="btn-primary mb-4">
        Create Unit
      </button>
  
      <BaseCrudModal
        :show="showCreateModal"
        title="Create New Unit"
        :fields="fields"
        action-button-text="Create"
        submit-route="units.store"
        @close="closeCreateModal"
        @success="$emit('refresh')"
      />
  
      <BaseCrudModal
        :show="!!editingItem"
        title="Edit Unit"
        :fields="fields"
        :initial-data="editingItem"
        action-button-text="Update"
        submit-route="units.update"
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
    { name: 'abbreviation', label: 'Abbreviation', required: false }
  ];
  
  const showCreateModal = ref(false);
  const editingItem = ref(null);
  
  const openCreateModal = () => showCreateModal.value = true;
  const closeCreateModal = () => showCreateModal.value = false;
  const edit = (item) => editingItem.value = item;
  
  defineExpose({ edit });
  </script>
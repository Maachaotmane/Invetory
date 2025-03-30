<template>
    <div>
      <button @click="openCreateModal" class="btn-primary mb-4">
        Create Measure
      </button>
  
      <BaseCrudModal
        :show="showCreateModal"
        title="Create New Measure"
        :fields="fields"
        action-button-text="Create"
        submit-route="measures.store"
        @close="closeCreateModal"
        @success="$emit('refresh')"
      />
  
      <BaseCrudModal
        :show="!!editingItem"
        title="Edit Measure"
        :fields="fields"
        :initial-data="editingItem"
        action-button-text="Update"
        submit-route="measures.update"
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
    { name: 'symbol', label: 'Symbol', required: false }
  ];
  
  const showCreateModal = ref(false);
  const editingItem = ref(null);
  
  const openCreateModal = () => showCreateModal.value = true;
  const closeCreateModal = () => showCreateModal.value = false;
  const edit = (item) => editingItem.value = item;
  
  defineExpose({ edit });
  </script>
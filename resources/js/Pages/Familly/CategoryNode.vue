<template>
    <div class="category-node">
      <div class="category-header" @click="toggleExpand">
        <span class="toggle-icon">
          <vue-feather :type="isExpanded ? 'minus' : 'plus'"></vue-feather>
        </span>
        <span class="category-name">{{ category.name }}</span>
        <div class="category-actions">
          <button class="btn btn-sm btn-outline-primary me-2" @click.stop="$emit('add-subcategory', category)">
            + Subcategory
          </button>
          <button class="btn btn-sm btn-outline-secondary me-2" @click.stop="$emit('edit-category', category)">
            <vue-feather type="edit" size="14"></vue-feather>
          </button>
          <button class="btn btn-sm btn-outline-danger me-2" @click.stop="$emit('delete-category', category, 'category')">
            <vue-feather type="trash-2" size="14"></vue-feather>
          </button>
          <button class="btn btn-sm btn-outline-primary me-2" @click.stop="$emit('add-attribute', category, 'brand')">
            + Brand
          </button>
          <button class="btn btn-sm btn-outline-primary me-2" @click.stop="$emit('add-attribute', category, 'measure')">
            + Measure
          </button>
          <button class="btn btn-sm btn-outline-primary me-2" @click.stop="$emit('add-attribute', category, 'type')">
            + Type
          </button>
          <button class="btn btn-sm btn-outline-primary" @click.stop="$emit('add-attribute', category, 'unit')">
            + Unit
          </button>
        </div>
      </div>
  
      <div v-if="isExpanded" class="category-content" :style="{ marginLeft: depth * 20 + 'px' }">
        <div class="attribute-section">
          <h6>Brands</h6>
          <div v-if="category.brands?.length > 0" class="attribute-grid">
            <div v-for="brand in category.brands" :key="'brand-'+brand.id" class="attribute-item">
              <span>{{ brand.name }}</span>
              <div class="attribute-actions">
                <button class="btn btn-sm btn-outline-secondary" @click="$emit('edit-attribute', brand, 'brand')">
                  <vue-feather type="edit" size="14"></vue-feather>
                </button>
                <button class="btn btn-sm btn-outline-danger" @click="$emit('delete-attribute', brand, 'brand')">
                  <vue-feather type="trash-2" size="14"></vue-feather>
                </button>
              </div>
            </div>
          </div>
          <div v-else class="text-muted">No brands</div>
        </div>
  
        <div class="attribute-section">
          <h6>Measures</h6>
          <div v-if="category.measures?.length > 0" class="attribute-grid">
            <div v-for="measure in category.measures" :key="'measure-'+measure.id" class="attribute-item">
              <span>{{ measure.name }}</span>
              <div class="attribute-actions">
                <button class="btn btn-sm btn-outline-secondary" @click="$emit('edit-attribute', measure, 'measure')">
                  <vue-feather type="edit" size="14"></vue-feather>
                </button>
                <button class="btn btn-sm btn-outline-danger" @click="$emit('delete-attribute', measure, 'measure')">
                  <vue-feather type="trash-2" size="14"></vue-feather>
                </button>
              </div>
            </div>
          </div>
          <div v-else class="text-muted">No measures</div>
        </div>
  
        <div class="attribute-section">
          <h6>Types</h6>
          <div v-if="category.types?.length > 0" class="attribute-grid">
            <div v-for="type in category.types" :key="'type-'+type.id" class="attribute-item">
              <span>{{ type.name }}</span>
              <div class="attribute-actions">
                <button class="btn btn-sm btn-outline-secondary" @click="$emit('edit-attribute', type, 'type')">
                  <vue-feather type="edit" size="14"></vue-feather>
                </button>
                <button class="btn btn-sm btn-outline-danger" @click="$emit('delete-attribute', type, 'type')">
                  <vue-feather type="trash-2" size="14"></vue-feather>
                </button>
              </div>
            </div>
          </div>
          <div v-else class="text-muted">No types</div>
        </div>
  
        <div class="attribute-section">
          <h6>Units</h6>
          <div v-if="category.units?.length > 0" class="attribute-grid">
            <div v-for="unit in category.units" :key="'unit-'+unit.id" class="attribute-item">
              <span>{{ unit.name }}</span>
              <div class="attribute-actions">
                <button class="btn btn-sm btn-outline-secondary" @click="$emit('edit-attribute', unit, 'unit')">
                  <vue-feather type="edit" size="14"></vue-feather>
                </button>
                <button class="btn btn-sm btn-outline-danger" @click="$emit('delete-attribute', unit, 'unit')">
                  <vue-feather type="trash-2" size="14"></vue-feather>
                </button>
              </div>
            </div>
          </div>
          <div v-else class="text-muted">No units</div>
        </div>
  
        <!-- Subcategories -->
        <div v-if="category.sub_categories && category.sub_categories?.length > 0">
          <CategoryNode
            v-for="subcategory in category.sub_categories"
            :key="subcategory.id"
            :category="subcategory"
            :depth="depth + 1"
            @add-subcategory="$emit('add-subcategory', $event)"
            @edit-category="$emit('edit-category', $event)"
            @delete-category="$emit('delete-category', $event)"
            @add-attribute="$emit('add-attribute', $event)"
            @edit-attribute="$emit('edit-attribute', $event)"
            @delete-attribute="$emit('delete-attribute', $event)"
            @toggle-expand="$emit('toggle-expand', $event)"
          />
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, computed } from 'vue';
  import VueFeather from 'vue-feather';
  
  const props = defineProps({
    category: Object,
    depth: Number
  });
  
  const emit = defineEmits([
    'add-subcategory',
    'edit-category',
    'delete-category',
    'add-attribute',
    'edit-attribute',
    'delete-attribute',
    'toggle-expand'
  ]);
  
  const isExpanded = ref(false);
  
  const toggleExpand = () => {
    isExpanded.value = !isExpanded.value;
    emit('toggle-expand', props.category.id);
  };
  </script>
  
  <style scoped>
  .category-node {
    margin-bottom: 1rem;
  }
  
  .category-header {
    display: flex;
    align-items: center;
    padding: 0.5rem;
    background-color: #f8f9fa;
    border-radius: 4px;
    cursor: pointer;
    user-select: none;
  }
  
  .category-header:hover {
    background-color: #e9ecef;
  }
  
  .toggle-icon {
    margin-right: 0.5rem;
    display: inline-flex;
  }
  
  .category-name {
    font-weight: 600;
    flex-grow: 1;
  }
  
  .category-actions {
    display: flex;
    gap: 0.5rem;
  }
  
  .category-content {
    margin-top: 0.5rem;
    padding-left: 1rem;
    border-left: 1px dashed #dee2e6;
  }
  
  .attribute-section {
    margin-bottom: 1.5rem;
  }
  
  .attribute-section h6 {
    font-size: 0.9rem;
    color: #6c757d;
    margin-bottom: 0.5rem;
  }
  
  .attribute-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 0.5rem;
  }
  
  .attribute-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem;
    background-color: #f8f9fa;
    border-radius: 4px;
  }
  
  .attribute-actions {
    display: flex;
    gap: 0.25rem;
  }
  
  .btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.75rem;
  }
  </style>
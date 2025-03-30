<template>
  <div class="card">
    <div class="card-header d-flex justify-content-between">
      <div>
        <h4 class="card-title">Category Table</h4>
        <p v-if="loading" class="card-subtitle text-muted">Loading categories...</p>
      </div>
      <div>
        <div class="d-flex gap-2">
          <div class="search-set">
            <div class="search-input">
              <input 
                type="text" 
                v-model="searchTerm" 
                @input="filterCategories"
                placeholder="Search categories..." 
                class="dark-input" 
              />
              <a href="" class="btn btn-searchset">
                <i data-feather="search" class="feather-search"></i>
              </a>
            </div>
          </div>
          <div>
            <button class="project-btn" @click="openAddModal">
              <vue-feather type="plus-circle" class="me-2"></vue-feather> 
              Add Category
            </button>
          </div>
        </div>
      </div>
    </div>

    <div class="card-body">
      <div v-if="loading" class="text-center py-4">
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>

      <div v-else-if="error" class="alert alert-danger">
        {{ error }}
      </div>

      <div v-else-if="filteredCategories.length === 0" class="text-center py-4">
        <p>No categories found.</p>
        <button @click="fetchCategories" class="btn btn-primary">
          Retry
        </button>
      </div>

      <div v-else class="table-responsive dataview">
        <table class="table dashboard-expired-products">
          <thead>
            <tr>
              <th class="no-sort">ID</th>
              <th>Name</th>
              <th>X Axis</th>
              <th>Y Axis</th>
              <th>Subcategories</th>
              <th class="no-sort">Actions</th>
            </tr>
          </thead>
          <tbody>
            <template v-for="category in filteredCategories" :key="category.id">
              <!-- Main Category Row -->
              <tr>
                <td>{{ category.id }}</td>
                <td class="font-weight-bold">{{ category.name }}</td>
                <td>{{ category.x_axis || '-' }}</td>
                <td>{{ category.y_axis || '-' }}</td>
                <td>
                  <span v-if="category.subcategories.length > 0">
                    {{ category.subcategories.length }} subcategories
                  </span>
                  <span v-else>-</span>
                </td>
                <td class="action-table-data">
                  <div class="edit-delete-action">
                    <button class="me-2 p-2" @click="openEditModal(category)">
                      <VueFeather type="edit" class="feather-edit" />
                    </button>
                    <button class="confirm-text p-2" @click="confirmDelete(category)">
                      <VueFeather type="trash-2" class="feather-trash-2" />
                    </button>
                  </div>
                </td>
              </tr>

              <!-- Subcategory Rows -->
              <tr v-for="subcategory in category.subcategories" :key="'sub-'+subcategory.id" class="subcategory-row">
                <td>{{ subcategory.id }}</td>
                <td class="ps-4">
                  <span class="subcategory-indicator">↳</span>
                  {{ subcategory.name }}
                </td>
                <td colspan="3">-</td>
                <td class="action-table-data">
                  <div class="edit-delete-action">
                    <button class="me-2 p-2" @click="openEditModal(subcategory, true)">
                      <VueFeather type="edit" class="feather-edit" />
                    </button>
                    <button class="confirm-text p-2" @click="confirmDelete(subcategory, true)">
                      <VueFeather type="trash-2" class="feather-trash-2" />
                    </button>
                  </div>
                </td>
              </tr>
            </template>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Add/Edit Modal -->
    <div class="modal fade" id="categoryModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ isEditing ? 'Edit' : 'Add' }} {{ isSubcategory ? 'Subcategory' : 'Category' }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="saveCategory">
              <div class="mb-3">
                <label class="form-label">Name</label>
                <input 
                  type="text" 
                  class="form-control" 
                  v-model="form.name" 
                  required
                >
              </div>
              
              <div class="mb-3" v-if="isSubcategory">
                <label class="form-label">Parent Category</label>
                <select 
                  class="form-select" 
                  v-model="form.category_id" 
                  required
                >
                  <option value="">Select Category</option>
                  <option 
                    v-for="cat in mainCategories" 
                    :value="cat.id"
                    :key="cat.id"
                  >
                    {{ cat.name }}
                  </option>
                </select>
              </div>
              
              <div class="mb-3">
                <label class="form-label">X Axis</label>
                <select class="form-select" v-model="form.x_axis">
                  <option value="">None</option>
                  <option value="measures">Measures</option>
                  <option value="units">Units</option>
                  <option value="brands">Brands</option>
                  <option value="types">Types</option>
                </select>
              </div>
              
              <div class="mb-3">
                <label class="form-label">Y Axis</label>
                <select class="form-select" v-model="form.y_axis">
                  <option value="">None</option>
                  <option value="measures">Measures</option>
                  <option value="units">Units</option>
                  <option value="brands">Brands</option>
                  <option value="types">Types</option>
                </select>
              </div>

              <div class="text-end">
                <button 
                  type="button" 
                  class="btn btn-secondary me-2" 
                  data-bs-dismiss="modal"
                >
                  Cancel
                </button>
                <button 
                  type="submit" 
                  class="btn btn-primary"
                  :disabled="saving"
                >
                  <span v-if="saving" class="spinner-border spinner-border-sm"></span>
                  {{ isEditing ? 'Update' : 'Save' }}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Confirm Deletion</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete this {{ itemToDelete?.category_id ? 'subcategory' : 'category' }}? This action cannot be undone.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button 
              type="button" 
              class="btn btn-danger"
              @click="deleteItem"
              :disabled="deleting"
            >
              <span v-if="deleting" class="spinner-border spinner-border-sm"></span>
              Delete
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import { Modal } from 'bootstrap';
import axios from 'axios';
import VueFeather from 'vue-feather';

// Data
const categories = ref([]);
const filteredCategories = ref([]);
const searchTerm = ref('');
const loading = ref(false);
const error = ref(null);
const saving = ref(false);
const deleting = ref(false);
const isEditing = ref(false);
const isSubcategory = ref(false);
const itemToDelete = ref(null);
const form = ref({
  id: null,
  name: '',
  x_axis: null,
  y_axis: null,
  category_id: null
});

// Modals
let categoryModal = null;
let deleteModal = null;

// Computed
const mainCategories = computed(() => 
  categories.value.filter(c => !c.category_id)
);

// Methods
const fetchCategories = async () => {
  try {
    loading.value = true;
    error.value = null;
    const response = await axios.get('/api/categories');
    
    if (response.data.success) {
      categories.value = response.data.data;
      filteredCategories.value = response.data.data;
    } else {
      error.value = 'Failed to load categories';
    }
  } catch (err) {
    error.value = err.response?.data?.message || 'Network error';
    console.error('Error fetching categories:', err);
  } finally {
    loading.value = false;
  }
};

const filterCategories = () => {
  if (!searchTerm.value) {
    filteredCategories.value = categories.value;
    return;
  }

  const term = searchTerm.value.toLowerCase();
  filteredCategories.value = categories.value.filter(category => 
    category.name.toLowerCase().includes(term) ||
    (category.x_axis && category.x_axis.toLowerCase().includes(term)) ||
    (category.y_axis && category.y_axis.toLowerCase().includes(term)) ||
    category.subcategories.some(sub => 
      sub.name.toLowerCase().includes(term)
    )
  );
};

const openAddModal = () => {
  isEditing.value = false;
  isSubcategory.value = false;
  form.value = {
    id: null,
    name: '',
    x_axis: null,
    y_axis: null,
    category_id: null
  };
  categoryModal.show();
};

const openEditModal = (item, isSub = false) => {
  isEditing.value = true;
  isSubcategory.value = isSub;
  form.value = {
    id: item.id,
    name: item.name,
    x_axis: item.x_axis,
    y_axis: item.y_axis,
    category_id: item.category_id || null
  };
  categoryModal.show();
};

const confirmDelete = (item) => {
  itemToDelete.value = item;
  deleteModal.show();
};

const saveCategory = async () => {
  saving.value = true;
  try {
    const url = isSubcategory.value
      ? `/api/subcategories${isEditing.value ? `/${form.value.id}` : ''}`
      : `/api/categories${isEditing.value ? `/${form.value.id}` : ''}`;
    
    const method = isEditing.value ? 'put' : 'post';
    
    const { data } = await axios[method](url, form.value);
    
    if (data.success) {
      categoryModal.hide();
      fetchCategories(); // Refresh the list
    }
  } catch (err) {
    console.error('Error saving category:', err);
    error.value = err.response?.data?.message || 'Error saving category';
  } finally {
    saving.value = false;
  }
};

const deleteItem = async () => {
  deleting.value = true;
  try {
    const isSub = !!itemToDelete.value.category_id;
    const url = `/api/${isSub ? 'subcategories' : 'categories'}/${itemToDelete.value.id}`;
    
    await axios.delete(url);
    
    deleteModal.hide();
    fetchCategories(); // Refresh the list
  } catch (err) {
    console.error('Error deleting item:', err);
    error.value = err.response?.data?.message || 'Error deleting item';
  } finally {
    deleting.value = false;
  }
};

// Initialize
onMounted(() => {
  categoryModal = new Modal(document.getElementById('categoryModal'));
  deleteModal = new Modal(document.getElementById('deleteModal'));
  fetchCategories();
});
</script>

<style scoped>
.subcategory-row {
  background-color: #f8f9fa;
}

.subcategory-indicator {
  margin-right: 8px;
  color: #6c757d;
}

.font-weight-bold {
  font-weight: 600;
}

.ps-4 {
  padding-left: 1.5rem !important;
}

.action-table-data {
  white-space: nowrap;
}

.no-sort {
  background-image: none !important;
}
</style>
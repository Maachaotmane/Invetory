<template>
  <NavLayout />
  <SideLayout />
  <div class="page-wrapper">
    <div class="content">
  <div class="card">
    <div class="card-header d-flex justify-content-between">
      <div>
        <h4 class="card-title">Category Attributes Management</h4>
        <p v-if="loading" class="card-subtitle text-muted">Loading data...</p>
      </div>
      <div>
        <button class="project-btn" @click="openAddCategoryModal(null)">
          <vue-feather type="plus-circle" class="me-2"></vue-feather> 
          Add Category
        </button>
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

      <div v-else>
        <div class="category-tree">
          <CategoryNode
            v-for="category in paginatedCategories"
            :key="category.id"
            :category="category"
            :depth="0"
            @add-subcategory="openAddCategoryModal"
            @edit-category="openEditCategoryModal"
            @delete-category="confirmDelete"
            @add-attribute="openAddAttributeModal"
            @edit-attribute="openEditAttributeModal"
            @delete-attribute="confirmDelete"
            @toggle-expand="toggleExpand"
          />
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-3">
          <div class="dataTables_info">
            Showing {{ pagination.startItem }} to {{ pagination.endItem }} of {{ filteredCategories.length }} entries
          </div>
          <div class="dataTables_paginate">
            <ul class="pagination">
              <li v-for="page in visiblePages" 
                  :key="page" 
                  class="paginate_button page-item" 
                  :class="{ active: pagination.currentPage === page }">
                <a href="#" class="page-link" @click.prevent="changePage(page)">
                  {{ page }}
                </a>
              </li>
            </ul>
          </div>
          <div class="page-size-selector">
            <select class="form-select form-select-sm" v-model="pagination.itemsPerPage" @change="changeItemsPerPage">
              <option value="5">5 per page</option>
              <option value="10">10 per page</option>
              <option value="20">20 per page</option>
              <option value="50">50 per page</option>
            </select>
          </div>
        </div>
      </div>
    </div>

    <!-- Category Modal -->
    <div class="modal fade" id="categoryModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ isEditingCategory ? 'Edit' : categoryForm.category_id ? 'Add Subcategory' : 'Add Category' }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="saveCategory">
              <div class="mb-3">
                <label class="form-label">Name</label>
                <input 
                  type="text" 
                  class="form-control" 
                  v-model="categoryForm.name" 
                  required
                >
              </div>

              <div v-if="!categoryForm.category_id" class="mb-3">
                <label class="form-label">Quantity Alert</label>
                <input 
                  type="text" 
                  class="form-control" 
                  v-model="categoryForm.quantity_alert" 
                >
              </div>

                <div v-if="!categoryForm.category_id" class="mb-3">
                <label class="form-label">X Axis</label>
                <select class="form-select" v-model="categoryForm.x_axis">
                  <option value="">None</option>
                  <option value="measures">Measures</option>
                  <option value="units">Units</option>
                  <option value="brands">Brands</option>
                  <option value="types">Types</option>
                  <option value="sub_measures">Sub Measures</option>
                </select>
                </div>
                
                <div v-if="!categoryForm.category_id" class="mb-3">
                <label class="form-label">Y Axis</label>
                <select class="form-select" v-model="categoryForm.y_axis">
                  <option value="">None</option>
                  <option value="measures">Measures</option>
                  <option value="units">Units</option>
                  <option value="brands">Brands</option>
                  <option value="types">Types</option>
                  <option value="sub_measures">Sub Measures</option>
                </select>
                </div>
              <div class="text-end">
                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" :disabled="saving">
                  <span v-if="saving" class="spinner-border spinner-border-sm"></span>
                  {{ isEditingCategory ? 'Update' : 'Save' }}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Attribute Modal -->
    <div class="modal fade" id="attributeModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ isEditingAttribute ? 'Edit' : 'Add' }} {{ currentAttributeType }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="saveAttribute">
              <div class="mb-3">
                <label class="form-label">Name</label>
                <input 
                  type="text" 
                  class="form-control" 
                  v-model="attributeForm.name" 
                  required
                >
              </div>
              <div class="mb-3" v-if="!isEditingAttribute">
                <label class="form-label">Category</label>
                <select class="form-select" v-model="attributeForm.category_id" required>
                  <option value="">Select Category</option>
                  <option 
                    v-for="cat in allCategoriesFlat" 
                    :value="cat.id" 
                    :key="cat.id"
                    :style="{ paddingLeft: (cat.depth * 20) + 'px' }"
                  >
                    {{ cat.name }}
                  </option>
                </select>
              </div>

              <div class="text-end">
                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" :disabled="saving">
                  <span v-if="saving" class="spinner-border spinner-border-sm"></span>
                  {{ isEditingAttribute ? 'Update' : 'Save' }}
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
            <p>Are you sure you want to delete this {{ itemToDeleteType }}? This action cannot be undone.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-danger" @click="deleteItem" :disabled="deleting">
              <span v-if="deleting" class="spinner-border spinner-border-sm"></span>
              Delete
            </button>
          </div>
        </div>
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
import CategoryNode from './CategoryNode.vue';
import NavLayout from '@/Layouts/NavLayout.vue';
import SideLayout from '@/Layouts/SideLayout.vue';

// Data
const categories = ref([]);
const loading = ref(false);
const error = ref(null);
const saving = ref(false);
const deleting = ref(false);
const expandedCategories = ref([]);
const isSubcategory = ref(false);

// Category Form
const isEditingCategory = ref(false);
const categoryForm = ref({
  id: null,
  name: '',
  x_axis: null,
  y_axis: null,
  quantity_alert: null,
  category_id: null
});

// Attribute Form
const isEditingAttribute = ref(false);
const currentAttributeType = ref('');
const attributeForm = ref({
  id: null,
  name: '',
  x_axis: null,
  y_axis: null,
  category_id: null
});

// Delete
const itemToDelete = ref(null);
const itemToDeleteType = ref('');

// Pagination
const pagination = ref({
  currentPage: 1,
  itemsPerPage: 10,
  totalPages: 1,
  startItem: 1,
  endItem: 1,
  maxVisiblePages: 5
});

// Modals
let categoryModal = null;
let attributeModal = null;
let deleteModal = null;

// Computed
const allCategoriesFlat = computed(() => {
  const flatten = (categories, depth = 0) => {
    return categories.reduce((acc, category) => {
      acc.push({ ...category, depth });
      if (category.children && category.children.length > 0) {
        acc.push(...flatten(category.children, depth + 1));
      }
      return acc;
    }, []);
  };
  return flatten(categories.value);
});

const filteredCategories = computed(() => {
  return categories.value;
});

const paginatedCategories = computed(() => {
  const start = (pagination.value.currentPage - 1) * pagination.value.itemsPerPage;
  const end = start + pagination.value.itemsPerPage;
  return filteredCategories.value.slice(start, end);
});

const visiblePages = computed(() => {
  const range = [];
  const half = Math.floor(pagination.value.maxVisiblePages / 2);
  let start = Math.max(1, pagination.value.currentPage - half);
  let end = Math.min(pagination.value.totalPages, start + pagination.value.maxVisiblePages - 1);
  
  if (end - start + 1 < pagination.value.maxVisiblePages) {
    start = Math.max(1, end - pagination.value.maxVisiblePages + 1);
  }
  
  for (let i = start; i <= end; i++) {
    range.push(i);
  }
  
  return range;
});

// Methods
const fetchData = async () => {
  try {
    loading.value = true;
    error.value = null;
    const response = await axios.get('/api/categories/categories-with-attributes');
    categories.value = response.data.data || [];
    updatePagination();
  } catch (err) {
    error.value = err.response?.data?.message || 'Failed to load data';
    console.error('Error fetching data:', err);
  } finally {
    loading.value = false;
  }
};

const updatePagination = () => {
  pagination.value.totalPages = Math.ceil(filteredCategories.value.length / pagination.value.itemsPerPage) || 1;
  pagination.value.currentPage = Math.min(pagination.value.currentPage, pagination.value.totalPages);
  pagination.value.startItem = (pagination.value.currentPage - 1) * pagination.value.itemsPerPage + 1;
  pagination.value.endItem = Math.min(
    pagination.value.currentPage * pagination.value.itemsPerPage,
    filteredCategories.value.length
  );
};

const changePage = (page) => {
  if (page < 1 || page > pagination.value.totalPages) return;
  pagination.value.currentPage = page;
  window.scrollTo({ top: 0, behavior: 'smooth' });
};

const changeItemsPerPage = () => {
  pagination.value.currentPage = 1;
  updatePagination();
};

const toggleExpand = (categoryId) => {
  const index = expandedCategories.value.indexOf(categoryId);
  if (index === -1) {
    expandedCategories.value.push(categoryId);
  } else {
    expandedCategories.value.splice(index, 1);
  }
};

// Category CRUD
const openAddCategoryModal = (parentCategory) => {
  isEditingCategory.value = false;
  categoryForm.value = { 
    id: null, 
    name: '',
    x_axis: null,
    y_axis: null,
    quantity_alert: null,
    category_id: parentCategory ? parentCategory.id : null
  };
  categoryModal.show();
};

const openEditCategoryModal = (category) => {
  isEditingCategory.value = true;
  categoryForm.value = { ...category };
  categoryModal.show();
};

const saveCategory = async () => {
  saving.value = true;
  try {
    const url = categoryForm.value.category_id 
      ? `/api/subcategories/${isEditingCategory.value ? categoryForm.value.id : ''}`
      : `/api/categories/${isEditingCategory.value ? categoryForm.value.id : ''}`;
    const method = isEditingCategory.value ? 'put' : 'post';
    
    const { data } = await axios[method](url, categoryForm.value);
    
    if (data.success) {
      categoryModal.hide();
      fetchData();
    }
  } catch (err) {
    error.value = err.response?.data?.message || 'Error saving category';
    console.error('Error saving category:', err);
  } finally {
    saving.value = false;
  }
};

// Attribute CRUD
const openAddAttributeModal = (category, type) => {
  isEditingAttribute.value = false;
  currentAttributeType.value = type;
  attributeForm.value = {
    id: null,
    name: '',
    category_id: category.id
  };
  attributeModal.show();
};

const openEditAttributeModal = (item, type) => {
  isEditingAttribute.value = true;
  currentAttributeType.value = type;
  attributeForm.value = {
    id: item.id,
    name: item.name,
    x_axis: item.x_axis,
    y_axis: item.y_axis,
    category_id: item.category_id
  };
  attributeModal.show();
};

const saveAttribute = async () => {
  saving.value = true;
  try {
    const endpoint = `/api/${currentAttributeType.value}s`;
    const url = isEditingAttribute.value 
      ? `${endpoint}/${attributeForm.value.id}`
      : endpoint;
    const method = isEditingAttribute.value ? 'put' : 'post';
    
    const { data } = await axios[method](url, attributeForm.value);
    
    if (data.success) {
      attributeModal.hide(); // Ensure modal is closed
      fetchData();
    }
  } catch (err) {
    error.value = err.response?.data?.message || `Error saving ${currentAttributeType.value}`;
    console.error(`Error saving ${currentAttributeType.value}:`, err);
  } finally {
    saving.value = false;
  }
};

const confirmDelete = (item, type) => {
  itemToDelete.value = item;
  itemToDeleteType.value = type;
  deleteModal.show();
};

const deleteItem = async () => {
  deleting.value = true;
  try {
    // Make sure the endpoint is correct
    const endpoint = itemToDeleteType.value === 'category' 
      ? '/api/categories'
      : `/api/${itemToDeleteType.value}s`;
    
    await axios.delete(`${endpoint}/${itemToDelete.value.id}`);
    deleteModal.hide();
    fetchData();
  } catch (err) {
    error.value = err.response?.data?.message || `Error deleting ${itemToDeleteType.value}`;
    console.error(`Error deleting ${itemToDeleteType.value}:`, err);
  } finally {
    deleting.value = false;
  }
};

// Initialize
onMounted(() => {
  categoryModal = new Modal(document.getElementById('categoryModal'));
  attributeModal = new Modal(document.getElementById('attributeModal'));
  deleteModal = new Modal(document.getElementById('deleteModal'));
  fetchData();
});
</script>

<style scoped>
.category-tree {
  border-left: 1px solid #dee2e6;
  padding-left: 1rem;
}

/* Pagination styles */
.pagination {
  margin: 0;
}

.page-link {
  cursor: pointer;
  user-select: none;
}

.page-item.active .page-link {
  background-color: #0d6efd;
  border-color: #0d6efd;
  color: white;
}

.page-item.disabled .page-link {
  pointer-events: none;
  opacity: 0.6;
}

.page-size-selector {
  width: 120px;
}

.dataTables_info {
  color: #6c757d;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .d-flex.justify-content-between {
    flex-direction: column;
    gap: 1rem;
  }
  
  .dataTables_paginate {
    order: 1;
  }
  
  .dataTables_info {
    order: 2;
    text-align: center;
  }
  
  .page-size-selector {
    order: 3;
    width: 100%;
  }
  
  .pagination {
    flex-wrap: wrap;
    justify-content: center;
  }
}
</style>
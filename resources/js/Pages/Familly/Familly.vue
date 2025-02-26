<script setup>
import Statistics from '../../Components/statistics/FamilyStatistics.vue';
import AddCategory from '../../Components/category/AddCategory.vue';
import AddBrand from '../../Components/brand/AddBrand.vue';
import AddType from '../../Components/type/AddType.vue';
import AddUnit from '../../Components/unit/AddUnit.vue';
import AddSubCategory from '../../Components/category/AddSubCategory.vue';
import UpdateCategory from '../../Components/category/UpdateCategory.vue';
import { Head } from '@inertiajs/vue3';
import NavLayout from '@/Layouts/NavLayout.vue';
import SideLayout from '@/Layouts/SideLayout.vue';
import VueFeather from 'vue-feather';
import { defineProps } from 'vue';
import Swal from 'sweetalert2';
import { useForm, router } from '@inertiajs/vue3';
import { ref } from 'vue';


const props = defineProps({
  categories: Object,
});

const form = useForm({});
const categoryToUpdate = ref({});

const setCategoryToUpdate = (category) => {
  categoryToUpdate.value = category;
};

const searchCategory = ref('');

const searchCategories = (type) => {
  const key = type === 'category' ? 'searchCategory' : 'searchFournisseur';
  const value = type === 'category' ? searchCategory.value : searchFournisseur.value;

  router.get(
    route('families.index'),
    { [key]: value },
    { preserveState: true, replace: true }
  );
};

const showConfirmation = (api, categoryId) => {
  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!',
    confirmButtonClass: 'btn btn-primary',
    cancelButtonClass: 'btn btn-danger ml-1',
    buttonsStyling: false,
  }).then((result) => {
    if (result.isConfirmed) {
      form.delete(route(api, categoryId), {
        onSuccess: () => {
          Swal.fire({
            icon: 'success',
            title: 'Deleted!',
            text: 'This item has been deleted.',
            confirmButtonClass: 'btn btn-success',
          });
        },
        onError: () => {
          Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Something went wrong.',
          });
        },
      });
    }
  });
};

</script>

<template>

  <Head title="Home" />

  <NavLayout />
  <SideLayout />

  <div class="page-wrapper">
    <div class="content">
      <Statistics />

      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div>
            <h4 class="card-title">Category Table</h4>
          </div>
          <div>
            <div class="d-flex gap-2">
              <div class="search-set">
                <div class="search-input">
                  <input type="text" v-model="searchCategory" @input="searchCategories('category')"
                    placeholder="Search categories..." class="dark-input" />
                  <a href="" class="btn btn-searchset"><i data-feather="search" class="feather-search"></i></a>
                </div>
              </div>
              <div>
                <a href="javascript:void(0);" class="project-btn" data-bs-toggle="modal"
                  data-bs-target="#add-category"><vue-feather type="plus-circle" class="me-2"></vue-feather> Add
                  Category</a>
              </div>
              <div>
                <a href="javascript:void(0);" class="project-btn" data-bs-toggle="modal"
                  data-bs-target="#add-sub-category"><vue-feather type="plus-circle" class="me-2"></vue-feather> Add
                  Sub-Category</a>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive dataview">
            <table class="table dashboard-expired-products">
              <thead>
                <tr>
                  <th class="no-sort">
                    <label class="checkboxs">
                      <input type="checkbox" id="select-all" />
                      <span class="checkmarks"></span>
                    </label>
                  </th>
                  <th>Name</th>
                  <th>Code</th>
                  <th>Description</th>
                  <th class="no-sort">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="category in categories.data" :key="category.id">
                  <td>
                    <label class="checkboxs">
                      <input type="checkbox" />
                      <span class="checkmarks"></span>
                    </label>
                  </td>
                  <td>{{ category.name }}</td>
                  <td>{{ category.email }}</td>
                  <td>{{ category.address }}</td>
                  <td class="action-table-data">
                    <div class="edit-delete-action">
                      <a class="me-2 p-2" href="javascript:void(0);" data-bs-toggle="modal"
                        data-bs-target="#update-category" @click="setCategoryToUpdate(category)">
                        <VueFeather type="edit" class="feather-edit" />
                      </a>
                      <a class="confirm-text p-2" @click="showConfirmation('category.destroy', category.id)"
                        href="javascript:void(0);">
                        <VueFeather type="trash-2" class="feather-trash-2" />
                      </a>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-md-6 ">
          <div class="card">
            <div class="card-header">
              <div>
                <h4 class="card-title mb-2">Type Table</h4>
              </div>
              <div>
                <div class="d-flex justify-content-between gap-2">
                  <div class="search-set">
                    <div class="search-input">
                      <input type="text" v-model="searchCategory" @input="searchCategories('category')"
                        placeholder="Search type..." class="dark-input" />
                      <a href="" class="btn btn-searchset"><i data-feather="search" class="feather-search"></i></a>
                    </div>
                  </div>
                  <div>
                    <a href="javascript:void(0);" class="project-btn" data-bs-toggle="modal"
                      data-bs-target="#add-type"><vue-feather type="plus-circle" class="me-2"></vue-feather> Add
                      type</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive dataview">
                <table class="table dashboard-expired-products">
                  <thead>
                    <tr>
                      <th class="no-sort">
                        <label class="checkboxs">
                          <input type="checkbox" id="select-all" />
                          <span class="checkmarks"></span>
                        </label>
                      </th>
                      <th>Type</th>
                      <th>Short Name</th>
                      <th class="no-sort">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="category in categories.data" :key="category.id">
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td>{{ category.name }}</td>
                      <td>{{ category.email }}</td>
                      <td class="action-table-data">
                        <div class="edit-delete-action">
                          <a class="me-2 p-2" href="javascript:void(0);" data-bs-toggle="modal"
                            data-bs-target="#update-category" @click="setCategoryToUpdate(category)">
                            <VueFeather type="edit" class="feather-edit" />
                          </a>
                          <a class="confirm-text p-2" @click="showConfirmation('category.destroy', category.id)"
                            href="javascript:void(0);">
                            <VueFeather type="trash-2" class="feather-trash-2" />
                          </a>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-6">
          <div class="card">
            <div class="card-header">
              <div>
                <h4 class="card-title mb-2">Brand Table</h4>
              </div>
              <div>
                <div class="d-flex justify-content-between gap-2">
                  <div class="search-set">
                    <div class="search-input">
                      <input type="text" v-model="searchCategory" @input="searchCategories('category')"
                        placeholder="Search brand..." class="dark-input" />
                      <a href="" class="btn btn-searchset"><i data-feather="search" class="feather-search"></i></a>
                    </div>
                  </div>
                  <div>
                    <a href="javascript:void(0);" class="project-btn" data-bs-toggle="modal"
                      data-bs-target="#add-brand"><vue-feather type="plus-circle" class="me-2"></vue-feather> Add
                      Brand</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive dataview">
                <table class="table dashboard-expired-products">
                  <thead>
                    <tr>
                      <th class="no-sort">
                        <label class="checkboxs">
                          <input type="checkbox" id="select-all" />
                          <span class="checkmarks"></span>
                        </label>
                      </th>
                      <th>Name</th>
                      <th>Code</th>
                      <th>Description</th>
                      <th class="no-sort">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="category in categories.data" :key="category.id">
                      <td>
                        <label class="checkboxs">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>
                        </label>
                      </td>
                      <td>{{ category.name }}</td>
                      <td>{{ category.email }}</td>
                      <td>{{ category.address }}</td>
                      <td class="action-table-data">
                        <div class="edit-delete-action">
                          <a class="me-2 p-2" href="javascript:void(0);" data-bs-toggle="modal"
                            data-bs-target="#update-category" @click="setCategoryToUpdate(category)">
                            <VueFeather type="edit" class="feather-edit" />
                          </a>
                          <a class="confirm-text p-2" @click="showConfirmation('category.destroy', category.id)"
                            href="javascript:void(0);">
                            <VueFeather type="trash-2" class="feather-trash-2" />
                          </a>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <AddCategory />
      <AddSubCategory />
      <AddBrand />
      <AddUnit />
      <AddType />
      <UpdateCategory :category="categoryToUpdate" />
    </div>
  </div>
</template>

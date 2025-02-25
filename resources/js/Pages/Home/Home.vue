<script setup>
import Statistics from '../../Components/statistics/Statistics.vue';
import AddClient from '../../Components/client/AddClient.vue';
import UpdateClient from '../../Components/client/UpdateClient.vue';
import AddFournisseur from '../../Components/fournisseur/AddFournisseur.vue';
import UpdateFournisseur from '../../Components/fournisseur/UpdateFournisseur.vue';
import { Head } from '@inertiajs/vue3';
import NavLayout from '@/Layouts/NavLayout.vue';
import SideLayout from '@/Layouts/SideLayout.vue';
import VueFeather from 'vue-feather';
import { defineProps } from 'vue';
import Swal from 'sweetalert2';
import { useForm, router } from '@inertiajs/vue3';
import { ref } from 'vue';


const props = defineProps({
  clients: Object,
  fournisseurs: Object,
});

const form = useForm({});
const clientToUpdate = ref({});
const fournisseurToUpdate = ref({});

const setClientToUpdate = (client) => {
  clientToUpdate.value = client;
};

const setFournisseurToUpdate = (fournisseur) => {
  fournisseurToUpdate.value = fournisseur;
};

const searchClient = ref('');
const searchFournisseur = ref('');

const searchClients = (type) => {
  const key = type === 'client' ? 'searchClient' : 'searchFournisseur';
  const value = type === 'client' ? searchClient.value : searchFournisseur.value;

  router.get(
    route('home.index'),
    { [key]: value },
    { preserveState: true, replace: true }
  );
};

const showConfirmation = (api, clientId) => {
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
      form.delete(route(api, clientId), {
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
            <h4 class="card-title">Clients Table</h4>
          </div>
          <div>
            <div class="d-flex gap-2">
              <div class="search-set">
                <div class="search-input">
                  <input type="text" v-model="searchClient" @input="searchClients('client')"
                    placeholder="Search clients..." class="dark-input" />
                  <a href="" class="btn btn-searchset"><i data-feather="search" class="feather-search"></i></a>
                </div>
              </div>
              <div>
                <a href="javascript:void(0);" class="project-btn" data-bs-toggle="modal"
                  data-bs-target="#add-client"><vue-feather type="plus-circle" class="me-2"></vue-feather> Add
                  client</a>
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
                  <th>Email</th>
                  <th>Address</th>
                  <th>Phone</th>
                  <th class="no-sort">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="client in clients.data" :key="client.id">
                  <td>
                    <label class="checkboxs">
                      <input type="checkbox" />
                      <span class="checkmarks"></span>
                    </label>
                  </td>
                  <td>{{ client.name }}</td>
                  <td>{{ client.email }}</td>
                  <td>{{ client.address }}</td>
                  <td>{{ client.phone }}</td>
                  <td class="action-table-data">
                    <div class="edit-delete-action">
                      <a class="me-2 p-2" href="javascript:void(0);" data-bs-toggle="modal"
                        data-bs-target="#update-client" @click="setClientToUpdate(client)">
                        <VueFeather type="edit" class="feather-edit" />
                      </a>
                      <a class="confirm-text p-2" @click="showConfirmation('clients.destroy', client.id)"
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
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <div>
            <h4 class="card-title">Fournisseurs Table</h4>
          </div>
          <div class="d-flex gap-2">
            <div class="search-set">
              <div class="search-input">
                <input type="text" v-model="searchFournisseur"
                  @input="searchClients('fournisseur')" placeholder="Search fournisseurs..." />
                <a href="" class="btn btn-searchset"><i data-feather="search" class="feather-search"></i></a>
              </div>
            </div>

            <div>
              <a href="javascript:void(0);" class="project-btn" data-bs-toggle="modal"
                data-bs-target="#add-fournisseur"><vue-feather type="plus-circle" class="me-2"></vue-feather> Add
                fournisseur</a>
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
                  <th>Email</th>
                  <th>Address</th>
                  <th>Phone</th>
                  <th class="no-sort">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="fournisseur in fournisseurs.data" :key="fournisseur.id">
                  <td>
                    <label class="checkboxs">
                      <input type="checkbox" />
                      <span class="checkmarks"></span>
                    </label>
                  </td>
                  <td>{{ fournisseur.name }}</td>
                  <td>{{ fournisseur.email }}</td>
                  <td>{{ fournisseur.address }}</td>
                  <td>{{ fournisseur.phone }}</td>
                  <td class="action-table-data">
                    <div class="edit-delete-action">
                      <a class="me-2 p-2" href="javascript:void(0);" data-bs-toggle="modal"
                        data-bs-target="#update-fournisseur" @click="setFournisseurToUpdate(fournisseur)">
                        <VueFeather type="edit" class="feather-edit" />
                      </a>
                      <a class="confirm-text p-2" @click="showConfirmation('fournisseurs.destroy', fournisseur.id)"
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

      <AddClient />
      <UpdateClient :client="clientToUpdate" />
      <AddFournisseur />
      <UpdateFournisseur :fournisseur="fournisseurToUpdate" />
    </div>
  </div>
</template>

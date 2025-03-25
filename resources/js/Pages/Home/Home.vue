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
import ClickableTriangleClients from '@/Components/utils/ClickableTriangleClients.vue';
import ClickableTriangleFournisseur from '@/Components/utils/ClickableTriangleFournisseur.vue';


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

const  handleSelectionClient = (client) => {
    console.log("Selected client:", client.name);
}

const  handleSelectionFournisseur = (fournisseur) => {
    console.log("Selected fournisseur:", fournisseur.name);
}

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
      <!-- <Statistics /> -->
      
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
            <ClickableTriangleClients :clients="clients" @clientSelected="handleSelectionClient" />
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
            <ClickableTriangleFournisseur :fournisseurs="fournisseurs" @clientSelected="handleSelectionFournisseur" />
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

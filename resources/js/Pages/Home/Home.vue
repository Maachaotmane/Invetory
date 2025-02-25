<script setup>
import { Head } from '@inertiajs/vue3';
import NavLayout from '@/Layouts/NavLayout.vue';
import SideLayout from '@/Layouts/SideLayout.vue';
import VueFeather from 'vue-feather';
import { defineProps } from 'vue';

const props = defineProps({
  clients: Object, // This holds the paginated clients object
});
</script>

<template>
  <Head title="Clients" />

  <NavLayout />
  <SideLayout />

  <div class="page-wrapper">
    <div class="content">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Clients Table</h4>
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
                      <a class="me-2 p-2" href="javascript:void(0);">
                        <VueFeather type="edit" class="feather-edit" />
                      </a>
                      <a class="confirm-text p-2" @click="showConfirmation" href="javascript:void(0);">
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
</template>

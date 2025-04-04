<template>
    <div class="modal fade" id="add-fournisseur">
        <div class="modal-dialog modal-dialog-centered custom-modal-two">
            <div class="modal-content">
                <div class="page-wrapper-new p-0">
                    <div class="content">
                        <div class="modal-header border-0 custom-modal-header">
                            <div class="page-title">
                                <h4>Create Fournisseur</h4>
                            </div>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body p-6 bg-white rounded-lg shadow-lg">
              <form @submit.prevent="submitForm">
                <div class="grid grid-cols-2 gap-4">
                  <div>
                    <label class="block text-gray-700 font-semibold mb-1">Name</label>
                    <input
                      type="text"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                      v-model="form.name"
                    />
                    <span class="text-sm text-red-500" v-if="form.errors.name">
                      {{ form.errors.name }}
                    </span>
                  </div>
                  <div>
                    <label class="block text-gray-700 font-semibold mb-1">C.I.N</label>
                    <input
                      type="text"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                      v-model="form.C_I_N"
                    />
                    <span class="text-sm text-red-500" v-if="form.errors.C_I_N">
                      {{ form.errors.C_I_N }}
                    </span>
                  </div>
                </div>

                <!-- Address Field -->
                

                <!-- Phone & Email Row -->
                <div class="grid grid-cols-3 gap-4">
                  <div>
                  <label class="block text-gray-700 font-semibold mb-1">Address</label>
                  <input
                    type="text"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                    v-model="form.address"
                  />
                  <span class="text-sm text-red-500" v-if="form.errors.address">
                    {{ form.errors.address }}
                  </span>
                </div>
                  <div>
                    <label class="block text-gray-700 font-semibold mb-1">Phone</label>
                    <input
                      type="text"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                      v-model="form.phone"
                    />
                    <span class="text-sm text-red-500" v-if="form.errors.phone">
                      {{ form.errors.phone }}
                    </span>
                  </div>
                  <div>
                    <label class="block text-gray-700 font-semibold mb-1">Email</label>
                    <input
                      type="email"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                      v-model="form.email"
                    />
                    <span class="text-sm text-red-500" v-if="form.errors.email">
                      {{ form.errors.email }}
                    </span>
                  </div>
                </div>

                <!-- Credit Limit & Total Due Amount -->
                <div class="grid grid-cols-2 gap-4 mt-4">
                  <div>
                    <label class="block text-gray-700 font-semibold mb-1">Credit Limit</label>
                    <input
                      type="number"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                      v-model="form.credit_limit"
                    />
                    <span class="text-sm text-red-500" v-if="form.errors.credit_limit">
                      {{ form.errors.credit_limit }}
                    </span>
                  </div>
                  <div>
                    <label class="block text-gray-700 font-semibold mb-1">Total Due Amount</label>
                    <input
                      type="number"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                      v-model="form.total_due_amount"
                    />
                    <span class="text-sm text-red-500" v-if="form.errors.total_due_amount">
                      {{ form.errors.total_due_amount }}
                    </span>
                  </div>
                </div>

                <!-- Country & City Row -->
                <div class="grid grid-cols-2 gap-4 mt-4">
                  <div>
                    <label class="block text-gray-700 font-semibold mb-1">Country</label>
                    <input
                      type="text"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                      v-model="form.country"
                    />
                    <span class="text-sm text-red-500" v-if="form.errors.country">
                      {{ form.errors.country }}
                    </span>
                  </div>
                  <div>
                    <label class="block text-gray-700 font-semibold mb-1">City</label>
                    <input
                      type="text"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                      v-model="form.city"
                    />
                    <span class="text-sm text-red-500" v-if="form.errors.city">
                      {{ form.errors.city }}
                    </span>
                  </div>
                </div>

                <!-- Registration Details -->
                <div class="grid grid-cols-2 gap-4 mt-4">
                  <div>
                    <label class="block text-gray-700 font-semibold mb-1">I.F</label>
                    <input
                      type="text"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                      v-model="form.I_F"
                    />
                    <span class="text-sm text-red-500" v-if="form.errors.I_F">
                      {{ form.errors.I_F }}
                    </span>
                  </div>
                  <div>
                    <label class="block text-gray-700 font-semibold mb-1">R.C</label>
                    <input
                      type="text"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                      v-model="form.R_C"
                    />
                    <span class="text-sm text-red-500" v-if="form.errors.R_C">
                      {{ form.errors.R_C }}
                    </span>
                  </div>
                </div>

                <!-- More Registration Details -->
                <div class="grid grid-cols-2 gap-4 mt-4">
                  <div>
                    <label class="block text-gray-700 font-semibold mb-1">I.C.E</label>
                    <input
                      type="text"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                      v-model="form.I_C_E"
                    />
                    <span class="text-sm text-red-500" v-if="form.errors.I_C_E">
                      {{ form.errors.I_C_E }}
                    </span>
                  </div>
                  <div>
                    <label class="block text-gray-700 font-semibold mb-1">C.N.S.S</label>
                    <input
                      type="text"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                      v-model="form.C_N_S_S"
                    />
                    <span class="text-sm text-red-500" v-if="form.errors.C_N_S_S">
                      {{ form.errors.C_N_S_S }}
                    </span>
                  </div>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-4 mt-6">
                  <button
                    type="button"
                    class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition"
                    data-bs-dismiss="modal"
                  >
                    Cancel
                  </button>
                  <button
                    type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
                  >
                    Create Fournisseur
                  </button>
                </div>
              </form>
            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';


const form = useForm({
    name: '',
    email: '',
    address: '',
    phone: '',
    country: '',
    city: '',
    I_F: "",
    R_C: "",
    I_C_E: "",
    C_N_S_S: "",
    C_I_N: "",
    profile_image: "",
    C_I_N_image: ""
});

const submitForm = () => {
    form.post(route('fournisseurs.store'), {
        onSuccess: () => {
            Swal.fire('Success', 'Fournisseur created successfully!', 'success');
            form.reset();
            document.getElementById('add-fournisseur').classList.remove('show');
            document.querySelector('.modal-backdrop').remove();
            document.body.style.overflow = 'auto';
            document.body.style.paddingRight = '';
        },
        onError: (errors) => {
            Swal.fire('Error', 'Please check the form for errors.', 'error');
        }
    });
};

</script>
<template>
    <div class="modal fade" id="update-fournisseur">
        <div class="modal-dialog modal-dialog-centered custom-modal-two">
            <div class="modal-content">
                <div class="page-wrapper-new p-0">
                    <div class="content">
                        <div class="modal-header border-0 custom-modal-header">
                            <div class="page-title">
                                <h4>Edit Fournisseur</h4>
                            </div>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body custom-modal-body">
                            <form @submit.prevent="submitForm">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" v-model="form.name" />
                                    <span class="text-danger" v-if="form.errors.name">{{ form.errors.name }}</span>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control" v-model="form.address" />
                                    <span class="text-danger" v-if="form.errors.address">{{ form.errors.address
                                    }}</span>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control" v-model="form.phone" />
                                    <span class="text-danger" v-if="form.errors.phone">{{ form.errors.phone }}</span>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" v-model="form.email" />
                                    <span class="text-danger" v-if="form.errors.email">{{ form.errors.email }}</span>
                                </div>

                                <div class="row">
                                    <div class="col mb-3">
                                        <label class="form-label">Country</label>
                                        <input type="text" class="form-control" v-model="form.country" />
                                        <span class="text-danger" v-if="form.errors.country">{{ form.errors.country
                                            }}</span>
                                    </div>
                                    <div class="col mb-3">
                                        <label class="form-label">City</label>
                                        <input type="text" class="form-control" v-model="form.city" />
                                        <span class="text-danger" v-if="form.errors.city">{{ form.errors.city
                                            }}</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end modal-footer-btn">
                                    <button type="button" class="me-2 project-btn-cancel" data-bs-dismiss="modal">
                                        Cancel
                                    </button>
                                    <button type="submit" class="project-btn">Save</button>
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
import { watchEffect } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

const props = defineProps({
    fournisseur: Object,
});

const form = useForm({
    name: '',
    email: '',
    address: '',
    phone: '',
    created_by: '',
    country: '',
    city: '',
});

watchEffect(() => {
    if (props.fournisseur) {
        form.name = props.fournisseur.name;
        form.email = props.fournisseur.email;
        form.address = props.fournisseur.address;
        form.phone = props.fournisseur.phone;
        form.created_by = props.fournisseur.created_by;
        form.country = props.fournisseur.country;
        form.city = props.fournisseur.city;
    }
});

const submitForm = () => {
    form.put(route('fournisseurs.update', props.fournisseur.id), {
        onSuccess: () => {
            Swal.fire('Success', 'Fournisseur updated successfully!', 'success');
            form.reset();
            document.getElementById('update-fournisseur').classList.remove('show');
            document.querySelector('.modal-backdrop').remove();
            document.body.style.overflow = 'auto';
            document.body.style.paddingRight = '';
        },
        onError: () => {
            Swal.fire('Error', 'Please check the form for errors.', 'error');
        }
    });
};
</script>

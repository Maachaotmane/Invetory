<template>
    <div class="modal fade" id="add-category">
        <div class="modal-dialog modal-dialog-centered custom-modal-two">
            <div class="modal-content">
                <div class="page-wrapper-new p-0">
                    <div class="content">
                        <div class="modal-header border-0 custom-modal-header">
                            <div class="page-title">
                                <h4>Create Category</h4>
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
                                    <label class="form-label">Category Code</label>
                                    <input type="text" class="form-control" />
                                </div>
                                <div class="mb-3 input-blocks">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control"></textarea>
                                </div>
                                <div class="d-flex justify-content-end modal-footer-btn">
                                    <button type="button" class="me-2 project-btn-cancel" data-bs-dismiss="modal">
                                        Cancel
                                    </button>
                                    <button type="submit" class="project-btn">Create Category</button>
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
    credit_limit: '',
    total_due_amount: '',
    country: '',
    city: '',
});

const submitForm = () => {
    form.post(route('families.storeCategory'), {
        onSuccess: () => {
            Swal.fire('Success', 'Category created successfully!', 'success');
            form.reset();
            document.getElementById('add-category').classList.remove('show');
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
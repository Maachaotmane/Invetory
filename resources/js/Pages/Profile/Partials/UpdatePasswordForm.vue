<template>
    <div>
        <div class="page-header">
            <div class="page-title">
                <h4>Update Password</h4>
                <h6>Ensure your account is using a long, random password to stay secure.</h6>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="input-blocks">
                            <label class="form-label">Current Password</label>
                            <input
                                type="password"
                                class="form-control"
                                :class="{ 'is-invalid': form.errors.current_password }"
                                v-model="form.current_password"
                                required
                                autocomplete="current-password"
                                ref="currentPasswordInput"
                                aria-describedby="currentPasswordError"
                            />
                            <div id="currentPasswordError" class="invalid-feedback">
                                {{ form.errors.current_password }}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="input-blocks">
                            <label class="form-label">New Password</label>
                            <input
                                type="password"
                                class="form-control"
                                :class="{ 'is-invalid': form.errors.password }"
                                v-model="form.password"
                                required
                                autocomplete="new-password"
                                ref="passwordInput"
                                aria-describedby="passwordError"
                            />
                            <div id="passwordError" class="invalid-feedback">
                                {{ form.errors.password }}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="input-blocks">
                            <label class="form-label">Confirm Password</label>
                            <input
                                type="password"
                                class="form-control"
                                :class="{ 'is-invalid': form.errors.password_confirmation }"
                                v-model="form.password_confirmation"
                                required
                                autocomplete="new-password"
                                aria-describedby="passwordConfirmationError"
                            />
                            <div id="passwordConfirmationError" class="invalid-feedback">
                                {{ form.errors.password_confirmation }}
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <button
                            type="submit"
                            class="btn-submit-css rounded me-2"
                            :disabled="form.processing"
                            @click="updatePassword"
                        >
                            Save
                        </button>
                        <button
                            type="button"
                            class="btn-cancel rounded"
                            @click="form.reset()"
                        >
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const user = usePage().props.auth.user;

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }
            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>
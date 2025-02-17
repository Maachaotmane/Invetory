<template>
    <div>
        <div class="page-header">
            <div class="page-title">
                <h4>Profile</h4>
                <h6>User Profile</h6>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="input-blocks">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" v-model="form.name" required autofocus
                                autocomplete="name" />
                            <div class="invalid-feedback">{{ form.errors.name }}</div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="input-blocks">
                            <label>Email</label>
                            <input type="email" class="form-control" v-model="form.email" required
                                autocomplete="username" />
                            <div class="invalid-feedback">{{ form.errors.email }}</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn-submit-css rounded me-2" :disabled="form.processing"
                            @click="submit">
                            Save
                        </button>
                        <button type="button" class="btn-cancel rounded" @click="form.reset()">
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

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
});

const submit = () => {
    form.patch(route('profile.update'), {
        onFinish: () => form.reset(),
    });
};
</script>

<style scoped>
/* Add your custom styles here */
</style>
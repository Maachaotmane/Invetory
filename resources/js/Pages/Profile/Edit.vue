<script setup>
import NavLayout from '@/Layouts/NavLayout.vue';
import SideLayout from '@/Layouts/SideLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>

    <Head title="Profile" />

    <NavLayout></NavLayout>
    <SideLayout></SideLayout>

    <div class="page-wrapper">
        <div class="content">
            <div class="py-12 mt-5">
                <div class="space-y-6 sm:px-6 lg:px-8">
                    <div class="row">

                        <UpdateProfileInformationForm :must-verify-email="mustVerifyEmail" :status="status" />
                        <UpdatePasswordForm />
                    </div>

                    <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                        <DeleteUserForm class="max-w-xl" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

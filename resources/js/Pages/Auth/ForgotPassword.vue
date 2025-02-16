<template>
    <div class="account-page">
        <div class="account-content">
            <div class="login-wrapper">
                <div class="login-content">
                    <form @submit.prevent="submit" class="w-50">
                        <div class="login-userset">
                            <div class="login-logo logo-normal">
                                <img src="Assets/img/logo.png" alt="img" />
                            </div>
                            <router-link to="/dashboard" class="login-logo logo-white">
                                <img src="Assets/img/logo-white.png" alt="" />
                            </router-link>
                            <div class="login-userheading">
                                <h3>Forgot password?</h3>
                                <h4>
                                    If you forgot your password, well, then we’ll email you instructions to
                                    reset your password.
                                </h4>
                            </div>
                            <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
                                {{ status }}
                            </div>
                            <div class="form-login">
                                <label>Email</label>
                                <div class="form-addons">
                                    <input id="email" type="email" class="form-control"
                                        :class="{ 'is-invalid': form.errors.email }" v-model="form.email" required
                                        autofocus autocomplete="username" />
                                    <img src="Assets/icons/mail.svg" alt="img" />
                                    <div class="invalid-feedback">{{ form.errors.email }}</div>
                                </div>
                            </div>
                            <div class="form-login">
                                <button type="submit" class="btn btn-login" :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing">
                                    Email Password Reset Link
                                </button>
                            </div>
                            <div class="signinform">
                                <h4>
                                    Return to<Link :href="route('login')" class="hover-a text-decoration-none">
                                        login
                                    </Link>
                                </h4>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="login-img">
                    <img src="Assets/img/forgot-02.png" alt="img" />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>
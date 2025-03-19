<template>
    <div class="account-page">
        <div class="account-content">
            <div class="login-wrapper">
                <div class="login-content">
                    <form @submit.prevent="submit" class="w-50">
                        <div class="login-userset">
                            <div class="login-logo logo-normal">
                                <img src="/Assets/img/logo2.png" alt="img" />
                            </div>
                            <p to="/dashboard" class="login-logo logo-white">
                                <img src="/Assets/img/logo-white.png" alt="" />
                            </p>
                            <div class="login-userheading">
                                <h3>Sign In</h3>
                                <h4>Access the panel using your email and passcode.</h4>
                            </div>
                            <div class="form-login">
                                <label>Email Address</label>
                                <div class="form-addons">
                                    <input id="email" type="email" class="form-control"
                                        :class="{ 'is-invalid': form.errors.email }" v-model="form.email" required
                                        autofocus autocomplete="username" />
                                    <div class="invalid-feedback">{{ form.errors.email }}</div>
                                    <img src="/Assets/icons/mail.svg" alt="img" />
                                </div>
                            </div>
                            <div class="form-login">
                                <label>Password</label>
                                <div class="pass-group">
                                    <input id="password" :type="showPassword ? 'text' : 'password'"
                                        class="form-control pass-input mt-2"
                                        :class="{ 'is-invalid': form.errors.password }" v-model="form.password" required
                                        autocomplete="current-password" />
                                    <span @click="toggleShow" class="toggle-password">
                                        <i :class="{
                                            'fas fa-eye': showPassword,
                                            'fas fa-eye-slash': !showPassword,
                                        }"></i>
                                    </span>
                                    <div class="invalid-feedback">{{ form.errors.password }}</div>
                                </div>
                            </div>
                            <div class="form-login authentication-check">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="custom-control custom-checkbox">
                                            <label class="checkboxs ps-4 mb-0 pb-0 line-height-1">
                                                <input type="checkbox" v-model="form.remember" />
                                                <span class="checkmarks"></span>Remember me
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6 text-end">
                                        <Link v-if="canResetPassword" :href="route('password.request')"
                                            class="forgot-link">
                                        Forgot Password?
                                        </Link>
                                    </div>
                                </div>
                            </div>
                            <div class="form-login">
                                <button type="submit" class="btn btn-login" :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing">
                                    Sign In
                                </button>
                            </div>
                            <div class="signinform">
                                <h4>
                                    New on our platform?
                                    <Link :href="route('register')" class="hover-a text-decoration-none">
                                    Create an account</Link>
                                </h4>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="login-img">
                    <img src="/Assets/img/login02.png" alt="img" />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const showPassword = ref(false);

const toggleShow = () => {
    showPassword.value = !showPassword.value;
};

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>
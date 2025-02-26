<template>
    <div class="account-page">
        <div class="account-content">
            <div class="login-wrapper">
                <div class="login-content">
                    <form @submit.prevent="submit" class="w-50">
                        <div class="login-userset">
                            <div class="login-logo logo-normal">
                                <img src="Assets/img/logo2.png" alt="img" />
                            </div>
                            <router-link to="/dashboard" class="login-logo logo-white">
                                <img src="Assets/img/logo-white.png" alt="" />
                            </router-link>
                            <div class="login-userheading">
                                <h3>Register</h3>
                                <h4>Create New Account</h4>
                            </div>
                            <div class="form-login">
                                <label>Name</label>
                                <div class="form-addons">
                                    <input id="name" type="text" class="form-control"
                                        :class="{ 'is-invalid': form.errors.name }" v-model="form.name" required
                                        autofocus autocomplete="name" />
                                    <img src="Assets/icons/user-icon.svg" alt="img" />
                                    <div class="invalid-feedback">{{ form.errors.name }}</div>
                                </div>
                            </div>
                            <div class="form-login">
                                <label>Email Address</label>
                                <div class="form-addons">
                                    <input id="email" type="email" class="form-control"
                                        :class="{ 'is-invalid': form.errors.email }" v-model="form.email" required
                                        autocomplete="username" />
                                    <img src="Assets/icons/mail.svg" alt="img" />
                                    <div class="invalid-feedback">{{ form.errors.email }}</div>
                                </div>
                            </div>
                            <div class="form-login">
                                <label>Password</label>
                                <div class="pass-group">
                                    <input id="password" :type="showPassword ? 'text' : 'password'" class="pass-input"
                                        :class="{ 'is-invalid': form.errors.password }" v-model="form.password" required
                                        autocomplete="new-password" />
                                    <span @click="toggleShowPassword" class="toggle-password">
                                        <i :class="showPassword ? 'fas fa-eye' : 'fas fa-eye-slash'"></i>
                                    </span>
                                    <div class="invalid-feedback">{{ form.errors.password }}</div>
                                </div>
                            </div>
                            <div class="form-login">
                                <label>Confirm Password</label>
                                <div class="pass-group">
                                    <input id="password_confirmation" :type="showConfirmPassword ? 'text' : 'password'"
                                        class="pass-inputs" :class="{ 'is-invalid': form.errors.password_confirmation }"
                                        v-model="form.password_confirmation" required autocomplete="new-password" />
                                    <span @click="toggleShowConfirmPassword" class="toggle-passwords">
                                        <i :class="showConfirmPassword ? 'fas fa-eye' : 'fas fa-eye-slash'"></i>
                                    </span>
                                    <div class="invalid-feedback">{{ form.errors.password_confirmation }}</div>
                                </div>
                            </div>
                            <div class="form-login authentication-check">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="custom-control custom-checkbox justify-content-start">
                                            <div class="custom-control custom-checkbox">
                                                <label class="checkboxs ps-4 mb-0 pb-0 line-height-1">
                                                    <input type="checkbox" v-model="form.terms" />
                                                    <span class="checkmarks"></span>I agree to the
                                                    <a href="javascript:void(0);">Terms & Privacy</a>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-login">
                                <button type="submit" class="btn btn-login" :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing">
                                    Sign Up
                                </button>
                            </div>
                            <div class="signinform">
                                <h4>
                                    Already have an account ?
                                    <Link :href="route('login')" class="hover-a text-decoration-none">Sign In Instead</Link>
                                </h4>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="login-img">
                    <img src="Assets/img/register02.png" alt="img" />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { useForm, Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const showPassword = ref(false);
const showConfirmPassword = ref(false);

const toggleShowPassword = () => {
    showPassword.value = !showPassword.value;
};

const toggleShowConfirmPassword = () => {
    showConfirmPassword.value = !showConfirmPassword.value;
};

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>
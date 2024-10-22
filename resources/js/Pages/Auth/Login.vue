<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
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

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />
        <div class="position-absolute top-50 start-50 translate-middle w-xl-25 w-md-50 px-5 py-5 border border-primary rounded-4 bg-white bg-opacity-75">
            <h2>
                <a href="/">
                    Zamawia-MY
                </a>
            </h2>
            <div v-if="status" class="">
                {{ status }}
            </div>

            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="email" value="Email" />

                    <TextInput
                        id="email"
                        type="email"
                        class=""
                        v-model="form.email"
                        required
                        autofocus
                        autocomplete="username"
                    />

                    <InputError class="" :message="form.errors.email" />
                </div>

                <div class="">
                    <InputLabel for="password" value="Password" />

                    <TextInput
                        id="password"
                        type="password"
                        class=""
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                    />

                    <InputError class="" :message="form.errors.password" />
                </div>

                <div class="">
                    <label class="form-check-label">
                        <Checkbox name="remember" v-model:checked="form.remember" />
                        <span class=""
                            >Remember me</span
                        >
                    </label>
                </div>

                <div class="">
                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="pe-2 link-primary link-offset-2 link-underline-opacity-0 link-underline-opacity-25-hover"
                    >
                        Zapomniałeś hasła?
                    </Link>

                    <PrimaryButton
                        class=""
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Log in
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </GuestLayout>
</template>

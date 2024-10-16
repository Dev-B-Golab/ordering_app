<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});

</script>

<template>
    <Head title="Welcome" />
    <div>
        <div>
            <header>

                <nav v-if="canLogin">
                    <Link
                        v-if="$page.props.auth.user"
                        :href="route('dashboard')"
                    >
                        Dashboard
                    </Link>

                    <template v-else>
                        <Link
                            :href="route('login')"
                        >
                            Log in
                        </Link>

                        <Link
                            v-if="canRegister"
                            :href="route('register')"
                        >
                            Register
                        </Link>
                    </template>
                </nav>
            </header>

            <main>
                
            </main>

            <footer>
            </footer>
        </div>
    </div>
</template>

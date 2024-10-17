<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Background from '@/Components/Background.vue';

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
        <Background/>
        <div class="d-flex vh-100 p-3 mx-auto flex-column">
            <header class="mb-auto">
                <div>
                    <h3 class="float-md-start mb-0">Zamawia-MY!</h3>
                    <nav v-if="canLogin" class="nav nav-masthead justify-content-center float-md-end">
                    <Link
                        v-if="$page.props.auth.user"
                         class="py-1 btn btn-primary"
                        :href="route('dashboard')"
                    >
                        Dashboard
                    </Link>

                    <template v-else>
                        <Link
                            :href="route('login')"
                             class=" py-1 px-2 mx-2 btn btn-primary"
                        >
                            Zaloguj 
                        </Link>

                        <Link
                            v-if="canRegister"
                            :href="route('register')"
                             class=" py-1 px-2 mx-2 btn btn-primary"
                        >
                            Zarejestruj
                        </Link>
                    </template>
                </nav>
                </div>
            </header>

            <main class="px-3 text-center">
                <h1>Organizer zamawiania jedzenia <i class="bi bi-emoji-grin"></i></h1>
                <p class="lead">Pomoże podjąć decyzje skąd zamówić jedzonko oraz zorganizuje zamówienie
                    tak, by o nikim nie zapomnaino ^^
                </p>
                <p class="lead">
                <a href="#" class="btn btn-lg btn-primary fw-bold">ZAMAWIAM!</a>
                </p>
            </main>

            <footer class="mt-auto float-md-end">
                <p>Nie daj się prosić...</p>
            </footer>
        </div>
    </div>
</template>

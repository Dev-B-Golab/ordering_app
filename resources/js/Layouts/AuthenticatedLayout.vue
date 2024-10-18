<script setup>
// import { ref } from 'vue';
// import ApplicationLogo from '@/Components/ApplicationLogo.vue';
// import Dropdown from '@/Components/Dropdown.vue';
// import DropdownLink from '@/Components/DropdownLink.vue';
// import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
// import { Link } from '@inertiajs/vue3';
import Background from '@/Components/Background.vue';


// const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <Background/>
        <nav class="navbar navbar-expand-md">
            <div class="container-fluid">
                <ResponsiveNavLink href="/"
                            class="navbar-brand">
                             <h3>Zamawia-MY</h3>
                            </ResponsiveNavLink>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                    <div class="collapse navbar-collapse" id="navbar">
                    <ul class="navbar-nav me-auto mb-2 mb-sm-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">Zamówienie</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">Historia zamówień</a>
                        </li>
                        <li class="nav-item">
                            <ResponsiveNavLink :href="route('profile.edit')"
                            class="nav-link">
                                Profil
                            </ResponsiveNavLink>
                        </li>
                        <li class="nav-item">
           
                        </li>
                    </ul>
                    <ResponsiveNavLink
                            :href="route('logout')"
                            class="nav-link"
                            method="post"
                            as="button"
                        >
                            Wyloguj
                        </ResponsiveNavLink>
                </div>
            </div>
        </nav>
        <!-- Page Heading -->
        <header
            class=""
            v-if="$slots.header"
        >
            <div class="">
                <slot name="header" />
            </div>
        </header>
        <!-- Page Content -->
        <main>
            <slot />
        </main>
    </div>
</template>

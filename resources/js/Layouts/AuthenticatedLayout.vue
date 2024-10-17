<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';
import Background from '@/Components/Background.vue';


const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <Background/>
        <div class="">
            <nav
                class=""
            >
                <!-- Primary Navigation Menu -->
                <div class="">
                    <div class="">
                        <div class="">

                            <!-- Navigation Links -->
                            <div
                                class=""
                            >
                                <NavLink
                                    :href="route('dashboard')"
                                    :active="route().current('dashboard')"
                                >
                                    Dashboard
                                </NavLink>
                            </div>
                        </div>

                        <div class="">
                            <!-- Settings Dropdown -->
                            <div class="">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="i">
                                            <button
                                                type="button"
                                                class=""
                                            >
                                                {{ $page.props.auth.user.name }}

                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink
                                            :href="route('profile.edit')"
                                        >
                                            Profile
                                        </DropdownLink>
                                        <DropdownLink
                                            :href="route('logout')"
                                            method="post"
                                            as="button"
                                        >
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                      
                        
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{
                        block: showingNavigationDropdown,
                        hidden: !showingNavigationDropdown,
                    }"
                    class=""
                >
                    <div class="">
                        <ResponsiveNavLink
                            :href="route('dashboard')"
                            :active="route().current('dashboard')"
                        >
                            Dashboard
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div
                        class=""
                    >
                        <div class="">
                            <div
                                class=""
                            >
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="">
                                {{ $page.props.auth.user.email }}
                            </div>
                        </div>

                        <div class="">
                            <ResponsiveNavLink :href="route('profile.edit')">
                                Profile
                            </ResponsiveNavLink>
                            <ResponsiveNavLink
                                :href="route('logout')"
                                method="post"
                                as="button"
                            >
                                Log Out
                            </ResponsiveNavLink>
                        </div>
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
    </div>
</template>

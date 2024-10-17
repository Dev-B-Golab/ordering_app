<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
  <Head title="Menu"/>
  <AuthenticatedLayout>
    <template #header>
      <div>
        XD
      </div>
    </template>
    <div>
      <p>dupa</p>
      <!-- <h1>Menu Restauracji</h1>
      <ul v-if="menu.length">
        <li v-for="item in menu" :key="item.name">
          {{ item.name }} - {{ item.price }}
        </li>
      </ul>
      <p v-else>Nie udało się załadować menu lub jest puste.</p> -->
    </div>
  </AuthenticatedLayout>
</template>


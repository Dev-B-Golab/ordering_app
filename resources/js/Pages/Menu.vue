<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    menuData: {
        type: Object,
    },
});
</script>

<template>
  <Head title="Menu"/>
  <AuthenticatedLayout>
    <template #header>
      <div class="container-fluid">
        <h2 class="text-primary">
            Wybierz z lokalu: {{ menuData['name'] }}
        </h2>
      </div>
    </template>
    <div class="container-fluid">
      <div class="position-absolute top-50 start-50 translate-middle w-75 h-75 px-5 py-5 border border-primary rounded-4 bg-white bg-opacity-75">
        <div class="row mb-5">
          <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
              <label class="btn btn-outline-primary" v-for="categories in menuData.categories" :for="categories.id">
              <input type="radio" class="btn-check" name="btnradio" :id="categories.id" >
              {{ categories.category_name }}</label>
          </div>
        </div>
        <div class="row " style="overflow-y:auto; max-height:500px;" >
          <table class="table table-striped table-bordered table-responsive text-center">
            <thead>
              <tr class="sticky-top table-primary">
                <th>Pozycja</th>
                <th>Cena</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="products in menuData.menu_positions">
                <td>{{ products.position_name }}</td>
                <td>
                 <p v-for="positions in products.position_values">{{positions}}</p> 
                </td>
              </tr>
            </tbody>
          </table>
          {{ menuData }}
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
<script>

export default {
  data() {
    return {
      columns: [
      'name', 'email'
      ],
      rows: [
        { name: 'John Doe', email: 'john@example.com' },
        { name: 'Jane Smith', email: 'jane@example.com' },
        // Add more data as necessary
      ],
      options:{

      },
    };
  },
};
</script>

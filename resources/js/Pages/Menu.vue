<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    test: {
        type: Array,
    },
});
</script>

<template>
  <Head title="Menu"/>
  <AuthenticatedLayout>
    <template #header>
      <div class="container-fluid">
        <h2 class="text-primary">
            Wybierz z menu
        </h2>
      </div>
    </template>
    <div class="container-fluid">
      <div class="position-absolute top-50 start-50 translate-middle w-75 h-75 px-5 py-5 border border-primary rounded-4 bg-white bg-opacity-75">
        <div class="row mb-5">
          <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
            <label class="btn btn-outline-primary" for="btnradio1">Pizza</label>

            <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
            <label class="btn btn-outline-primary" for="btnradio2">Burgir</label>

            <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
            <label class="btn btn-outline-primary" for="btnradio3">Sauatka</label>
          </div>
        </div>
        <div class="row">
          <table class="table table-striped table-bordered table-responsible text-center">
            <thead>
              <tr>
                <th>Pozycja</th>
                <th>Cena</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>xx</td>
                <td>dd</td>
                <td><button class="btn btn-success"><i class="bi bi-plus-lg"></i></button></td>
              </tr>
            </tbody>
          </table>
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

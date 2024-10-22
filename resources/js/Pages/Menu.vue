<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, watchEffect  } from 'vue';

const props = defineProps({
  menuData: {
    type: Object,
    required: true,
  },
});

const selectedCategory = ref(null);

watchEffect(() => {
  if (props.menuData.categories && props.menuData.categories.length > 0) {
    selectedCategory.value = props.menuData.categories[0].id;
  }
});

</script>

<template>
  <Head title="Menu"/>
  <AuthenticatedLayout>
    <template #header>
      <div class="container-fluid">
        <h2 class="text-primary">
            Wybierz z lokalu: {{ menuData.name }}
        </h2>
      </div>
    </template>   
    <div class="container-fluid">
      <div class="position-absolute top-50 start-50 translate-middle w-75 h-75 px-5 py-5 border border-primary rounded-4 bg-white bg-opacity-75">
        <div class="row mb-5">
          <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
            <label class="btn btn-outline-primary" 
                   v-for="category in menuData.categories" 
                   :key="category.id" 
                   :for="category.id" 
                   :class="{'active': selectedCategory === category.id}">
              <input type="radio" 
                     class="btn-check" 
                     name="btnradio" 
                     :id="category.id" 
                     :value="category.id" 
                     v-model="selectedCategory">
              {{ category.category_name }}
            </label>
          </div>
        </div>
        <div class="row border border-primary" style="overflow-y:auto; max-height:90%;">
          <table class="table table-striped table-bordered table-responsive text-center">
            <thead>
              <tr class="sticky-top table-primary">
                <th>Pozycja</th>
                <th>Cena</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="products in menuData.menu_positions" :key="products.id">
                <td v-if="products.position_category == selectedCategory">{{ products.position_name }}<br>{{ products.description.pl }}</td>
                <td v-if="products.position_category == selectedCategory">
                  <div v-for="positions in products.position_values">
                    <button v-if="positions" :key="positions"
                      class="btn btn-success my-1">{{ positions }} 
                      <i class="bi bi-bag-plus"></i>
                    </button> 
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
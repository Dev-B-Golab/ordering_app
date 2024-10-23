<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

</script>

<template>
  <Head title="createOrder"/>
  <AuthenticatedLayout>
    <template #header>
      <div class="container-fluid">
        <h2 class="text-primary">
            Utwórz zamówienie
        </h2>
      </div>
    </template>   
    <div class="container-fluid">
        <div class="position-absolute top-50 start-50 translate-middle w-25 h-50 px-5 py-5 border border-primary rounded-4 bg-white bg-opacity-75">    
            <form @submit.prevent="submitForm" class=" ">
                <div class="row my-5">
                    <label for="restaurant" class="form-label">Wybierz restauracje:</label>
                    <select class="form-select" name="" id="restaurant" v-model="form.restaurant">
                        <option value="1">Pod 8</option>
                        <option value="2">Doner ale nie dziala</option>
                    </select>
                </div>
                <div class="row my-5">
                    <label for="end_time" class="form-label">Koniec zamawiania:</label>
                    <input
                        id="end_time"
                        class="form-control"
                        type="datetime-local"
                        name="end_time"
                        v-model="form.end_time"
                    />
                </div>
                <div class="row my-5">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_private" id="is_private" v-model="form.private">
                    <label class="form-check-label" for="is_private">
                      Prywatne zamówienie ?
                    </label>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Utwórz</button>
                </div>
            </form>
        </div> 
    </div> 
  </AuthenticatedLayout>
</template>
<script>
export default {
  data() {
    return {
      form: {
        restaurant: '',
        end_time: '',
        private: false,
      },
    };
  },
  methods: {
    async submitForm() {
      try {
        await this.$inertia.post('/insertOrder', this.form);
        this.form.restaurant = '';
        this.form.restaurant = '';
        this.form.private = false;
      } catch (error) {
        console.error('Błąd:', error);
      }
    },
  },
};
</script>
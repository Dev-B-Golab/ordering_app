<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ModalComponent from '/resources/js/Components/Modal.vue'; 
import { Head, Link } from '@inertiajs/vue3';
import { ref, watchEffect } from 'vue';

const props = defineProps({
  menuData: {
    type: [Object, null],
    required: true,
  },
  order_data: {
    type: [Object, null],
    required: true,
  },
  share_link: {
    type: [String, null],
    required: true,
  },
  id_user: {
    type:  [Number],
  },
});

const showModal = ref(false);
const idModal = ref('');
const copyToClipboard = () => {
  if (navigator.clipboard) {
    navigator.clipboard.writeText(props.share_link)
      .then(() => {
        alert('Skopiowano: ' + props.share_link);
      })
      .catch(err => {
        console.error('Błąd przy kopiowaniu: ', err);
      });
  } else {
    const textarea = document.createElement('textarea');
    textarea.value = props.share_link;
    textarea.style.position = 'fixed';  
    textarea.style.opacity = '0';       

    document.body.appendChild(textarea);
    textarea.focus();
    textarea.select();

    try {
      document.execCommand('copy');
      alert('Skopiowano: ' + props.share_link);
    } catch (err) {
      console.error('Błąd przy kopiowaniu: ', err);
    }

    document.body.removeChild(textarea);
  }
};

const selectedCategory = ref(null);

const selectedOrders = [];

let bucketCount = ref(0);
let bucketSumPrice = ref(0);


// const addToOrder = (product, position) => {
//     // Sprawdzamy, czy istnieje zamówienie dla użytkownika
//     if (!selectedOrders[props.id_user]) {
//         selectedOrders[props.id_user] = {};
//     }

//     // Jeśli produkt nie istnieje w zamówieniu, dodajemy go
//     if (!selectedOrders[props.id_user][product.id]) {
//         const order = { quantity: {} }; // Inicjalizujemy obiekt quantity
        
//         // Inicjalizujemy ilości na podstawie wartości w position_values
//         product.position_values.forEach((value, index) => {
//             // Sprawdzamy, która wartość została dodana
//             if (value === position) {
//                 order.quantity[index] = 1; // Ustawiamy ilość na 1 dla odpowiedniego klucza
//             } else {
//                 order.quantity[index] = 0; // Ustawiamy ilość na 0 dla innych
//             }
//         });

//         selectedOrders[props.id_user][product.id] = {
//             name: product.position_name,
//             order: {
//                 ...order,
//                 prices: product.position_values, // Przechowujemy ceny
//             }
//         };
//     } else {
//         // Produkt już istnieje, więc zwiększamy ilość dla odpowiedniej wartości
//         product.position_values.forEach((value, index) => {
//             if (value === position) {
//                 selectedOrders[props.id_user][product.id].order.quantity[index] += 1; // Zwiększamy ilość
//             }
//         });
//     }

//     // Aktualizujemy sumę i liczbę w koszyku
//     bucketSumPrice.value += position; // Dodajemy wartość pozycji do sumy
//     bucketCount.value++;
//     console.log(selectedOrders);
// };
// const removeFromOrder = (product, position) => {
//     // Sprawdzamy, czy istnieje zamówienie dla użytkownika
//     if (selectedOrders[props.id_user] && selectedOrders[props.id_user][product.id]) {
//         const order = selectedOrders[props.id_user][product.id].order;

//         // Iterujemy po wartości w position_values, aby znaleźć odpowiednią ilość do zmniejszenia
//         product.position_values.forEach((value, index) => {
//             if (value === position) {
//                 // Zmniejszamy ilość tylko dla odpowiedniego klucza
//                 order[`quantity${index}`] -= 1; 

//                 // Jeśli ilość osiągnie 0, usuwamy ten klucz
//                 if (order[`quantity${index}`] <= 0) {
//                     delete order[`quantity${index}`];
//                 }
//             }
//         });

//         // Sprawdzamy, czy pozostały jakieś ilości w zamówieniu
//         if (Object.keys(order).length === 0) {
//             delete selectedOrders[props.id_user][product.id]; // Usuwamy produkt, jeśli nie ma już ilości
//         }

//         // Aktualizujemy sumę i liczbę w koszyku
//         bucketSumPrice.value -= position; // Odejmujemy wartość pozycji od sumy
//         bucketCount.value--;

//         // Upewniamy się, że sumy i liczby nie są ujemne
//         if (bucketSumPrice.value < 0) bucketSumPrice.value = 0;
//         if (bucketCount.value < 0) bucketCount.value = 0;
//     }
// };

watchEffect(() => {
  if (props.menuData != null && props.menuData.categories && props.menuData.categories.length > 0) {
    selectedCategory.value = props.menuData.categories[0].id;
  }
});

</script>

<template>
  <Head title="Menu"/>
  <AuthenticatedLayout>
    <template #header>
      <div class="container-fluid">
        <h2 class="text-primary" v-if="menuData != null">
            Wybierz z lokalu: {{ menuData.name }}
        </h2>
        <h2 class="text-primary" v-else>
            Coś poszło nie tak... <i class="bi bi-emoji-tear"></i>
        </h2>
      </div>
    </template>   
    <div class="container-fluid">
      <div class="position-absolute top-50 start-50 translate-middle w-75 h-75 px-5 py-5 border border-primary rounded-4 bg-white bg-opacity-75">
        <div class="row my-2">
          <div class="col-sm-10">
            <div class="input-group mb-3">
              <input type="text" class="form-control" :value="share_link" disabled  aria-label="" aria-describedby="copy-btn">
              <button class="btn btn-outline-primary" type="button" id="copy-btn" @click="copyToClipboard">Kopiuj</button>
            </div>
          </div>
          <div class="col-sm-1 offset-sm-1">
            <div class="dropdown">
              <button class="btn btn-primary position-relative dropdown-toggle" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-basket2"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" v-if="bucketCount > 0">
                  {{ bucketCount }}
                  <span class="visually-hidden">unread messages</span>
                </span>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="z-index: 9999;">
                <li v-for="(item, index) in selectedOrders[props.id_user]" :key="index">
                  <p class="dropdown-item">{{ item.name }}
                    <button class="btn btn-sm btn-danger ms-2" >
                      <i class="bi bi-trash"></i>
                    </button>
                  </p>
                </li>
                  <li>
                    <p class="dropdown-item">Razem: {{ bucketSumPrice/100 }}zł<button class="btn btn-sm btn-primary ms-2" :disabled="bucketCount <= 0">Zamów</button></p>
                  </li>
                </ul>
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <div class="btn-group" role="group" aria-label="Basic radio toggle button group" v-if="menuData != null">
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
        <div class="row border border-primary" style="overflow-y:auto; max-height:75%;">
          <table class="table table-striped table-bordered table-responsive text-center">
            <thead>
              <tr class="sticky-top table-primary">
                <th>Pozycja</th>
                <th>Cena</th>
              </tr>
            </thead>
            <tbody v-if="menuData != null">
              <tr v-for="products in menuData.menu_positions" :key="products.id">
                <td v-if="products.position_category == selectedCategory"><h5><b>{{ products.position_name }}</b></h5><br>{{ products.description.pl }}</td>
                <td v-if="products.position_category == selectedCategory">
                  <div>
                    <button class="btn btn-success my-1" @click="showModal = true, idModal = products.id">
                      <i class="bi bi-bag-plus"></i>
                    </button>
                  </div>
                </td>
              </tr>
            </tbody>
            <tbody v-else>
              <tr>
                <td colspan="2">Brak danych</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="row" v-if="menuData == null">
          <Link
              class="btn btn-lg btn-primary fw-bold"
              :href="route('createOrder')"
          >
              Wyjdź
            </Link>
        </div>
      </div>
    </div>
    <ModalComponent v-model:show="showModal" @close="showModal = false" title="Opcje pozycji" :id_position="idModal">
      <p>Rozmiar:xd</p>
    </ModalComponent>
  </AuthenticatedLayout>
</template>
<template>
    <div>
      <h1>Menu Restauracji</h1>
      <ul v-if="menu.length">
        <li v-for="item in menu" :key="item.name">
          {{ item.name }} - {{ item.price }}
        </li>
      </ul>
      <p v-else>Nie udało się załadować menu lub jest puste.</p>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      menu: {
        type: Array,
        required: true,
        default: () => [],
      }
    }
  };
  </script>
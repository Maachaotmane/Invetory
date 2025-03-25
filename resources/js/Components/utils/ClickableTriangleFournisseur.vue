<template>
    <div class="rectangle-container row justify-content-center m-0">
        <div v-for="fournisseur in fournisseurs" :key="fournisseur.id" class="rectangle col" @click="selectClient(fournisseur)">
            <span class="rectangle-text">{{ fournisseur.name }}</span>
        </div>
    </div>
  </template>
  
  <script setup>
  import { defineProps, defineEmits } from 'vue';
  
  const props = defineProps({
    fournisseurs: Array
  });
  
  const emit = defineEmits(['clientSelected']);
  
  const selectClient = (fournisseur) => {
    emit('clientSelected', fournisseur);
  };
  </script>
  
  <style scoped>
  .rectangle-container {
    /* display: flex;
    flex-wrap: wrap; */
    gap: 6px;
    max-width: calc(22 * 110px); /* Max 10 rectangles per row */
    max-height: calc(4 * 75px); /* Max 6 rows */
    overflow: auto;
    padding: 10px;
  }
  
  .rectangle {
    /* width: 100px; */
    min-width: 130px;
    max-width: 160px;
    height: 50px;
    background-color: #f1a650;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    color: rgb(0, 0, 0);
    font-weight: bold;
    border-radius: 5px;
    text-align: center;
  }
  
  .rectangle:hover {
    background-color: #c18035;
    color: #ffffff;
  }
  </style>

<template>

    <Head title="Product" />

    <NavLayout />
    <SideLayout />

    <div class="page-wrapper">
        <div class="content">
       
           <ProductListHeader :fournisseurs="fournisseurs" :categories="categories"/>
        </div>
    </div>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import NavLayout from '@/Layouts/NavLayout.vue';
import SideLayout from '@/Layouts/SideLayout.vue';
import ProductListHeader from '@/Components/product/CreateProduct.vue';
import { ref, defineProps } from "vue";

const props = defineProps({
  categories: Array,
  fournisseurs: Array,
});
</script>
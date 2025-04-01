<template>
    <Head title="Product" />

    <NavLayout />
    <SideLayout />

    <div class="page-wrapper">
        <div class="content">
            <ProductListHeader />
            <ProductTable :products="products" :categories="categories" />
        </div>
    </div>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import NavLayout from '@/Layouts/NavLayout.vue';
import SideLayout from '@/Layouts/SideLayout.vue';
import ProductListHeader from '@/Components/product/ProductListHeader.vue';
import ProductTable from '@/Components/product/ProductTable.vue';

defineProps({
    products: Object,
    categories: Array,
});
</script>
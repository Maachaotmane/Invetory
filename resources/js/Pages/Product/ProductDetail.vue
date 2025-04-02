<template>
  <Head title="Product-detail" />
  <NavLayout />
  <SideLayout />

  <ProductDetail :product="product"/>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import NavLayout from "@/Layouts/NavLayout.vue";
import SideLayout from "@/Layouts/SideLayout.vue";
import ProductDetail from "@/Components/product/ProductDetail.vue";

defineProps({
    product: Object,
});
</script>

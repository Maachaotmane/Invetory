<script setup>
import { Head } from '@inertiajs/vue3';
import NavLayout from '@/Layouts/NavLayout.vue';
import SideLayout from '@/Layouts/SideLayout.vue';
import { defineProps } from 'vue';
import CategoryMatrix from '@/Components/utils/CategoryMatrix.vue';

const props = defineProps({
    categories: Array,
});


</script>

<template>

  <Head title="Etat Stock" />

  <NavLayout />
  <SideLayout />

<div class="page-wrapper">
    <div class="content">      
        <div class="card">
            <div>
                <Head title="Category Statistics" />
            </div>
            <div class="p-6">
                <h1 class="text-2xl font-bold text-gray-900 mb-6">Category Statistics</h1>
                
                <div class="grid grid-cols-1 gap-6">
                    <template v-for="category in categories" :key="category.id">
                    <CategoryMatrix 
                        :category="category"
                        :x-axis="category.x_axis"
                        :y-axis="category.y_axis"
                    />
                    </template>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

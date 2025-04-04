<template>
  <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
    <div class="p-4 border-b">
      <h3 class="text-lg font-medium">{{ category.name }}</h3>
      <p class="text-sm text-gray-500">
        {{ xAxisLabel }} (X) vs {{ yAxisLabel }} (Y) • {{ category.product_count }} products
      </p>
    </div>
    
    <div class="relative overflow-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50 sticky top-0 z-10">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sticky left-0 bg-gray-50 z-20">
              {{ yAxisLabel }} \ {{ xAxisLabel }}
            </th>
            <th 
              v-for="xItem in category.x_items" 
              :key="xItem.id"
              class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
            >
              {{ xItem.name }}
            </th>
          </tr>
        </thead>
        
        <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="yItem in category.y_items" :key="yItem.id">
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 sticky left-0 bg-white z-10">
              {{ yItem.name }}
            </td>
            <td 
              v-for="xItem in category.x_items" 
              :key="xItem.id"
              class="px-6 py-4 whitespace-nowrap text-sm text-center"
            >
              <button 
                @click="openModal(xItem, yItem)"
                class="text-blue-600 hover:text-blue-800 hover:underline"
                :disabled="getProductCount(xItem, yItem) === 0"
                :class="{'opacity-50 cursor-default': getProductCount(xItem, yItem) === 0}"
              >
                {{ getProductCount(xItem, yItem) }}
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Modal -->
    <Modal :show="showModal" @close="showModal = false" max-width="3xl">
    <div class="p-6">
      <h2 class="text-lg font-medium mb-4">
        Products in {{ category.name }} ({{ currentX?.name }} vs {{ currentY?.name }})
      </h2>
      
      <div class="overflow-auto max-h-96">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Reference</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Measure</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sub Measure</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Unit</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Brand</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="product in filteredProducts" :key="product.id">
              <td class="px-6 py-4 whitespace-nowrap">{{ product.name }}</td>
              <td class="px-6 py-4 whitespace-nowrap">{{ product.reference }}</td>
              <td class="px-6 py-4 whitespace-nowrap">{{ product.category }}</td>
              <td class="px-6 py-4 whitespace-nowrap">{{ product.measure }}</td>
              <td class="px-6 py-4 whitespace-nowrap">{{ product.subMeasure }}</td>
              <td class="px-6 py-4 whitespace-nowrap">{{ product.unit }}</td>
              <td class="px-6 py-4 whitespace-nowrap">{{ product.brand }}</td>
              <td class="px-6 py-4 whitespace-nowrap">{{ product.type }}</td>
              <td class="px-6 py-4 whitespace-nowrap">{{ product.quantity }}</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <Link
                    :href="`/product-detail/${product.id}`"
                    method="get"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="me-2 p-2"
                  >
                    <VueFeather type="eye" class="feather-eye" />
                  </Link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="mt-6 flex justify-end">
        <button 
          @click="showModal = false" 
          class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600"
        >
          Close
        </button>
      </div>
    </div>
  </Modal>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import Modal from '@/Components/Modal.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  category: {
    type: Object,
    required: true,
    default: () => ({
      x_items: [],
      y_items: [],
      products: []
    })
  },
  xAxis: String,
  yAxis: String
});


const showModal = ref(false);
const currentX = ref(null);
const currentY = ref(null);

// Computed properties
const xAxisLabel = computed(() => {
  return props.xAxis?.charAt(0).toUpperCase() + props.xAxis?.slice(1) || 'X';
});

const yAxisLabel = computed(() => {
  return props.yAxis?.charAt(0).toUpperCase() + props.yAxis?.slice(1) || 'Y';
});

const getProductCount = (xItem, yItem) => {
  if (!props.category.products) return 0;
  
  // Use singular form for field names
  const xField = `${props.xAxis.slice(0, -1)}_id`;
  const yField = `${props.yAxis.slice(0, -1)}_id`;
  
  return props.category.products.filter(product => {
    const xMatch = product[xField] === xItem.id;
    const yMatch = product[yField] === yItem.id;
    return xMatch && yMatch;
  }).length;
};

const openModal = (xItem, yItem) => {
  currentX.value = xItem;
  currentY.value = yItem;
  showModal.value = true;
};

const filteredProducts = computed(() => {
  if (!currentX.value || !currentY.value || !props.category.products) return [];

  const xField = `${props.xAxis.slice(0, -1)}_id`;
  const yField = `${props.yAxis.slice(0, -1)}_id`;
  
  return props.category.products.filter(product => {
    const xMatch = product[xField] === currentX.value.id;
    const yMatch = product[yField] === currentY.value.id;
    return xMatch && yMatch;
  });
});
</script>

<style scoped>
.relative {
  position: relative;
}
.sticky {
  position: sticky;
}
</style>
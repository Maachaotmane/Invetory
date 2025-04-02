<template>
  <div class="card table-list-card">
    <div class="card-body">
      <div class="table-top">
        <div class="search-set">
          <div class="search-input">
            <input
              type="text"
              v-model="searchQuery"
              placeholder="Search"
              class="dark-input"
            />
            <a href="javascript:void(0);" class="btn btn-searchset">
              <i data-feather="search" class="feather-search"></i>
            </a>
          </div>
        </div>
        <div class="form-sort">
          <vue-feather type="sliders" class="info-img cursor-pointer"  @click="showFilter = !showFilter"></vue-feather>
        </div>
      </div>

      <div class="row w-100 px-4" v-if="showFilter">
        <div class="col-lg-2 col-sm-6 col-12">
          <div class="mb-1">
            <VueMultiselect
              v-model="form.category_id"
              :options="categories"
              label="name"
              track-by="id"
              @update:modelValue="fetchRelatedData"
              placeholder="Choose category"
            />
          </div>
        </div>

        <div class="col-lg-2 col-sm-6 col-12">
          <div class="mb-1">
            <VueMultiselect
              v-model="form.unit_id"
              :options="units"
              label="name"
              track-by="id"
              placeholder="Choose unit"
            />
          </div>
        </div>

        <div class="col-lg-2 col-sm-6 col-12">
          <div class="mb-1">
            <VueMultiselect
              v-model="form.brand_id"
              :options="brands"
              label="name"
              track-by="id"
              placeholder="Choose brand"
            />
          </div>
        </div>

        <div class="col-lg-2 col-sm-6 col-12">
          <div class="mb-1">
            <VueMultiselect
              v-model="form.type_id"
              :options="types"
              label="name"
              track-by="id"
              placeholder="Choose type"
            />
          </div>
        </div>

        <div class="col-lg-2 col-sm-6 col-12">
          <div class="mb-1">
            <VueMultiselect
              v-model="form.measure_id"
              :options="measures"
              label="name"
              track-by="id"
              placeholder="Choose measure"
            />
          </div>
        </div>

        <div class="col-lg-2 col-sm-6 col-12 page-btn">
          <div class="col-lg-6 col-sm-6 col-12 page-btn">
            <a href="javascript:void(0);" class="project-btn" @click="filterQueries"> Search </a>
          </div>
        </div>
      </div>

      <div class="table-responsive product-list">
        <a-table
          class="table datanew table-hover table-center mb-0"
          :columns="columns"
          :data-source="filteredData"
          :pagination="pagination"
          @change="handleTableChange"
        >
          <template #bodyCell="{ column, record }">
            <template v-if="column.key === 'Product'">
              <div class="productimgname">
                <a href="javascript:void(0);" class="product-img stock-img">
                  <img
                    v-if="record.images.length > 0"
                    :src="`/storage/${record.images[0].name}`"
                    alt=""
                  />
                  <img v-else src="/Assets/img/default-product.png" alt="" />
                </a>
                <a href="javascript:void(0);" class="text-decoration-none">{{
                  record.name
                }}</a>
              </div>
            </template>
            <template v-else-if="column.key === 'Gender'">
              <td class="userimgname">
                <span
                  :class="[
                    'badge',
                    record.Gender ? 'badge-warning' : 'badge-success',
                  ]"
                >
                  {{ record.Gender ? "variant" : "single" }}
                </span>
              </td>
            </template>

            <template v-else-if="column.key === 'action'">
              <td class="action-table-data">
                <div class="edit-delete-action">
                  <a
                    class="me-2 p-2"
                    href="javascript:void(0);"
                    data-bs-toggle="modal"
                    data-bs-target="#update-client"
                    @click="setClientToUpdate(record)"
                  >
                    <VueFeather type="eye" class="feather-eye" />
                  </a>
                  <a
                    class="me-2 p-2"
                    href="javascript:void(0);"
                    data-bs-toggle="modal"
                    data-bs-target="#update-client"
                    @click="setClientToUpdate(record)"
                  >
                    <VueFeather type="edit" class="feather-edit" />
                  </a>
                  <a
                    class="confirm-text p-2"
                    @click="showConfirmation('products.destroy', record.id)"
                    href="javascript:void(0);"
                  >
                    <VueFeather type="trash-2" class="feather-trash-2" />
                  </a>
                </div>
              </td>
            </template>
          </template>
        </a-table>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, watch, defineProps } from "vue";
import Swal from "sweetalert2";
import VueFeather from "vue-feather";
import { router } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";
import VueMultiselect from "vue-multiselect";
import apiClient from "@/api";

const props = defineProps({
  products: Object,
  categories: Array,
});

const showFilter = ref(false);
const searchQuery = ref("");
const currentPage = ref(props.products.current_page);
const pagination = ref({
  current: props.products.current_page,
  pageSize: props.products.per_page,
  total: props.products.total,
});

const form = useForm({
  category_id: null,
  unit_id: null,
  brand_id: null,
  type_id: null,
  measure_id: null,
  sub_category_id: null,
  sub_measure_id: null,
});

const units = ref([]);
const brands = ref([]);
const types = ref([]);
const measures = ref([]);
const subCategories = ref([]);
const subMeasures = ref([]);
const loading = ref(false);

const fetchRelatedData = async () => {
  form.brand_id = null;
  form.sub_category_id = null;
  form.sub_measure_id = null;
  form.measure_id = null;
  form.unit_id = null;
  form.type_id = null;

  if (!form.category_id?.id) {
    units.value = [];
    brands.value = [];
    types.value = [];
    measures.value = [];
    subCategories.value = [];
    subMeasures.value = [];
    return;
  }

  loading.value = true;

  try {
    const response = await apiClient.get(
      "/product/related-data/" + form.category_id.id
    );

    units.value = response.data.units;
    brands.value = response.data.brands;
    types.value = response.data.types;
    measures.value = response.data.measures;
    subCategories.value = response.data.subCategories;
    subMeasures.value = response.data.subMeasures;
  } catch (err) {
    console.error(err);
  } finally {
    loading.value = false;
  }
};

const tableData = computed(() =>
  props.products.data.map((product) => ({
    key: product.id,
    id: product.id,
    name: product.name,
    reference: product.reference,
    Category: product.category?.name || "N/A",
    Brand: product.brand?.name || "N/A",
    Price: product.variants[0]?.price || "N/A",
    Unit: product.unit?.name || "N/A",
    Qty: product.variants[0]?.quantity || "N/A",
    Qty_Alert: product.variants[0]?.quantity_alert || "N/A",
    Gender: product.variants[0]?.variant,
    images: product.images,
  }))
);

const filteredData = computed(() =>
  tableData.value.filter((item) =>
    Object.values(item).some((val) =>
      String(val).toLowerCase().includes(searchQuery.value.toLowerCase())
    )
  )
);

const handleTableChange = (pag) => {
  router.get(
    props.products.path,
    { page: pag.current },
    { preserveState: true }
  );
};

const showConfirmation = (routeName, id) => {
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
    buttonsStyling: false,
  }).then((result) => {
    if (result.isConfirmed) {
      router.delete(route(routeName, id), {
        onSuccess: () => {
          Swal.fire({
            icon: "success",
            title: "Deleted!",
            text: "Your product has been deleted.",
            confirmButtonClass: "btn btn-success",
          });
        },
      });
    }
  });
};

const filterQueries = () => {
  router.get(
    "/products",
    {
      category_id: form.category_id?.id,
      unit_id: form.unit_id?.id,
      brand_id: form.brand_id?.id,
      type_id: form.type_id?.id,
      measure_id: form.measure_id?.id,
      sub_category_id: form.sub_category_id?.id,
      sub_measure_id: form.sub_measure_id?.id,
    },
    { preserveState: true }
  );
};

watch(
  () => props.products,
  (newProducts) => {
    pagination.value.current = newProducts.current_page;
    pagination.value.total = newProducts.total;
  }
);

const columns = [
  {
    title: "Product",
    dataIndex: "name",
    key: "Product",
    sorter: (a, b) => a.name.localeCompare(b.name),
  },
  {
    title: "Reference",
    dataIndex: "reference",
    sorter: (a, b) => a.reference.localeCompare(b.reference),
  },
  {
    title: "Category",
    dataIndex: "Category",
    sorter: (a, b) => a.Category.localeCompare(b.Category),
  },
  {
    title: "Brand",
    dataIndex: "Brand",
    sorter: (a, b) => a.Brand.localeCompare(b.Brand),
  },
  {
    title: "Price",
    dataIndex: "Price",
    sorter: (a, b) => a.Price.localeCompare(b.Price),
  },
  {
    title: "Unit",
    dataIndex: "Unit",
    sorter: (a, b) => a.Unit.localeCompare(b.Unit),
  },
  {
    title: "Qty",
    dataIndex: "Qty",
    sorter: (a, b) => a.Qty.localeCompare(b.Qty),
  },
  {
    title: "Qty Alert",
    dataIndex: "Qty_Alert",
    sorter: (a, b) => a.Qty_Alert.localeCompare(b.Qty_Alert),
  },
  {
    title: "Gender",
    dataIndex: "Gender",
    key: "Gender",
    sorter: (a, b) => a.Gender.localeCompare(b.Gender),
  },
  { title: "Action", key: "action", sorter: true },
];
</script>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>

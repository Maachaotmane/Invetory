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
          <vue-feather type="sliders" class="info-img"></vue-feather>
          <vue-select
            :options="Sortby"
            id="sortby"
            placeholder="Sort by Date"
          />
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
            <template v-else-if="column.key === 'CreatedBy'">
              <td class="userimgname">
                <a href="javascript:void(0);" class="text-decoration-none">{{
                  record.CreatedBy
                }}</a>
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

<script>
import { ref, computed, watch } from "vue";
import Swal from "sweetalert2";
import VueFeather from "vue-feather";
import { router } from "@inertiajs/vue3";

export default {
  props: {
    products: Object,
  },
  setup(props) {
    const searchQuery = ref("");
    const currentPage = ref(props.products.current_page);
    const pagination = ref({
      current: props.products.current_page,
      pageSize: props.products.per_page,
      total: props.products.total,
    });

    const tableData = computed(() => {
      return props.products.data.map((product) => ({
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
        CreatedBy: product.user?.name,
        images: product.images,
      }));
    });

    const filteredData = computed(() => {
      return tableData.value.filter((item) =>
        Object.values(item).some((val) =>
          String(val).toLowerCase().includes(searchQuery.value.toLowerCase())
        )
      );
    });

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

    watch(
      () => props.products,
      (newProducts) => {
        pagination.value.current = newProducts.current_page;
        pagination.value.total = newProducts.total;
      }
    );

    return {
      searchQuery,
      pagination,
      filteredData,
      handleTableChange,
      showConfirmation,
      columns: [
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
        {
          title: "Created by",
          dataIndex: "CreatedBy",
          key: "CreatedBy",
          sorter: (a, b) => a.CreatedBy.localeCompare(b.CreatedBy),
        },
        { title: "Action", key: "action", sorter: true },
      ],
    };
  },
};
</script>

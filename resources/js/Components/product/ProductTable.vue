<template>
    <div class="card table-list-card">
        <div class="card-body">
            <div class="table-top">
                <div class="search-set">
                    <div class="search-input">
                        <input type="text" placeholder="Search" class="dark-input" />
                        <a href="javascript:void(0);" class="btn btn-searchset">
                            <i data-feather="search" class="feather-search"></i>
                        </a>
                    </div>
                </div>
                <div class="search-path">
                    <a class="btn btn-filter" id="filter_search" @click="toggleFilter" :class="{ setclose: filter }">
                        <vue-feather type="filter" class="filter-icon"></vue-feather>
                        <span><img src="Assets/img/icons/closes.svg" alt="img" /></span>
                    </a>
                </div>
                <div class="form-sort">
                    <vue-feather type="sliders" class="info-img"></vue-feather>
                    <vue-select :options="Sortby" id="sortby" placeholder="Sort by Date" />
                </div>
            </div>

            <div class="card mb-0" :style="{ display: filter ? 'block' : 'none' }" id="filter_inputs">
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="row">
                                <div class="col-lg-2 col-sm-6 col-12">
                                    <div class="input-blocks">
                                        <vue-feather type="box" class="info-img"></vue-feather>
                                        <vue-select :options="ChooseFilter" id="choosefilter"
                                            placeholder="Choose Product" />
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6 col-12">
                                    <div class="input-blocks">
                                        <vue-feather type="stop-circle" class="info-img"></vue-feather>
                                        <vue-select :options="CategroyFilter" id="categroyfilter"
                                            placeholder="Choose Category" />
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6 col-12">
                                    <div class="input-blocks">
                                        <vue-feather type="git-merge" class="info-img"></vue-feather>
                                        <vue-select :options="CategroySubFilter" id="categroysubfilter"
                                            placeholder="Choose Sub Category" />
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6 col-12">
                                    <div class="input-blocks">
                                        <vue-feather type="stop-circle" class="info-img"></vue-feather>
                                        <vue-select :options="BrandFilter" id="brandfilter" placeholder="All Brand" />
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6 col-12">
                                    <div class="input-blocks">
                                        <i class="fas fa-money-bill info-img"></i>
                                        <vue-select :options="PriceFilter" id="Pricefilter" placeholder="Price" />
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6 col-12">
                                    <div class="input-blocks">
                                        <a class="btn btn-filters ms-auto">
                                            <i data-feather="search" class="feather-search"></i>
                                            Search
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive product-list">
                <a-table class="table datanew table-hover table-center mb-0" :columns="columns" :data-source="data">
                    <template #bodyCell="{ column, record }">
                        <template v-if="column.key === 'Product'">
                            <div class="productimgname">
                                <a href="javascript:void(0);" class="product-img stock-img">
                                    <img :src="`Assets/img/${record.Image}`" alt="product" />
                                </a>
                                <a href="javascript:void(0);">{{ record.Product }}</a>
                            </div>
                        </template>
                        <template v-else-if="column.key === 'CreatedBy'">
                            <td class="userimgname">
                                <a href="javascript:void(0);" class="product-img me-2">
                                    <img :src="`Assets/img/${record.UserImage}`" alt="product" />
                                </a>
                                <a href="javascript:void(0);">{{ record.CreatedBy }}</a>
                            </td>
                        </template>
                        <template v-else-if="column.key === 'action'">
                            <td class="action-table-data">
                                <div class="edit-delete-action">
                                    <router-link class="me-2 edit-icon p-2" to="/inventory/product-details">
                                        <i data-feather="eye" class="feather-eye"></i>
                                    </router-link>
                                    <router-link class="me-2 p-2" to="/inventory/edit-product">
                                        <i data-feather="edit" class="feather-edit"></i>
                                    </router-link>
                                    <a class="confirm-text p-2" @click="showConfirmation" href="javascript:void(0);">
                                        <vue-feather type="trash-2" class="trash-2"></vue-feather>
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
import { ref } from 'vue';
import Swal from 'sweetalert2';

export default {
    setup() {
        const filter = ref(false);
        const Sortby = ref(["Sort by Date", "14 09 23", "11 09 23"]);
        const ChooseFilter = ref(["Choose Product", "Lenovo 3rd Generation", "Nike Jordan"]);
        const CategroyFilter = ref(["Laptop", "Shoe"]);
        const CategroySubFilter = ref(["Choose Sub Category", "Computers", "Fruits"]);
        const BrandFilter = ref(["Lenovo", "Nike"]);
        const PriceFilter = ref(["Price", "$12500.00", "$12500.00"]);

        const columns = ref([
            { title: "Product", dataIndex: "Product", key: "Product", sorter: (a, b) => a.Product.localeCompare(b.Product) },
            { title: "SKU", dataIndex: "SKU", sorter: (a, b) => a.SKU.localeCompare(b.SKU) },
            { title: "Category", dataIndex: "Category", sorter: (a, b) => a.Category.localeCompare(b.Category) },
            { title: "Brand", dataIndex: "Brand", sorter: (a, b) => a.Brand.localeCompare(b.Brand) },
            { title: "Price", dataIndex: "Price", sorter: (a, b) => a.Price.localeCompare(b.Price) },
            { title: "Unit", dataIndex: "Unit", sorter: (a, b) => a.Unit.localeCompare(b.Unit) },
            { title: "Qty", dataIndex: "Qty", sorter: (a, b) => a.Qty.localeCompare(b.Qty) },
            { title: "Created by", dataIndex: "CreatedBy", key: "CreatedBy", sorter: (a, b) => a.CreatedBy.localeCompare(b.CreatedBy) },
            { title: "Action", key: "action", sorter: true },
        ]);

        const data = ref([
            {
                Product: "Red Premium Handy", SKU: "PT007", Category: "Bags", Brand: "Versace", Price: "$2024.00", Unit: "Kg", Qty: "747",
                Image: "stock-img-01.png", UserImage: "user-01.jpg", CreatedBy: "Steven",
            },
            {
                Product: "Iphone 14 Pro", SKU: "PT008", Category: "Phone", Brand: "Iphone", Price: "$1698.00", Unit: "Pc", Qty: "897",
                Image: "stock-img-02.png", UserImage: "user-01.jpg", CreatedBy: "Gravely",
            },
            {
                Product: "Black Slim 200", SKU: "PT009", Category: "Chairs", Brand: "Bently", Price: "$6794.00", Unit: "Pc", Qty: "741",
                Image: "stock-img-03.png", UserImage: "user-01.jpg", CreatedBy: "Kevin",
            },
            {
                Product: "Woodcraft Sandal", SKU: "PT010", Category: "Bags", Brand: "Woodcraft", Price: "$4547.00", Unit: "Kg", Qty: "148",
                Image: "stock-img-04.png", UserImage: "user-01.jpg", CreatedBy: "Grillo",
            },
        ]);

        const toggleFilter = () => {
            filter.value = !filter.value;
        };

        const showConfirmation = () => {
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
                    Swal.fire({
                        icon: "success",
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        confirmButtonClass: "btn btn-success",
                    });
                }
            });
        };

        return {
            filter,
            Sortby,
            ChooseFilter,
            CategroyFilter,
            CategroySubFilter,
            BrandFilter,
            PriceFilter,
            columns,
            data,
            toggleFilter,
            showConfirmation,
        };
    },
};
</script>
<template>
  <div class="page-wrapper">
    <div class="content">
      <div class="page-header">
        <div class="page-title">
          <h4>Product Details</h4>
          <h6>Full details of a product</h6>
        </div>
      </div>
      <div class="row">
        <h5>Product Info</h5>
        <div class="col-lg-8 col-sm-12">
          <div class="card">
            <div class="card-body">
              <div class="productdetails">
                <ul class="product-bar">
                  <li>
                    <h4>Product</h4>
                    <h6>{{ product.name }}</h6>
                  </li>
                  <li>
                    <h4>Reference</h4>
                    <h6>{{ product.reference || "N/A" }}</h6>
                  </li>
                  <li>
                    <h4>Gender</h4>
                    <h6>
                      <span
                        :class="[
                          'badge',
                          product.variants[0]?.variant
                            ? 'badge-warning'
                            : 'badge-success',
                        ]"
                      >
                        {{
                          product.variants[0]?.variant ? "variant" : "single"
                        }}
                      </span>
                    </h6>
                  </li>
                  <li>
                    <h4>Category</h4>
                    <h6>{{ product.category?.name || "N/A" }}</h6>
                  </li>
                  <li>
                    <h4>Sub Category</h4>
                    <h6>{{ product.sub_category?.name || "N/A" }}</h6>
                  </li>
                  <li>
                    <h4>Brand</h4>
                    <h6>{{ product.brand?.name || "N/A" }}</h6>
                  </li>
                  <li>
                    <h4>Unit</h4>
                    <h6>{{ product.unit?.name || "N/A" }}</h6>
                  </li>

                  <li>
                    <h4>Measure</h4>
                    <h6>{{ product.measure?.name || "N/A" }}</h6>
                  </li>
                  <li>
                    <h4>Sub Measure</h4>
                    <h6>{{ product.sub_measure?.name || "N/A" }}</h6>
                  </li>
                  <li>
                    <h4>Type</h4>
                    <h6>{{ product.type?.name || "N/A" }}</h6>
                  </li>
                  <li>
                    <h4>Description</h4>
                    <h6>
                      {{ product.description }}
                    </h6>
                  </li>
                  <li>
                    <h4>Fournisseur</h4>
                    <h6>{{ product.fournisseur?.name || "N/A" }}</h6>
                  </li>
                  <li>
                    <h4>Created by</h4>
                    <h6>{{ product.user?.name || "N/A" }}</h6>
                  </li>
                  <li>
                    <h4>Created at</h4>
                    <h6>
                      {{
                        product.created_at
                          .replace("T", " ")
                          .replace(".000000Z", "") || "N/A"
                      }}
                    </h6>
                  </li>
                  <li>
                    <h4>Updated at</h4>
                    <h6>
                      {{
                        product.updated_at
                          .replace("T", " ")
                          .replace(".000000Z", "") || "N/A"
                      }}
                    </h6>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-sm-12">
          <div class="card">
            <div class="card-body">
              <div class="slider-product-details">
                <div class="owl-carousel owl-theme product-slide">
                  <div
                    class="slider-product border-bottom p-2"
                    v-for="product in product.images"
                    :key="row"
                  >
                    <img :src="`/storage/${product.name}`" alt="" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <h5>Product Pricing && Quantity</h5>

      <div class="card">
        <div class="card-body">
          <div class="modal-body-table table-responsive custom-modal-body">
            <div class="table-responsive rounded">
              <table class="table">
                <thead>
                  <tr>
                    <th v-if="product.variants[0]?.value">Value</th>
                    <th>Price</th>
                    <th>Buying Price</th>
                    <th>Quantity</th>
                    <th>Quantity Alert</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(row, index) in product.variants" :key="index">
                    <td v-if="product.variants[0]?.value">
                      <div class="add-product">
                        {{ row.value }}
                      </div>
                    </td>
                    <td>
                      <div class="add-product">
                        {{ row.price }}
                      </div>
                    </td>
                    <td>
                      <div class="add-product">
                        {{ row.buying_price }}
                      </div>
                    </td>
                    <td>
                      <div class="add-product">
                        {{ row.quantity }}
                      </div>
                    </td>
                    <td>
                      <div class="add-product">
                        {{ row.quantity_alert }}
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
const props = defineProps({
  product: Object,
});
</script>

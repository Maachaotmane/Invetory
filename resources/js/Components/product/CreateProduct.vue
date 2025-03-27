<script setup>
import { ref, defineProps } from "vue";
import { Link, useForm } from "@inertiajs/vue3";
import VueMultiselect from "vue-multiselect";
import apiClient from "@/api";

const props = defineProps({
  categories: Array,
  fournisseurs: Array,
});

const form = useForm({
  category_id: null,
  fournisseur_id: null,
  unit_id: null,
  brand_id: null,
  type_id: null,
  measure_id: null,
  sub_category_id: null,
  reference: null,
  description: null,
  name: null,
});

const formErrors = ref({});

const singleForm = useForm({
  variant: null,
  quantity: 0,
  quantity_alert: 0,
  price: null,
  buying_price: null,
});

const units = ref([]);
const brands = ref([]);
const types = ref([]);
const measures = ref([]);
const subCategories = ref([]);
const loading = ref(false);
const error = ref("");
const images = ref([]);
const variants = [
  { name: "type", arr: types },
  { name: "measure", arr: measures },
  { name: "unit", arr: units },
  { name: "brand", arr: brands },
];
const selectedPricing = ref("single");
const selectedVariant = ref("");
const rows = ref([]);

const changeProductPricing = (strg) => {
  selectedPricing.value = strg;
};

const addRow = () => {
  if (!selectedVariant.value) return;

  selectedVariant.value.arr.forEach((variant) => {
    rows.value.push({
      variant: selectedVariant.value.name,
      value: variant.name,
      price: "",
      buying_price: "",
      quantity: 0,
      quantity_alert: 0,
      images: [],
    });
  });

  selectedVariant.value = "";
};

const deleteRow = (index) => {
  rows.value.splice(index, 1);
};

const incrementQuantity = (row) => {
  row.quantity++;
};

const decrementQuantity = (row) => {
  if (row.quantity > 0) row.quantity--;
};

const incrementAlert = (row) => {
  row.quantity_alert++;
};

const decrementAlert = (row) => {
  if (row.quantity_alert > 0) row.quantity_alert--;
};

const handleFileUpload = (event) => {
  const files = event.target.files;
  if (files) {
    for (let i = 0; i < files.length; i++) {
      const file = files[i];
      const reader = new FileReader();
      reader.onload = (e) => {
        images.value.push({ url: e.target.result, file: file });
      };
      reader.readAsDataURL(file);
    }
  }
};

const handleVariantFileUpload = (event, row) => {
  const files = event.target.files;
  if (files) {
    for (let i = 0; i < files.length; i++) {
      const file = files[i];
      const reader = new FileReader();
      reader.onload = (e) => {
        row.images.push({ url: e.target.result, file: file });
      };
      reader.readAsDataURL(file);
    }
  }
};

const removeImage = (index) => {
  images.value.splice(index, 1);
};

const removeVariantImage = (index, row) => {
  row.images.splice(index, 1);
};

const generateUUID = (e) => {
  e.preventDefault();
  const timestamp = Date.now().toString(36);
  let randomString = "";
  for (let i = 0; i < 18; i++) {
    randomString += timestamp.charAt(
      Math.floor(Math.random() * timestamp.length)
    );
  }

  form.reference = randomString.toLocaleUpperCase();
};

const fetchRelatedData = async () => {
  form.brand_id = null;
  form.sub_category_id = null;
  form.measure_id = null;
  form.unit_id = null;
  form.type_id = null;

  if (!form.category_id?.id) {
    units.value = [];
    brands.value = [];
    types.value = [];
    measures.value = [];
    subCategories.value = [];
    return;
  }

  loading.value = true;
  error.value = "";

  try {
    const response = await apiClient.get(
      "/product/related-data/" + form.category_id.id
    );

    units.value = response.data.units;
    brands.value = response.data.brands;
    types.value = response.data.types;
    measures.value = response.data.measures;
    subCategories.value = response.data.subCategories;
  } catch (err) {
    error.value = "Failed to fetch data. Please try again.";
    console.error(err);
  } finally {
    loading.value = false;
  }
};

const submitForm = () => {
  form
    .transform((data) => {
      const formData = new FormData();

      formData.append("category_id", data.category_id?.id || "");
      formData.append("fournisseur_id", data.fournisseur_id?.id || "");
      formData.append("unit_id", data.unit_id?.id || "");
      formData.append("brand_id", data.brand_id?.id || "");
      formData.append("type_id", data.type_id?.id || "");
      formData.append("measure_id", data.measure_id?.id || "");
      formData.append("sub_category_id", data.sub_category_id?.id || "");
      formData.append("reference", data.reference || "");
      formData.append("name", data.name || "");
      formData.append("description", data.description || "");

      if (Array.isArray(images.value) && images.value.length > 0) {
        images.value.forEach((image, index) => {
          formData.append(`images[${index}]`, image.file);
        });
      }

      if (selectedPricing.value !== "single") {
        formData.append("variants", JSON.stringify(rows.value));
      } else {
        formData.append("variants", JSON.stringify([singleForm]));
      }

      return formData;
    })
    .post(route("products.store"), {
      forceFormData: true,
      onError: (errors) => {
        formErrors.value = errors;
        console.log("Form submission failed:", errors);
      },
    });
};
</script>

<template>
  <div class="page-header">
    <div class="add-item d-flex">
      <div class="page-title">
        <h4>New Product</h4>
        <h6>Create new product</h6>
      </div>
    </div>
    <ul class="table-top-head">
      <li>
        <div class="btn">
          <Link
            href="/products"
            method="get"
            class="project-btn bg-secondary border-secondary"
          >
            <vue-feather type="arrow-left" class="me-2"></vue-feather>
            Back to Product
          </Link>
        </div>
      </li>
    </ul>
  </div>

  <form @submit.prevent="submitForm">
    <div class="card">
      <div class="card-body add-product pb-0">
        <div class="accordion-card-one accordion" id="accordionExample">
          <div class="accordion-item">
            <div class="accordion-header" id="headingOne">
              <div
                class="accordion-button"
                data-bs-toggle="collapse"
                data-bs-target="#collapseOne"
                aria-controls="collapseOne"
              >
                <div class="addproduct-icon">
                  <h5>
                    <vue-feather type="info" class="add-info"></vue-feather
                    ><span>Product Information</span>
                  </h5>
                  <a href="javascript:void(0);"
                    ><vue-feather
                      type="chevron-down"
                      class="chevron-down-add"
                    ></vue-feather
                  ></a>
                </div>
              </div>
            </div>
            <div>
              <div class="accordion-body">
                <div class="row">
                  <div class="col-lg-4 col-sm-6 col-12">
                    <div class="mb-3 add-product">
                      <div class="add-newplus">
                        <label class="form-label">Fournisseur</label>
                        <a
                          href="javascript:void(0);"
                          data-bs-toggle="modal"
                          data-bs-target="#add-units-category"
                          class="text-secondary text-decoration-none"
                          ><vue-feather
                            type="plus-circle"
                            class="plus-down-add"
                          ></vue-feather
                          ><span>Add New</span></a
                        >
                      </div>
                      <VueMultiselect
                        v-model="form.fournisseur_id"
                        :options="fournisseurs"
                        label="name"
                        track-by="id"
                        id="thomasstore"
                        placeholder="Choose fournisseur"
                      />
                      <span
                        class="text-danger"
                        v-if="form.errors.fournisseur_id"
                        >{{ form.errors.fournisseur_id }}
                      </span>
                    </div>
                  </div>
                  <div class="col-lg-4 col-sm-6 col-12">
                    <div class="mb-3 add-product">
                      <div class="add-newplus">
                        <label class="form-label">Category</label>
                        <a
                          href="javascript:void(0);"
                          data-bs-toggle="modal"
                          data-bs-target="#add-units-category"
                          class="text-secondary text-decoration-none"
                          ><vue-feather
                            type="plus-circle"
                            class="plus-down-add"
                          ></vue-feather
                          ><span>Add New</span></a
                        >
                      </div>
                      <VueMultiselect
                        v-model="form.category_id"
                        :options="categories"
                        label="name"
                        track-by="id"
                        @update:modelValue="fetchRelatedData"
                        placeholder="Choose category"
                      />
                      <span class="text-danger" v-if="form.errors.category_id"
                        >{{ form.errors.category_id }}
                      </span>
                    </div>
                  </div>
                  <div class="col-lg-4 col-sm-6 col-12">
                    <div class="mb-3 add-product">
                      <div class="add-newplus">
                        <label class="form-label">Sub Category</label>
                        <a
                          href="javascript:void(0);"
                          data-bs-toggle="modal"
                          data-bs-target="#add-units-category"
                          class="text-secondary text-decoration-none"
                          ><vue-feather
                            type="plus-circle"
                            class="plus-down-add"
                          ></vue-feather
                          ><span>Add New</span></a
                        >
                      </div>
                      <VueMultiselect
                        v-model="form.sub_category_id"
                        :options="subCategories"
                        label="name"
                        track-by="id"
                        placeholder="Choose sub category"
                      />
                      <span
                        class="text-danger"
                        v-if="form.errors.sub_category_id"
                        >{{ form.errors.sub_category_id }}
                      </span>
                    </div>
                  </div>
                  <div class="col-lg-4 col-sm-6 col-12">
                    <div class="mb-3 add-product">
                      <div class="add-newplus">
                        <label class="form-label">Brand</label>
                        <a
                          href="javascript:void(0);"
                          data-bs-toggle="modal"
                          data-bs-target="#add-units-brand"
                          class="text-secondary text-decoration-none"
                          ><vue-feather
                            type="plus-circle"
                            class="plus-down-add"
                          ></vue-feather
                          ><span>Add New</span></a
                        >
                      </div>
                      <VueMultiselect
                        v-model="form.brand_id"
                        :options="brands"
                        label="name"
                        track-by="id"
                        placeholder="Choose brand"
                      />
                      <span class="text-danger" v-if="form.errors.brand_id"
                        >{{ form.errors.brand_id }}
                      </span>
                    </div>
                  </div>
                  <div class="col-lg-4 col-sm-6 col-12">
                    <div class="mb-3 add-product">
                      <div class="add-newplus">
                        <label class="form-label">Unit</label>
                        <a
                          href="javascript:void(0);"
                          data-bs-toggle="modal"
                          data-bs-target="#add-unit"
                          class="text-secondary text-decoration-none"
                          ><vue-feather
                            type="plus-circle"
                            class="plus-down-add"
                          ></vue-feather
                          ><span>Add New</span></a
                        >
                      </div>
                      <VueMultiselect
                        v-model="form.unit_id"
                        :options="units"
                        label="name"
                        track-by="id"
                        placeholder="Choose unit"
                      />
                      <span class="text-danger" v-if="form.errors.unit_id"
                        >{{ form.errors.unit_id }}
                      </span>
                    </div>
                  </div>
                  <div class="col-lg-4 col-sm-6 col-12">
                    <div class="mb-3 add-product">
                      <div class="add-newplus">
                        <label class="form-label">Type</label>
                        <a
                          href="javascript:void(0);"
                          data-bs-toggle="modal"
                          data-bs-target="#add-unit"
                          class="text-secondary text-decoration-none"
                          ><vue-feather
                            type="plus-circle"
                            class="plus-down-add"
                          ></vue-feather
                          ><span>Add New</span></a
                        >
                      </div>
                      <VueMultiselect
                        v-model="form.type_id"
                        :options="types"
                        label="name"
                        track-by="id"
                        placeholder="Choose type"
                      />
                      <span class="text-danger" v-if="form.errors.type_id"
                        >{{ form.errors.type_id }}
                      </span>
                    </div>
                  </div>
                  <div class="col-lg-4 col-sm-6 col-12">
                    <div class="mb-3 add-product">
                      <div class="add-newplus">
                        <label class="form-label">Measure</label>
                        <a
                          href="javascript:void(0);"
                          data-bs-toggle="modal"
                          data-bs-target="#add-unit"
                          class="text-secondary text-decoration-none"
                          ><vue-feather
                            type="plus-circle"
                            class="plus-down-add"
                          ></vue-feather
                          ><span>Add New</span></a
                        >
                      </div>
                      <VueMultiselect
                        v-model="form.measure_id"
                        :options="measures"
                        label="name"
                        track-by="id"
                        placeholder="Choose measure"
                      />
                      <span class="text-danger" v-if="form.errors.measure_id"
                        >{{ form.errors.measure_id }}
                      </span>
                    </div>
                  </div>
                  <div class="col-lg-4 col-sm-6 col-12">
                    <div class="mb-3 add-product">
                      <label class="form-label">Product Name</label>
                      <input
                        type="text"
                        class="form-control"
                        v-model="form.name"
                      />
                      <span class="text-danger" v-if="form.errors.name">{{
                        form.errors.name
                      }}</span>
                    </div>
                  </div>
                  <div class="col-lg-4 col-sm-6 col-12">
                    <div class="input-blocks add-product list">
                      <label class="text-secondary fw-bold">Reference</label>
                      <input
                        v-model="form.reference"
                        type="text"
                        class="form-control list"
                        placeholder="Generate a ref"
                      />
                      <button class="btn-primaryadd" @click="generateUUID">
                        Generate Code
                      </button>
                      <span class="text-danger" v-if="form.errors.reference"
                        >{{ form.errors.reference }}
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div
                    class="input-blocks summer-description-box transfer mb-3"
                  >
                    <label>Description</label>
                    <textarea
                      class="form-control h-100"
                      rows="5"
                      v-model="form.description"
                    ></textarea>
                    <p class="mt-1">Maximum 60 Characters</p>
                    <span class="text-danger" v-if="form.errors.description"
                      >{{ form.errors.description }}
                    </span>
                  </div>
                </div>
                <!-- /Editor -->
              </div>
            </div>
          </div>
        </div>
        <div class="accordion-card-one accordion" id="accordionExample2">
          <div class="accordion-item">
            <div class="accordion-header" id="headingTwo">
              <div
                class="accordion-button"
                data-bs-toggle="collapse"
                data-bs-target="#collapseTwo"
                aria-controls="collapseTwo"
              >
                <div class="text-editor add-list">
                  <div class="addproduct-icon list icon">
                    <h5>
                      <vue-feather
                        type="life-buoy"
                        class="add-info"
                      ></vue-feather
                      ><span>Pricing & Stocks</span>
                    </h5>
                    <a href="javascript:void(0);"
                      ><vue-feather
                        type="chevron-down"
                        class="chevron-down-add"
                      ></vue-feather
                    ></a>
                  </div>
                </div>
              </div>
            </div>
            <div>
              <div class="accordion-body">
                <div class="add-products">
                  <label class="form-label">Product Type</label>
                  <div class="single-pill-product">
                    <ul class="nav nav-pills" id="pills-tab1" role="tablist">
                      <li class="nav-item" role="presentation">
                        <span
                          class="custom_radio me-4 mb-0 active"
                          id="pills-home-tab"
                          data-bs-toggle="pill"
                          data-bs-target="#pills-home"
                          role="tab"
                          aria-controls="pills-home"
                          aria-selected="true"
                        >
                          <input
                            type="radio"
                            class="form-control"
                            name="pricing_stock"
                            value="single"
                            v-model="selectedPricing"
                          />
                          <span
                            class="checkmark"
                            @click="changeProductPricing('single')"
                          ></span>
                          Single Product</span
                        >
                      </li>
                      <li class="nav-item" role="presentation">
                        <span
                          class="custom_radio me-2 mb-0"
                          id="pills-profile-tab"
                          data-bs-toggle="pill"
                          data-bs-target="#pills-profile"
                          role="tab"
                          aria-controls="pills-profile"
                          aria-selected="false"
                        >
                          <input
                            type="radio"
                            class="form-control"
                            name="pricing_stock"
                            value="variant"
                            v-model="selectedPricing"
                          />
                          <span
                            class="checkmark"
                            @click="changeProductPricing('variant')"
                          ></span>
                          Variable Product</span
                        >
                      </li>
                    </ul>
                  </div>

                  <div class="row mt-3" v-show="selectedPricing === 'single'">
                    <div class="col-lg-3 col-sm-6 col-12">
                      <div class="mb-3 add-product">
                        <label class="form-label">Price</label>
                        <input
                          type="number"
                          class="form-control"
                          v-model="singleForm.price"
                        />
                        <span class="text-danger" v-if="singleForm.errors.price"
                          >{{ singleForm.errors.price }}
                        </span>
                      </div>
                    </div>

                    <div class="col-lg-3 col-sm-6 col-12">
                      <div class="mb-3 add-product">
                        <label class="form-label">Buying Price</label>
                        <input
                          type="number"
                          class="form-control"
                          v-model="singleForm.buying_price"
                        />
                        <span
                          class="text-danger"
                          v-if="singleForm.errors.buying_price"
                          >{{ singleForm.errors.buying_price }}
                        </span>
                      </div>
                    </div>

                    <div class="col-lg-2 col-sm-6 col-12">
                      <div class="mb-3 add-product">
                        <label class="form-label">Quantity</label>
                        <div class="product-quantity">
                          <a
                            class="fw-bold text-dark fs-5 text-decoration-none"
                            href="javascript:void(0)"
                            @click="decrementQuantity(singleForm)"
                          >
                            -
                          </a>
                          <input
                            type="number"
                            class="quntity-input form-control"
                            v-model="singleForm.quantity"
                          />
                          <a
                            class="fw-bold text-dark fs-5 text-decoration-none"
                            href="javascript:void(0)"
                            @click="incrementQuantity(singleForm)"
                          >
                            +
                          </a>
                        </div>
                        <span
                          class="text-danger"
                          v-if="singleForm.errors.quantity"
                          >{{ singleForm.errors.quantity }}
                        </span>
                      </div>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-12">
                      <div class="mb-3 add-product">
                        <label class="form-label">Quantity Alert</label>
                        <div class="product-quantity">
                          <a
                            class="fw-bold text-dark fs-5 text-decoration-none"
                            href="javascript:void(0)"
                            @click="decrementAlert(singleForm)"
                          >
                            -
                          </a>
                          <input
                            type="number"
                            class="quntity-input form-control"
                            v-model="singleForm.quantity_alert"
                          />
                          <a
                            class="fw-bold text-dark fs-5 text-decoration-none"
                            href="javascript:void(0)"
                            @click="incrementAlert(singleForm)"
                          >
                            +
                          </a>
                        </div>
                        <span
                          class="text-danger"
                          v-if="singleForm.errors.quantity_alert"
                          >{{ singleForm.errors.quantity_alert }}
                        </span>
                      </div>
                    </div>
                  </div>

                  <div class="mt-3" v-show="selectedPricing === 'variant'">
                    <div class="row select-color-add">
                      <div class="col-lg-6 col-sm-6 col-12">
                        <div class="mb-3 add-product">
                          <label class="form-label">Variant Attribute</label>
                          <div class="row">
                            <div class="col-lg-10 col-sm-10 col-10">
                              <VueMultiselect
                                v-model="selectedVariant"
                                :options="form.category_id ? variants : []"
                                label="name"
                                track-by="name"
                                placeholder="Choose Variant"
                              />
                            </div>
                            <div class="col-lg-2 col-sm-2 col-2 ps-0">
                              <div class="add-icon tab">
                                <a class="btn btn-filter" @click="addRow">+</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div
                      class="modal-body-table table-responsive custom-modal-body"
                    >
                      <div class="table-responsive rounded">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Price</th>
                              <th>Buying Price</th>
                              <th>Quantity</th>
                              <th>Quantity Alert</th>
                              <th>Image</th>
                              <th class="no-sort">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="(row, index) in rows" :key="index">
                              <td>
                                <div class="add-product">
                                  <input
                                    type="number"
                                    class="form-control"
                                    v-model="row.price"
                                    placeholder="Enter Price"
                                  />
                                </div>
                              </td>
                              <td>
                                <div class="add-product">
                                  <input
                                    type="number"
                                    class="form-control"
                                    v-model="row.buying_price"
                                    placeholder="Enter Buying Price"
                                  />
                                </div>
                              </td>
                              <td>
                                <div class="product-quantity">
                                  <a
                                    class="fw-bold fs-5 text-decoration-none"
                                    href="javascript:void(0)"
                                    @click="decrementQuantity(row)"
                                  >
                                    -
                                  </a>
                                  <input
                                    type="number"
                                    class="quntity-input"
                                    v-model="row.quantity"
                                  />
                                  <a
                                    class="fw-bold fs-5 text-decoration-none"
                                    href="javascript:void(0)"
                                    @click="incrementQuantity(row)"
                                  >
                                    +
                                  </a>
                                </div>
                              </td>
                              <td>
                                <div class="product-quantity">
                                  <a
                                    class="fw-bold fs-5 text-decoration-none"
                                    href="javascript:void(0)"
                                    @click="decrementAlert(row)"
                                  >
                                    -
                                  </a>
                                  <input
                                    type="number"
                                    class="quntity-input"
                                    v-model="row.quantity_alert"
                                  />
                                  <a
                                    class="fw-bold fs-5 text-decoration-none"
                                    href="javascript:void(0)"
                                    @click="incrementAlert(row)"
                                  >
                                    +
                                  </a>
                                </div>
                              </td>
                              <td>
                                <div class="add-product d-flex gap-3">
                                  <div class="image-upload-variant">
                                    <input
                                      class="form-control"
                                      type="file"
                                      multiple
                                      @change="
                                        handleVariantFileUpload($event, row)
                                      "
                                    />
                                    <div class="image-upload-variants">
                                      <i
                                        data-feather="plus-circle"
                                        class="plus-down-add me-0"
                                      ></i>
                                      <h4>Add Images</h4>
                                    </div>
                                  </div>

                                  <div class="d-flex gap-2">
                                    <div
                                      class="phone-img position-relative"
                                      v-for="(image, index) in row.images"
                                      :key="index"
                                    >
                                      <img
                                        :src="image.url"
                                        alt="image"
                                        class="object-fit-cover border"
                                        style="width: 60px; height: 40px"
                                      />
                                      <span
                                        class="text-danger"
                                        v-if="form.errors['images.' + index]"
                                        >{{ form.errors["images." + index] }}
                                      </span>
                                      <a
                                        class="position-absolute top-0 end-0"
                                        href="javascript:void(0);"
                                        @click="removeVariantImage(index, row)"
                                      >
                                        <vue-feather
                                          type="x"
                                          class="x-square-add remove-product"
                                        ></vue-feather>
                                      </a>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td class="action-table-data">
                                <div class="edit-delete-action">
                                  <a
                                    class="confirm-text p-2"
                                    @click="deleteRow(index)"
                                    href="javascript:void(0);"
                                  >
                                    <VueFeather
                                      type="trash-2"
                                      class="feather-trash-2"
                                    />
                                  </a>
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-content" id="pills-tabContent">
                  <div>
                    <div
                      class="accordion-card-one accordion"
                      id="accordionExample3"
                    >
                      <div class="accordion-item">
                        <div class="accordion-header" id="headingThree">
                          <div
                            class="accordion-button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapseThree"
                            aria-controls="collapseThree"
                          >
                            <div class="addproduct-icon list">
                              <h5>
                                <vue-feather
                                  type="image"
                                  class="add-info"
                                ></vue-feather
                                ><span>Images</span>
                              </h5>
                              <a href="javascript:void(0);"
                                ><vue-feather
                                  type="chevron-down"
                                  class="chevron-down-add"
                                ></vue-feather
                              ></a>
                            </div>
                          </div>
                        </div>
                        <div>
                          <div class="accordion-body">
                            <div class="text-editor add-list add">
                              <div class="col-lg-12">
                                <div class="add-choosen">
                                  <div class="input-blocks">
                                    <div class="image-upload">
                                      <input
                                        type="file"
                                        multiple
                                        @change="handleFileUpload"
                                      />
                                      <div class="image-uploads">
                                        <i
                                          data-feather="plus-circle"
                                          class="plus-down-add me-0"
                                        ></i>
                                        <h4>Add Images</h4>
                                      </div>
                                    </div>
                                  </div>

                                  <div
                                    class="phone-img"
                                    v-for="(image, index) in images"
                                    :key="index"
                                  >
                                    <img
                                      :src="image.url"
                                      alt="image"
                                      class="object-fit-cover border h-100 w-100"
                                    />
                                    <span
                                      class="text-danger"
                                      v-if="form.errors['images.' + index]"
                                      >{{ form.errors["images." + index] }}
                                    </span>
                                    <a
                                      href="javascript:void(0);"
                                      @click="removeImage(index)"
                                    >
                                      <vue-feather
                                        type="x"
                                        class="x-square-add remove-product"
                                      ></vue-feather>
                                    </a>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-12">
      <div class="btn-addproduct mb-4 d-flex">
        <button type="button" class="btn-cancel rounded me-2">Cancel</button>
        <button class="project-btn" type="submit">Save Product</button>
      </div>
    </div>
  </form>
</template>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>

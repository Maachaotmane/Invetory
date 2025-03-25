<template>
  <div class="page-header">
    <div class="add-item d-flex">
      <div class="page-title">
        <h4>Product List</h4>
        <h6>Manage your products</h6>
      </div>
    </div>
    <ul class="table-top-head mt-3">
   
      <li>
        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"
          ><img src="/Assets/icons/excel.svg" alt="img"
        /></a>
      </li>
    </ul>
    <div class="page-btn">
      <Link href="/products/create" method="get" class="project-btn"
        ><vue-feather type="plus-circle" class="me-2"></vue-feather>Add New
        Product</Link
      >
    </div>
  </div>
</template>
<script setup>
import { Link } from "@inertiajs/vue3";
</script>

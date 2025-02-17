<template>
    <div class="sidebar" id="sidebar">
      <div class="sidebar-inner slimscroll">
        <perfect-scrollbar
          class="scroll-area"
          :settings="settings"
          @ps-scroll-y="scrollHandle"
        >
          <div id="sidebar-menu" class="sidebar-menu">
            <user-menu></user-menu>
          </div>
        </perfect-scrollbar>
      </div>
    </div>
    <!-- <collapsed-sidebar></collapsed-sidebar>
    <horizontal-sidebar></horizontal-sidebar> -->
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { PerfectScrollbar } from 'vue3-perfect-scrollbar';
  // import 'vue3-perfect-scrollbar/dist/vue3-perfect-scrollbar.css';
  
  const settings = ref({
    suppressScrollX: true,
  });
  
  const scrollHandle = () => {
    // You can add custom logic here if needed
  };
  </script>
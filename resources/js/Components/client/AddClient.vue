<template>
  <div class="modal modal-lg fade" id="add-client">
    <div class="modal-dialog modal-dialog-centered custom-modal-two">
      <div class="modal-content">
        <div class="page-wrapper-new p-0">
          <div class="content">
            <div class="modal-header border-0 custom-modal-header">
              <div class="page-title">
                <h4>Create Client</h4>
              </div>
            </div>
            <div class="modal-body">
              <form @submit.prevent="submitForm" enctype="multipart/form-data">
                <div>
                  <label class="block text-gray-700 font-semibold mb-1"
                    >Profile Image</label
                  >
                  <div class="flex items-center gap-4">
                    <div
                      v-if="profileImagePreview"
                      class="w-20 h-20 rounded-full overflow-hidden border border-gray-300"
                    >
                      <img
                        :src="profileImagePreview"
                        class="w-full h-full object-cover"
                        alt="Profile preview"
                      />
                    </div>
                    <div class="flex-1">
                      <input
                        type="file"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                        accept="image/*"
                        @change="handleProfileImageChange"
                      />
                      <span
                        class="text-sm text-red-500"
                        v-if="form.errors.profile_image"
                      >
                        {{ form.errors.profile_image }}
                      </span>
                    </div>
                  </div>
                </div>

                <div>
                  <label class="block text-gray-700 font-semibold mb-1 mt-2"
                    >C.I.N Image</label
                  >
                  <div class="flex items-center gap-4">
                    <div
                      v-if="cinImagePreview"
                      class="w-20 h-20 rounded-lg overflow-hidden border border-gray-300"
                    >
                      <img
                        :src="cinImagePreview"
                        class="w-full h-full object-cover"
                        alt="C.I.N preview"
                      />
                    </div>
                    <div class="flex-1">
                      <input
                        type="file"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                        accept="image/*"
                        @change="handleCinImageChange"
                      />
                      <span
                        class="text-sm text-red-500"
                        v-if="form.errors.C_I_N_image"
                      >
                        {{ form.errors.C_I_N_image }}
                      </span>
                    </div>
                  </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mt-2">
                  <div>
                    <label class="block text-gray-700 font-semibold mb-1"
                      >Name</label
                    >
                    <input
                      type="text"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                      v-model="form.name"
                    />
                    <span class="text-sm text-red-500" v-if="form.errors.name">
                      {{ form.errors.name }}
                    </span>
                  </div>
                  <div>
                    <label class="block text-gray-700 font-semibold mb-1"
                      >C.I.N</label
                    >
                    <input
                      type="text"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                      v-model="form.C_I_N"
                    />
                    <span class="text-sm text-red-500" v-if="form.errors.C_I_N">
                      {{ form.errors.C_I_N }}
                    </span>
                  </div>
                </div>

                <!-- Address Field -->

                <!-- Phone & Email Row -->
                <div class="grid grid-cols-2 mt-2 gap-4">
                  <div>
                    <label class="block text-gray-700 font-semibold mb-1"
                      >Phone</label
                    >
                    <input
                      type="text"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                      v-model="form.phone"
                    />
                    <span class="text-sm text-red-500" v-if="form.errors.phone">
                      {{ form.errors.phone }}
                    </span>
                  </div>
                  <div>
                    <label class="block text-gray-700 font-semibold mb-1"
                      >Email</label
                    >
                    <input
                      type="email"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                      v-model="form.email"
                    />
                    <span class="text-sm text-red-500" v-if="form.errors.email">
                      {{ form.errors.email }}
                    </span>
                  </div>
                </div>

                <div class="row">
                  <div class="col mt-2 gap-4">
                    <div>
                      <label class="block text-gray-700 font-semibold mb-1"
                        >Address</label
                      >
                      <input
                        type="text"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                        v-model="form.address"
                      />
                      <span
                        class="text-sm text-red-500"
                        v-if="form.errors.address"
                      >
                        {{ form.errors.address }}
                      </span>
                    </div>
                  </div>
                  <div class="col-4 gap-4 mt-2">
                    <div>
                      <label class="block text-gray-700 font-semibold mb-1"
                        >City</label
                      >
                      <input
                        type="text"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                        v-model="form.city"
                      />
                      <span
                        class="text-sm text-red-500"
                        v-if="form.errors.city"
                      >
                        {{ form.errors.city }}
                      </span>
                    </div>
                  </div>
                </div>

                <!-- Credit Limit & Total Due Amount -->
                <div class="grid grid-cols-2 gap-4 mt-2">
                  <div>
                    <label class="block text-gray-700 font-semibold mb-1"
                      >Credit Limit</label
                    >
                    <input
                      type="number"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                      v-model="form.credit_limit"
                    />
                    <span
                      class="text-sm text-red-500"
                      v-if="form.errors.credit_limit"
                    >
                      {{ form.errors.credit_limit }}
                    </span>
                  </div>
                  <div>
                    <label class="block text-gray-700 font-semibold mb-1"
                      >Total Due Amount</label
                    >
                    <input
                      type="number"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                      v-model="form.total_due_amount"
                    />
                    <span
                      class="text-sm text-red-500"
                      v-if="form.errors.total_due_amount"
                    >
                      {{ form.errors.total_due_amount }}
                    </span>
                  </div>
                </div>

                <!-- Registration Details -->
                <div class="grid grid-cols-2 gap-4 mt-2">
                  <div>
                    <label class="block text-gray-700 font-semibold mb-1"
                      >I.F</label
                    >
                    <input
                      type="text"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                      v-model="form.I_F"
                    />
                    <span class="text-sm text-red-500" v-if="form.errors.I_F">
                      {{ form.errors.I_F }}
                    </span>
                  </div>
                  <div>
                    <label class="block text-gray-700 font-semibold mb-1"
                      >R.C</label
                    >
                    <input
                      type="text"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                      v-model="form.R_C"
                    />
                    <span class="text-sm text-red-500" v-if="form.errors.R_C">
                      {{ form.errors.R_C }}
                    </span>
                  </div>
                </div>

                <!-- More Registration Details -->
                <div class="grid grid-cols-2 gap-4 mt-2">
                  <div>
                    <label class="block text-gray-700 font-semibold mb-1"
                      >I.C.E</label
                    >
                    <input
                      type="text"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                      v-model="form.I_C_E"
                    />
                    <span class="text-sm text-red-500" v-if="form.errors.I_C_E">
                      {{ form.errors.I_C_E }}
                    </span>
                  </div>
                  <div>
                    <label class="block text-gray-700 font-semibold mb-1"
                      >C.N.S.S</label
                    >
                    <input
                      type="text"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                      v-model="form.C_N_S_S"
                    />
                    <span
                      class="text-sm text-red-500"
                      v-if="form.errors.C_N_S_S"
                    >
                      {{ form.errors.C_N_S_S }}
                    </span>
                  </div>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-4 mt-6">
                  <button
                    type="button"
                    class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition"
                    data-bs-dismiss="modal"
                  >
                    Cancel
                  </button>
                  <button
                    type="submit"
                    class="px-4 py-2 text-white rounded-lg project-btn"
                  >
                    Create Client
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import Swal from "sweetalert2";
import { ref } from "vue";

const profileImagePreview = ref(null);
const cinImagePreview = ref(null);

const form = useForm({
  name: "",
  email: "",
  address: "",
  phone: "",
  credit_limit: "",
  total_due_amount: "",
  country: "",
  city: "",
  I_F: "",
  R_C: "",
  I_C_E: "",
  C_N_S_S: "",
  C_I_N: "",
  profile_image: null,
  C_I_N_image: null,
});

const handleProfileImageChange = (event) => {
  const file = event.target.files[0];
  form.profile_image = file;

  if (file) {
    const reader = new FileReader();
    reader.onload = (e) => {
      profileImagePreview.value = e.target.result;
    };
    reader.readAsDataURL(file);
  } else {
    profileImagePreview.value = null;
  }
};

const handleCinImageChange = (event) => {
  const file = event.target.files[0];
  form.C_I_N_image = file;

  if (file) {
    const reader = new FileReader();
    reader.onload = (e) => {
      cinImagePreview.value = e.target.result;
    };
    reader.readAsDataURL(file);
  } else {
    cinImagePreview.value = null;
  }
};

const submitForm = () => {
  form.post(route("clients.store"), {
    preserveScroll: true,
    onSuccess: () => {
      Swal.fire("Success", "Client created successfully!", "success");
      form.reset();
      profileImagePreview.value = null;
      cinImagePreview.value = null;
      document.getElementById("add-client").classList.remove("show");
      document.querySelector(".modal-backdrop")?.remove();
      document.body.style.overflow = "auto";
      document.body.style.paddingRight = "";
    },
    onError: (errors) => {
      Swal.fire("Error", "Please check the form for errors.", "error");
    },
  });
};
</script>

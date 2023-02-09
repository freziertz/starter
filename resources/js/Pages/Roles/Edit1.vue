<template>
  <div>
    <Head title="Create Role" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/roles">Roles</Link>
      <span class="text-indigo-400 font-medium">/</span> Create
    </h1>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="update">
        <div class="flex flex-col mb-8 -mr-6 p-8">
          <text-input v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-1/2" label="Name" />



         <div v-for="permission in permissions" :key="permission.id" class="block">
            <div class="mt-2">
              <label class="inline-flex items-center">
                <input type="checkbox" v-model="form.permissionIds" :error="form.errors.permissionIds" :id="permission.id" :value="permission.id" class="w-4 h-4" />
                   <!-- <input type="checkbox" v-model="form.permissionIds"  v-bind:checked="`${rolePermissionArray}.includes(${permission.id})`" class="w-4 h-4" /> -->
                   <span class="ml-2">{{ permission.name }}</span>
              </label>
          </div>
        </div>






        </div>
        <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
          <loading-button :loading="form.processing" class="btn-indigo" type="submit">Update Role</loading-button>
        </div>
      </form>

        <br>
  <span>Checked Names :</span>
  <span>{{ rolePermissionArray }}</span>
  <span>{{ Object.values(rolePermissions) }}</span>
  <span>{{ permissionIds }}</span>
    </div>
  </div>
</template>

<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import Layout from "@/Shared/Layout.vue";
import FileInput from "@/Shared/FileInput.vue";
import TextInput from "@/Shared/TextInput.vue";
import SelectInput from "@/Shared/SelectInput.vue";
import LoadingButton from "@/Shared/LoadingButton.vue";

export default {
  components: {
    FileInput,
    Head,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
  },
  layout: Layout,
  props: {
    permissions: Array,
    rolePermissions: Object,
    role: Object,
  },
  remember: "form",
  data() {
    return {
      form: this.$inertia.form({
        name: this.role.name,
        permissionIds: Object.values(this.rolePermissions),
      }),
    };
  },
  computed: {
    checkedComputed() {
      return this.form.permissionIds;
    },
  },
  methods: {
    update() {
      this.form.put(`/roles/${this.role.id}`);
    },

    destroy() {
      if (confirm("Are you sure you want to delete this role?")) {
        this.$inertia.delete(`/roles/${this.role.id}`);
      }
    },
    restore() {
      if (confirm("Are you sure you want to restore this role?")) {
        this.$inertia.put(`/roles/${this.role.id}/restore`);
      }
    },
  },
};
</script>

<template>
  <div>
    <Head title="Roles" />
    <h1 class="mb-8 text-3xl font-bold">Roles</h1>
    <div class="flex items-center justify-between mb-6">
      <!-- <search-filter v-model="form.search" class="mr-4 w-full max-w-md" @reset="reset">
        <label class="block text-gray-700">Role:</label>
        <select v-model="form.role" class="form-select mt-1 w-full">
          <option :value="null" />
          <option value="role">Role</option>
          <option value="owner">Owner</option>
        </select>
        <label class="block mt-4 text-gray-700">Trashed:</label>
        <select v-model="form.trashed" class="form-select mt-1 w-full">
          <option :value="null" />
          <option value="with">With Trashed</option>
          <option value="only">Only Trashed</option>
        </select>
      </search-filter> -->
      <Link class="btn-indigo" href="/roles/create">
        <span>Create</span>
        <span class="hidden md:inline">&nbsp;Role</span>
      </Link>
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="pb-4 pt-6 px-6">Name</th>
          <!-- <th class="pb-4 pt-6 px-6">Email</th>
          <th class="pb-4 pt-6 px-6" colspan="2">Role</th> -->
        </tr>
        <tr v-for="role in roles" :key="role.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="`/roles/${role.id}/edit`">
              {{ role.name }}
              <icon v-if="role.deleted_at" name="trash" class="flex-shrink-0 ml-2 w-3 h-3 fill-gray-400" />
            </Link>
          </td>
          <!-- <td class="border-t">
            <Link class="flex items-center px-6 py-4" :href="`/roles/${role.id}/edit`" tabindex="-1">
              {{ role.email }}
            </Link>
          </td>
          <td class="border-t">
            <Link class="flex items-center px-6 py-4" :href="`/roles/${role.id}/edit`" tabindex="-1">
              {{ role.owner ? 'Owner' : 'Role' }}
            </Link>
          </td> -->
          <td class="w-px border-t">
            <Link class="flex items-center px-4" :href="`/roles/${role.id}/edit`" tabindex="-1">
              <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
            </Link>
          </td>
        </tr>
        <tr v-if="roles.length === 0">
          <td class="px-6 py-4 border-t" colspan="4">No roles found.</td>
        </tr>
      </table>
    </div>
  </div>
</template>

<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import Icon from "@/Shared/Icon.vue";
import pickBy from "lodash/pickBy";
import Layout from "@/Shared/Layout.vue";
import throttle from "lodash/throttle";
import mapValues from "lodash/mapValues";
import SearchFilter from "@/Shared/SearchFilter.vue";

export default {
  components: {
    Head,
    Icon,
    Link,
    // SearchFilter,
  },
  layout: Layout,
  props: {
    // filters: Object,
    roles: Object,
  },
  data() {
    return {
      form: {
        // search: this.filters.search,
        // role: this.filters.role,
        // trashed: this.filters.trashed,
      },
    };
  },
  watch: {
    form: {
      deep: true,
      handler: throttle(function () {
        this.$inertia.get("/roles", pickBy(this.form), { preserveState: true });
      }, 150),
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null);
    },
  },
};
</script>

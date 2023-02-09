<script setup>
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Link, useForm } from "@inertiajs/inertia-vue3";
import ActionMessage from "@/Components/ActionMessage.vue";
import FormSection from "@/Components/FormSection.vue";
import InputError from "@/Components/InputError.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

defineProps({
  roles: Array,
});
</script>

<template>
    <FormSection @submitted="createRole">
        <template #title>
            Role Information
        </template>

        <template #description>
            <Link href="/roles/create"> Create new role.</Link>
        </template>

        <template #form>




      <table class="table-auto whitespace-nowrap">
        <tr class="text-left font-bold text-lg bg-gray-200 w-full">
          <th class="pb-4 pt-6 px-6">#</th>
          <th class="pb-4 pt-6 px-6 ">Role Name</th>
        </tr>
        <tr v-for="role in roles" :key="role.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="`/roles/${role.id}/edit`">
                {{ role.id}}
            </Link>
          </td>
          <td class="border-t">
            <Link class="flex items-center px-6 py-4" :href="`/roles/${role.id}/edit`" tabindex="-1">
              {{ role.name }}
            </Link>
          </td>

          <td class="w-px border-t">
            <Link class="flex items-center px-4" :href="`/roles/${role.id}/edit`" tabindex="-1">
              <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
            </Link>
          </td>
        </tr>
        <tr v-if="roles.length === 0">
          <td class="px-6 py-4 border-t" colspan="4">No role found.</td>
        </tr>
      </table>







        </template>


    </FormSection>


</template>

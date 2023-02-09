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
  users: Array,
});
</script>

<template>
    <FormSection @submitted="createUser">
        <template #title>
            User Information
        </template>

        <template #description>
            <Link href="/users/create"> Create new user.</Link>
        </template>

        <template #form>







      <table class="w-full  whitespace-nowrap">
        <tr class="text-left font-bold text-lg bg-gray-200 w-full">
          <th class="pb-4 pt-6 px-6">#</th>
          <th class="pb-4 pt-6 px-6 ">Name</th>
          <th class="pb-4 pt-6 px-6 ">Email</th>
        </tr>
        <tr v-for="user in users" :key="user.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="`/users/${user.id}/edit`">
                {{ user.id}}
            </Link>
          </td>
          <td class="border-t">
            <Link class="flex items-center px-6 py-4" :href="`/users/${user.id}/edit`" tabindex="-1">
              {{ user.name }}
            </Link>
          </td>

                    <td class="border-t">
            <Link class="flex items-center px-6 py-4" :href="`/users/${user.id}/edit`" tabindex="-1">
              {{ user.email }}
            </Link>
          </td>

          <td class="w-px border-t">
            <Link class="flex items-center px-4" :href="`/users/${user.id}/edit`" tabindex="-1">
              <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
            </Link>
          </td>
        </tr>
        <tr v-if="users.length === 0">
          <td class="px-6 py-4 border-t" colspan="4">No user found.</td>
        </tr>
      </table>








        </template>


    </FormSection>


</template>

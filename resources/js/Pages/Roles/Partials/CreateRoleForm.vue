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

const props = defineProps({
  permissions: Array,
  role: Object,
});

const form = useForm({
  // _method: 'PUT',
  name: "",
  permissionIds: [],
});

const createRole = () => {
  form.post(route("roles.store"), {
    onFinish: () => form.reset(),
  });
};
</script>

<template>
    <FormSection @submitted="createRole">
        <template #title>
            Role Information
        </template>

        <template #description>
            Create new role.
        </template>

        <template #form>

            <!-- Role Name -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="name" value="Name" />
                <TextInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="name"
                />
                <InputError :message="form.errors.name" class="mt-2" />
            </div>

          <!-- Roles -->

            <div   v-for="permission in permissions" :key="permission.id" class="col-span-6 sm:col-span-4">
                <label  class="flex items-center">
                    <Checkbox  v-model="form.permissionIds" :id="permission.id" :value="permission.id" />
                    <span class="ml-2 text-sm text-gray-600">{{ permission.name }}</span>
                </label>
            </div>

        </template>

        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </ActionMessage>

            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </PrimaryButton>
        </template>
    </FormSection>


</template>

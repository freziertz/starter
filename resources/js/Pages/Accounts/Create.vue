<script setup>
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import SectionBorder from "@/Components/SectionBorder.vue";
import ActionMessage from "@/Components/ActionMessage.vue";
import FormSection from "@/Components/FormSection.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

defineProps({});

const form = useForm({
  name: "",
});

const createAccount = () => {
  form.post(route("accounts.store"), {
    onFinish: () => form.reset(),
  });
};
</script>
<template>
    <AppLayout title="Accounts">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Accounts
            </h2>
        </template>

        <div>
       <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div>
                <FormSection @submitted="createAccount">
                    <template #title>
                        Account Information
                    </template>

                    <template #description>
                        Create new account.
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

                    <!-- country -->

                        <!-- <div   v-for="permission in permissions" :key="permission.id" class="col-span-6 sm:col-span-4">
                            <label  class="flex items-center">
                                <Checkbox  v-model="form.permissionIds" :id="permission.id" :value="permission.id" />
                                <span class="ml-2 text-sm text-gray-600">{{ permission.name }}</span>
                            </label>
                        </div> -->

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

                    <SectionBorder />
                </div>

            </div>
        </div>
    </AppLayout>
</template>

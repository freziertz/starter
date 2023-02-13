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
import DangerButton from "@/Components/DangerButton.vue";
import DialogModal from "@/Components/DialogModal.vue";

const props = defineProps({
  account: Object,
});

const form = useForm({
  _method: "PUT",
  name: props.account.name,
});

const updateAccount = () => {
  form.post(route("accounts.update", props.account.id), {
    onFinish: () => form.reset(),
  });
};

const deleteAccount = () => {
  form.delete(route("accounts.destroy", props.account.id), {
    preserveScroll: true,
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
                <FormSection @submitted="updateAccount">
                    <template #title>
                        Account Information
                    </template>

                    <template #description>
                        Edit account.
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


                    <DangerButton
                        class="mx-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteAccount"
                    >
                        Delete Account
                    </DangerButton>




                        <!-- <Link class="inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25 transition" :href="`/accounts/${account.id}`" >
                            <span>Delete</span>
                            <span class="hidden md:inline">&nbsp;Account</span>
                        </Link> -->

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

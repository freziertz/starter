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
  user: Object,
  roles: Array,
  accounts: Array,
  organizations: Array,
});

const form = useForm({
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
  first_name: "",
  last_name: "",
  account_id: null,
  organization_id: null,
  roleIds: [],
  photo: null,
});

const verificationLinkSent = ref(null);
const photoPreview = ref(null);
const photoInput = ref(null);

const createUserInformation = () => {
  if (photoInput.value) {
    form.photo = photoInput.value.files[0];
  }

  form.post(route("users.store"), {
    errorBag: "createUserInformation",
    preserveScroll: true,

    onError: () => {
      if (form.errors.password) {
        form.reset("password", "password_confirmation");
        passwordInput.value.focus();
      }
    },
    onSuccess: () => {
      clearPhotoFileInput();
      form.reset();
    },
  });
};

const sendEmailVerification = () => {
  verificationLinkSent.value = true;
};

const selectNewPhoto = () => {
  photoInput.value.click();
};

const updatePhotoPreview = () => {
  const photo = photoInput.value.files[0];

  if (!photo) return;

  const reader = new FileReader();

  reader.onload = (e) => {
    photoPreview.value = e.target.result;
  };

  reader.readAsDataURL(photo);
};

const deletePhoto = () => {
  Inertia.delete(route("current-user-photo.destroy"), {
    preserveScroll: true,
    onSuccess: () => {
      photoPreview.value = null;
      clearPhotoFileInput();
    },
  });
};

const clearPhotoFileInput = () => {
  if (photoInput.value?.value) {
    photoInput.value.value = null;
  }
};

// const organizations = () => {
//     props.organizations.filter(form.);

// };
</script>

<template>
    <FormSection @submitted="createUserInformation">
        <template #title>
            User Information
        </template>

        <template #description>
            Create new user.
        </template>

        <template #form>
            <!-- Profile Photo -->
            <div  class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input
                    ref="photoInput"
                    type="file"
                    class="hidden"
                    @change="updatePhotoPreview"
                >

                <InputLabel for="photo" value="Photo" />

                <!-- Current Profile Photo -->
                <!-- <div v-show="! photoPreview" class="mt-2">
                    <img :src="user.profile_photo_url" :alt="user.name" class="rounded-full h-20 w-20 object-cover">
                </div> -->

                <!-- New Profile Photo Preview -->
                <div v-show="photoPreview" class="mt-2">
                    <span
                        class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                        :style="'background-image: url(\'' + photoPreview + '\');'"
                    />
                </div>

                <SecondaryButton class="mt-2 mr-2" type="button" @click.prevent="selectNewPhoto">
                    Select A New Photo
                </SecondaryButton>

                <SecondaryButton

                    type="button"
                    class="mt-2"
                    @click.prevent="deletePhoto"
                >
                    Remove Photo
                </SecondaryButton>


                <InputError :message="form.errors.photo" class="mt-2" />
            </div>

          <div class="col-span-6 sm:col-span-4">
            <select v-model="form.owner" :error="form.errors.owner" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" label="Owner">
                <option :value="true">Yes</option>
                <option :value="false">No</option>
            </select>
          </div>

        <div class="col-span-6 sm:col-span-4">
            <select v-model="form.account_id" :error="form.errors.account_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" label="Account">
                <option v-for="account in accounts" :key="account.id" :value="account.id">{{ account.name }}</option>

            </select>
          </div>


        <div class="col-span-6 sm:col-span-4">
            <select v-model="form.organization_id" :error="form.errors.organization_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" label="Organization">
                <option v-for="organization in organizations" :key="organization.id" :value="organization.id">{{ organization.name }}</option>
            </select>
          </div>

            <!-- Name -->
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


            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                     class="mt-1 block w-full"
                     autocomplete=""
                />
                <InputError :message="form.errors.email" class="mt-2" />
            </div>

            <!-- First Name -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="first_name" value="First Name" />
                <TextInput
                    id="first_name"
                    v-model="form.first_name"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="first_name"
                />
                <InputError :message="form.errors.first_name" class="mt-2" />
            </div>

            <!-- Last Name -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="last_name" value="Last Name" />
                <TextInput
                    id="last_name"
                    v-model="form.last_name"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="last_name"
                />
                <InputError :message="form.errors.last_name" class="mt-2" />
            </div>

           <!-- Password -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="password" value="Password" />
                <TextInput
                    id="password"
                    v-model="form.password"
                    type="password"
                     class="mt-1 block w-full"
                />
                <InputError :message="form.errors.password" class="mt-2" />
            </div>

                       <!-- Confirm Password -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />
                <TextInput
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                     class="mt-1 block w-full"
                />
                <InputError :message="form.errors.password_confirmation" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">

            <InputLabel for="name" value="Name" />

            <div   v-for="role in roles" :key="role.id" class="col-span-6 sm:col-span-4">
                <label  class="flex items-center">
                    <Checkbox  v-model="form.roleIds" :id="role.id" :value="role.id" />
                    <span class="ml-2 text-sm text-gray-600">{{ role.name }}</span>
                </label>
            </div>

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

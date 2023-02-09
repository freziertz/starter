<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import EditUserForm from "@/Pages/Users/Partials/EditUserForm.vue";
import LogoutOtherBrowserSessionsForm from "@/Pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue";
import SectionBorder from "@/Components/SectionBorder.vue";
import TwoFactorAuthenticationForm from "@/Pages/Profile/Partials/TwoFactorAuthenticationForm.vue";
import UpdatePasswordForm from "@/Pages/Profile/Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "@/Pages/Profile/Partials/UpdateProfileInformationForm.vue";

defineProps({
  sessions: Array,
  roles: Array,
  accounts: Array,
  organizations: Array,
  user_edited: Object,
});
</script>

<template>
    <AppLayout title="Users">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Users
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div>
                    <EditUserForm  :roles="roles" :accounts="accounts" :organizations="organizations" :user_edited="user_edited"  />

                    <SectionBorder />
                </div>

            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import EditRoleForm from "@/Pages/Roles/Partials/EditRoleForm.vue";
import LogoutOtherBrowserSessionsForm from "@/Pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue";
import SectionBorder from "@/Components/SectionBorder.vue";
import TwoFactorAuthenticationForm from "@/Pages/Profile/Partials/TwoFactorAuthenticationForm.vue";
import UpdatePasswordForm from "@/Pages/Profile/Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "@/Pages/Profile/Partials/UpdateProfileInformationForm.vue";

defineProps({
  //   sessions: Array,
  permissions: Array,
  rolePermissions: Object,
  role: Object,
});
</script>

<template>
    <AppLayout title="Roles">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Roles
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div>
                    <EditRoleForm  :permissions="permissions" :role="role" :rolePermissions="rolePermissions" />

                    <SectionBorder />
                </div>

            </div>
        </div>
    </AppLayout>
</template>

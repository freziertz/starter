<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import ViewRoleForm from "@/Pages/Roles/Partials/ViewRoleForm.vue";
import SectionBorder from "@/Components/SectionBorder.vue";

defineProps({
  sessions: Array,
  roles: Array,
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
                    <ViewRoleForm  :roles="roles" />

                    <SectionBorder />
                </div>

            </div>
        </div>
    </AppLayout>
</template>

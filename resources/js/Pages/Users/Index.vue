<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import ViewUserForm from "@/Pages/Users/Partials/ViewUserForm.vue";
import SectionBorder from "@/Components/SectionBorder.vue";

defineProps({
  sessions: Array,
  users: Array,
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
                    <ViewUserForm  :users="users" />

                    <SectionBorder />
                </div>

            </div>
        </div>
    </AppLayout>
</template>

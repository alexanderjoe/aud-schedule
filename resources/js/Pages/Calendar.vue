<script setup>
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/inertia-vue3';

const calendarOptions = {
    plugins: [dayGridPlugin],
    initialView: 'dayGridMonth'
};
</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-2 md:mx-auto sm:px-6 lg:px-8">
                <FullCalendar :options="calendarOptions"/>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

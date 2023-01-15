<script setup>
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Modal from '@/Components/Modal.vue';
import {Head} from '@inertiajs/vue3';
import {ref, reactive} from 'vue';
import PrimaryButton from "@/Components/PrimaryButton.vue";

const showEventModal = ref(false);
const eventModel = reactive({});

const calendarOptions = {
    plugins: [
        dayGridPlugin,
        timeGridPlugin
    ],
    headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },
    initialView: 'dayGridMonth',
    eventClick: handleEventClick,
    eventSources: [
        {
            url: '/data',
        }
    ],
};

function handleEventClick(info) {
    eventModel.value = info.event._def;
    showEventModal.value = true;
}

const closeModal = () => {
    showEventModal.value = false;
    eventModel.value = {};

    // form.reset();
};
</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-2 md:mx-auto sm:px-6 lg:px-8">
                <PrimaryButton @click="showEventModal = true">Toggle Modal</PrimaryButton>
                <FullCalendar :options="calendarOptions"/>
            </div>
        </div>

        <Modal :show="showEventModal" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    Title: {{ eventModel.value.title }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    Once your account is deleted, all of its resources and data will be permanently deleted. Please
                    enter your password to confirm you would like to permanently delete your account.
                </p>

            </div>
        </Modal>
    </AuthenticatedLayout>
</template>

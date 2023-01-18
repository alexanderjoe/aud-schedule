<script setup>
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Modal from '@/Components/Modal.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, useForm} from '@inertiajs/vue3';
import {reactive, ref} from 'vue';
import PrimaryButton from "@/Components/PrimaryButton.vue";

import CreateEventForm from './Partials/CreateEventForm.vue';

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

const form = useForm({
    title: '',
    start: null,
    end: null,
});

function handleEventClick(info) {
    eventModel.value = {
        title: info.event.title,
        start: new Date(info.event.startStr).toJSON().substr(0,19),
        end: new Date(info.event.endStr).toJSON().substr(0,19),
    };

    form.title = eventModel.value.title;
    form.start = eventModel.value.start;
    form.end = eventModel.value.end;

    showEventModal.value = true;
}

const closeModal = () => {
    showEventModal.value = false;
    eventModel.value = {};
    form.reset();
};
</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-2 md:mx-auto sm:px-6 lg:px-8">
                <CreateEventForm/>
                <FullCalendar :options="calendarOptions"/>
            </div>
        </div>

        <Modal :show="showEventModal" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    Title: {{ eventModel.value.title }}
                </h2>

                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="title" value="Title"/>

                        <TextInput
                            id="title"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.title"
                            required
                            autofocus
                        />

                        <InputError class="mt-2" :message="form.errors.title"/>
                    </div>

                    <div class="mt-4">
                        <InputLabel for="start" value="Start"/>

                        <TextInput
                            id="start"
                            type="datetime-local"
                            class="mt-1 block w-full"
                            model-value="form.start"
                            v-model="form.start"
                            required
                            autocomplete="current-password"
                        />

                        <InputError class="mt-2" :message="form.errors.start"/>
                    </div>

                    <div class="mt-4">
                        <InputLabel for="end" value="End"/>

                        <TextInput
                            id="end"
                            type="datetime-local"
                            class="mt-1 block w-full"
                            v-model="form.end"
                            required
                            autocomplete="current-password"
                        />

                        <InputError class="mt-2" :message="form.errors.end"/>
                    </div>


                    <div class="flex items-center justify-end mt-4">

                        <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }"
                                       :disabled="form.processing">
                            Edit
                        </PrimaryButton>
                    </div>
                </form>

            </div>
        </Modal>
    </AuthenticatedLayout>
</template>

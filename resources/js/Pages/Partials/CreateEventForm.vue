<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Modal from '@/Components/Modal.vue';
import {Link, useForm, usePage} from '@inertiajs/vue3';
import {nextTick, ref} from 'vue';

const showCreateModal = ref(false);

// const props = defineProps({
//     mustVerifyEmail: Boolean,
//     status: String,
// });

const form = useForm({
    title: '',
    start: null,
    end: null,
});

const closeCreateModal = () => {
    showCreateModal.value = false;
    // eventModel.value = {};
    form.reset();
};

const createEventModal = () => {
    showCreateModal.value = true;
};
</script>

<template>
    <PrimaryButton class="mb-4" @click="createEventModal">Create New Event</PrimaryButton>

    <Modal :show="showCreateModal" @close="closeCreateModal">
        <section class="p-6">
            <header>
                <h2 class="text-lg font-medium text-gray-900">Event Information</h2>

                <p class="mt-1 text-sm text-gray-600">
                    Create a new event by providing some basic details.
                </p>
            </header>

            <form @submit.prevent="form.post(route('cal.store'))" class="mt-6 space-y-6">
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

                <div>
                    <InputLabel for="start" value="Start"/>

                    <TextInput
                        id="start"
                        type="datetime-local"
                        class="mt-1 block w-full"
                        v-model="form.start"
                        required
                    />

                    <InputError class="mt-2" :message="form.errors.start"/>
                </div>

                <div>
                    <InputLabel for="end" value="End"/>

                    <TextInput
                        id="end"
                        type="datetime-local"
                        class="mt-1 block w-full"
                        v-model="form.end"
                        required
                    />

                    <InputError class="mt-2" :message="form.errors.end"/>
                </div>

                <div class="flex items-center gap-4">
                    <PrimaryButton :disabled="form.processing">Create</PrimaryButton>
                </div>
            </form>
        </section>
    </Modal>
</template>

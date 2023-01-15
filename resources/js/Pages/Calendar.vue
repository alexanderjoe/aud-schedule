<script setup>
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import {onMounted, onBeforeMount} from 'vue';

const events = [
];

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
    // initialEvents: events,
    eventSources: [
        {
            url: '/data',
        }
    ]
};

// //function to get events from /data
// const getEvents = async () => {
//     const response = await fetch('/data').then(res => res.json())
//         .then(data => {
//             data.forEach(event => {
//                 console.log(event);
//                 events.push(event)
//             })
//         });
//     console.log(response);
// }
//
// onBeforeMount(() => {
//     getEvents()
// })
</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-2 md:mx-auto sm:px-6 lg:px-8">
                <ul>
                    <li v-for="event in events" :key="event.id">
                        {{ event.title }} - {{ event.start }} - {{ event.end }}
                    </li>
                </ul>
                <FullCalendar :options="calendarOptions"/>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

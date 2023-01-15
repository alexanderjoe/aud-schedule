<script setup>
import {Head, Link} from '@inertiajs/vue3';
import {ref} from 'vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});

const open = ref(false);
</script>

<template>
    <Head title="Welcome"/>

    <nav class="bg-white border-gray-200 px-2 sm:px-4 py-2.5">
        <div class="container flex flex-wrap items-center justify-between mx-auto">
            <a href="#" class="flex items-center">
                <span class="self-center text-xl font-semibold whitespace-nowrap">Auditorium Scheduler</span>
            </a>

            <button data-collapse-toggle="navbar-default" type="button"
                    class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    aria-controls="navbar-default" aria-expanded="false" @click="open = !open">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                          clip-rule="evenodd"></path>
                </svg>
            </button>
            <div class="w-full md:block md:w-auto" :class="{ hidden: !open }" id="navbar-default">
                <ul class="flex flex-col p-4 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white">
                    <template v-if="$page.props.auth.user">
                        <li>
                            <Link :href="route('dashboard')"
                                  class="block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">
                                Dashboard
                            </Link>
                        </li>
                    </template>
                    <template v-else>
                        <li>
                            <Link :href="route('login')"
                                  class="block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">
                                Log in
                            </Link>
                        </li>

                        <li>
                            <Link :href="route('register')"
                                  class="block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">
                                Register
                            </Link>
                        </li>
                    </template>
                </ul>
            </div>
        </div>
    </nav>

    <div class="flex justify-center text-center bg-gray-100 min-h-screen">
        <div class="mt-28 max-w-4xl my-auto p-6">
            <h1 class="text-4xl uppercase font-bold border-b-2 border-black">A simple scheduler.</h1>
            <p class="text-xl pt-3">A tool that is designed to make scheduling workers easier, all with a simple calendar.</p>
        </div>
    </div>
</template>

<template>
    <Head>
        <title>{{ title }}</title>
    </Head>
    <div class="bg-white">
            <!-- Mobile menu -->
            <header class="relative bg-white">
                <p class="flex h-10 items-center justify-center bg-indigo-600 px-4 text-sm font-medium text-white sm:px-6 lg:px-8">Get free delivery on orders over $100</p>

                <nav aria-label="Top" class="mx-auto max-w-12xl px-4 sm:px-6 lg:px-8">
                    <div class="border-b border-gray-200">
                        <div class="flex h-16 items-center">
                            <button type="button" class="rounded-md bg-white p-2 text-gray-400 lg:hidden" @click="open = true">
                                <span class="sr-only">Open menu</span>
                                <Bars3Icon class="h-6 w-6" aria-hidden="true" />
                            </button>

                            <!-- Logo -->
                            <div class="ml-4 flex lg:ml-0">
                                <Link href="/">
                                    <span class="sr-only">Your Company</span>
                                    <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="" />
                                </Link>
                            </div>

                            <!-- Flyout menus -->
                            <PopoverGroup class="hidden lg:ml-8 lg:block lg:self-stretch">
                                <div class="flex h-full space-x-8">
                                    <Popover v-for="category in navigation.categories" :key="category.name" class="flex" v-slot="{ open }">
                                        <div class="relative flex">
                                            <PopoverButton :class="[open ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-700 hover:text-gray-800', 'relative z-10 -mb-px flex items-center border-b-2 pt-px text-sm font-medium transition-colors duration-200 ease-out']">{{ category.name }}</PopoverButton>
                                        </div>
                                    </Popover>

                                    <Link v-for="page in navigation.pages" :key="page.name" :href="page.href" class="flex items-center text-sm font-medium text-gray-700 hover:text-gray-800">{{ page.name }}</Link>
                                </div>
                            </PopoverGroup >

                            <div class="ml-auto flex items-center" dir="ltr">
                                <div class="hidden lg:flex lg:flex-1 lg:items-center lg:justify-end lg:space-x-6" v-if="!user">
                                    <Link href="login" class="text-sm font-medium text-gray-700 hover:text-gray-800">Sign in</Link>
                                    <span class="h-6 w-px bg-gray-200" aria-hidden="true" />
                                    <Link href="register" class="text-sm font-medium text-gray-700 hover:text-gray-800">Create account</Link>
                                </div>
                                <div v-else>
                                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                                        <!-- Settings Dropdown -->
                                        <div class="ml-3 relative">
                                            <Dropdown align="right" width="48">
                                                <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                            >
                                                {{ $page.props.auth.user.name }}

                                                <svg
                                                    class="ml-2 -mr-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                                </template>

                                                <template #content>
                                                    <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                                    <DropdownLink :href="route('logout')" method="post" as="button">
                                                        Log Out
                                                    </DropdownLink>
                                                </template>
                                            </Dropdown>
                                        </div>
                                    </div>
                                </div>

                                <div class="hidden lg:ml-8 lg:flex">
                                    <a href="#" class="flex items-center text-gray-700 hover:text-gray-800">
                                        <img src="/../images/usa-flag.png" alt="" class="block h-auto w-5 flex-shrink-0 rounded" />
                                        <span class="ml-3 block text-sm font-medium">USD</span>
                                        <span class="sr-only">, change currency</span>
                                    </a>
                                </div>

                                <!-- Search -->
                                <div class="flex lg:ml-6">
                                    <a href="#" class="p-2 text-gray-400 hover:text-gray-500">
                                        <span class="sr-only">Search</span>
                                        <MagnifyingGlassIcon class="h-6 w-6" aria-hidden="true" />
                                    </a>
                                </div>

                                <!-- Cart -->
                                <div class="ml-4 flow-root lg:ml-6">
                                    <Link href="cart" class="group -m-2 flex items-center p-2">
                                        <ShoppingBagIcon class="h-6 w-6 flex-shrink-0 text-gray-400 group-hover:text-gray-500" aria-hidden="true" />
                                        <span class="ml-2 text-sm font-medium text-gray-700 group-hover:text-gray-800">{{ $store.state.cart?.length||0 }}</span>
                                        <span class="sr-only">items in cart, view bag</span>
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>
        <slot />
        </div>
</template>


<script setup>

import {computed, ref} from 'vue'
import {Link, usePage} from '@inertiajs/vue3';
import {
    Dialog,
    DialogPanel,
    Popover,
    PopoverButton,
    PopoverGroup,
    PopoverPanel,
    Tab,
    TabGroup,
    TabList,
    TabPanel,
    TabPanels,
    TransitionChild,
    TransitionRoot,
} from '@headlessui/vue'
import { Bars3Icon, MagnifyingGlassIcon, ShoppingBagIcon, XMarkIcon } from '@heroicons/vue/24/outline'
import { Head } from "@inertiajs/vue3";

const navigation = {
    pages: [
        {
            name: 'Shop',
            href: "/products"
        },
        {
            name: 'Cart',
            href: "/cart"
        },
        { name: 'Company', href: '#' },
        { name: 'Stores', href: '#' },
    ],
}

const open = ref(false)
const total = computed(() => usePage().props.total)
const user = computed(() => usePage().props.auth?.user)
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
const showingNavigationDropdown = ref(false);
</script>
<script>
export default {
    name: "NavbarLayout",
    props: ['title']
}
</script>

<style scoped>

</style>

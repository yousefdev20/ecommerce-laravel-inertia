<template>
    <NavbarLayout title="Main">
        <Promo class="mt-16"/>
        <Category class="mt-16"/>
        <Stats/>

        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900">Customers also purchased</h2>

            <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                <div v-for="product in products.data" :key="product.id" class="group relative">
                    <ProductItem :product="product"/>
                </div>
            </div>
            <div class="float-right">
                <a href="#" class="inline-block rounded-md border border-transparent bg-indigo-600 mt-5 px-5 py-2 text-center font-medium text-white hover:bg-indigo-700">View more...</a>
            </div>
        </div>
   </NavbarLayout>
</template>

<script setup>
import NavbarLayout from "@/Layouts/NavbarLayout.vue";
import Promo from "@/Components/Promo.vue";
import Category from "@/Components/Category.vue";
import ProductItem from "@/Components/ProductItem.vue";
import Stats from "@/Components/Stats.vue";

defineProps({products: Array})
</script>

<style scoped>

</style>

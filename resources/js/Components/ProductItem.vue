<template>

    <div
        class="min-h-80 aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
        <img :src="product.image"
             class="h-full w-full object-cover object-center lg:h-full lg:w-full"/>
    </div>
    <div class="mt-4 flex justify-between">
        <div @click="openDialog">
            <h3 class="text-sm text-gray-700">
                <div>
                    <span aria-hidden="true" class="absolute inset-0"/>
                    {{ product.name }}
                </div>
            </h3>
            <p class="mt-1 text-sm text-gray-500">{{ product.color }}</p>
        </div>
        <p class="text-sm font-medium text-gray-900">{{ product.price }}</p>
    </div>
    <ProductQuickViews :product="product" :open="open"/>
</template>

<script setup>
import ProductQuickViews from "@/Components/ProductQuickviews.vue";
</script>
<script>
export default {
    name: "ProductItem",
    props: ['product'],
    data() {
        return {
            open: false
        }
    },
    methods: {
        openDialog() {
            this.open = !this.open
        }
    }
}
</script>

<style scoped>

</style>

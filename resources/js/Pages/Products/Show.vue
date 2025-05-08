<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    product: Object
});
</script>

<template>
    <Head title="View Product" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">View Product</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-medium">Product Details</h3>
                            <div class="flex space-x-2">
                                <Link :href="route('products.index')" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                                    Back to Products
                                </Link>
                                <Link :href="route('products.edit', product.id)" class="px-4 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700">
                                    Edit
                                </Link>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-gray-50 p-6 rounded-lg">
                                <div class="mb-4" v-if="product.image">
                                    <img :src="product.image" :alt="product.name" class="max-w-full h-auto rounded">
                                </div>
                                <div v-else class="mb-4 bg-gray-200 rounded h-60 flex items-center justify-center">
                                    <span class="text-gray-500">No image available</span>
                                </div>
                            </div>
                            
                            <div>
                                <div class="mb-4">
                                    <h4 class="text-xl font-bold">{{ product.name }}</h4>
                                </div>
                                
                                <div class="mb-4">
                                    <p class="text-lg font-semibold text-green-600">${{ product.price }}</p>
                                </div>
                                
                                <div class="mb-4">
                                    <p class="text-gray-700">
                                        <span class="font-medium">Quantity in Stock:</span> {{ product.quantity }}
                                    </p>
                                </div>
                                
                                <div class="mb-4">
                                    <h5 class="text-md font-medium mb-2">Description:</h5>
                                    <p class="text-gray-700">{{ product.description || 'No description available' }}</p>
                                </div>
                                
                                <div class="text-sm text-gray-500 mt-4">
                                    <p>Created: {{ new Date(product.created_at).toLocaleString() }}</p>
                                    <p>Last Updated: {{ new Date(product.updated_at).toLocaleString() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
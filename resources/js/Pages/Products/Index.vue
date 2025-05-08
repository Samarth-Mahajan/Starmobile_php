<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';

const props = defineProps({
    products: Array
});

const message = ref(null);
const page = usePage();

onMounted(() => {
    if (page.props.flash.message) {
        message.value = page.props.flash.message;
        setTimeout(() => {
            message.value = null;
        }, 3000);
    }
});
</script>

<template>
    <Head title="Products" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Products</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-medium">Product List</h3>
                            <Link :href="route('products.create')" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                                Add New Product
                            </Link>
                        </div>
                        
                        <div v-if="message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ message }}
                        </div>

                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-if="products.length === 0">
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">No products found</td>
                                </tr>
                                <tr v-for="product in products" :key="product.id">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ product.name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">€{{ product.price }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ product.quantity }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap flex space-x-2">
                                        <Link :href="route('products.show', product.id)" class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">
                                            View
                                        </Link>
                                        <Link :href="route('products.edit', product.id)" class="px-3 py-1 bg-yellow-600 text-white rounded hover:bg-yellow-700">
                                            Edit
                                        </Link>
                                        <Link :href="route('products.destroy', product.id)" method="delete" as="button" type="button" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700" @click="confirm('Are you sure you want to delete this product?')">
                                            Delete
                                        </Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
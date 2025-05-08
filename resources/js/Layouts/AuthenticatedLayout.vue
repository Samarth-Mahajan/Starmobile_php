<script setup>
import { Link } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue'; // Adjust import path as needed
</script>

<template>
  <div>
    <div class="min-h-screen bg-gray-100">
      <!-- Your Custom Header -->
      <Header />

      <!-- Page Heading -->
      <header class="bg-white shadow" v-if="$slots.header">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
          <slot name="header" />
        </div>
      </header>

      <!-- Page Content -->
      <main>
        <slot />
      </main>
    </div>
  </div>
</template>
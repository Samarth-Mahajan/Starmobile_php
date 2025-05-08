<script setup>
import { ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

const isMobileMenuOpen = ref(false);
const page = usePage();
const user = page.props.auth?.user;

const toggleMobileMenu = () => {
  isMobileMenuOpen.value = !isMobileMenuOpen.value;
};
</script>

<template>
  <header class="bg-indigo-600 text-white shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16 items-center">
        <!-- Logo -->
        <div class="flex-shrink-0">
          <Link href="/dashboard">
            <span class="text-xl font-bold">Product Management</span>
          </Link>
        </div>

        <!-- Navigation (Desktop) -->
        <div class="hidden md:flex items-center space-x-6">
          <Link href="/about" class="hover:underline">About Me</Link>
          <Link href="/dashboard" class="hover:underline">My Dashboard</Link>

          <template v-if="user">
            <span class="text-white">Hi, {{ user.name }}</span>
            <Link href="/profile" class="hover:underline">Profile</Link>
            <Link href="/logout" method="post" as="button" class="text-red-200 hover:text-white hover:underline">
              Logout
            </Link>
          </template>
        </div>

        <!-- Mobile Menu Button -->
        <div class="md:hidden">
          <button @click="toggleMobileMenu" class="text-white focus:outline-none">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path v-if="!isMobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16" />
              <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile Nav -->
    <div v-if="isMobileMenuOpen" class="md:hidden px-4 pb-4 bg-indigo-500">
      <nav class="flex flex-col space-y-2">
        <Link href="/about" class="text-white hover:underline">About Me</Link>

        <template v-if="user">
          <span class="text-white">Hi, {{ user.name }}</span>
          <Link href="/profile" class="text-white hover:underline">Profile</Link>
          <Link href="/logout" method="post" as="button" class="text-red-200 hover:underline">Logout</Link>
        </template>
      </nav>
    </div>
  </header>
</template>

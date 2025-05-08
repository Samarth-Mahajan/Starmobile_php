<script setup>
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
  <Head title="About Me" />

  <div class="min-h-screen bg-gray-100 py-12">
    <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-8">
      <h1 class="text-3xl font-bold text-gray-800 mb-4">About Me</h1>
      <p class="text-gray-700 text-lg leading-relaxed">
        Hi, I'm Samarth! 👋 I'm a passionate software developer with a background in Full Stack development. 
        I enjoy building user-friendly web applications, learning new technologies, and collaborating with great teams.
      </p>

      <div class="mt-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-2">Skills</h2>
        <ul class="list-disc list-inside text-gray-700 space-y-1">
          <li>JavaScript / Vue.js / React</li>
          <li>Laravel / Node.js</li>
          <li>Java / Spring Boot</li>
          <li>HTML / CSS / Tailwind</li>
          <li>Blockchain (Basics)</li>
        </ul>
      </div>

      <div class="mt-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-2">Contact</h2>
        <p class="text-gray-700">📧 Email: samarth@example.com</p>
      </div>

      <div class="mt-6">
        <Link href="/" class="text-indigo-600 hover:underline">← Back to Home</Link>
      </div>
    </div>
  </div>
</template>

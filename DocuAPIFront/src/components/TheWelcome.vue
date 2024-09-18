<template>
    <div class="relative bg-gradient-to-r from-yellow-600 to-yellow-300 h-screen text-white overflow-hidden">
    <div class="absolute inset-0">
      <img src="@/assets/top-view-elections-concept-with-copy-space.jpg" alt="Background Image" class="object-cover object-center w-full h-full" />
     <div class="absolute inset-0 bg-black opacity-50"></div>
    </div>
    
    <div class="relative z-10 flex flex-col justify-center items-center h-full text-center">
      <h1 class="text-5xl font-bold leading-tight mb-4">Welcome to Our TestMaster website</h1>
      <p class="text-lg text-gray-300 mb-8">Discover amazing features and services that await you.</p>
      <RouterLink to="/register" class="bg-yellow-400 text-gray-900 hover:bg-yellow-300 py-2 px-6 rounded-full text-lg font-semibold transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-lg">Get Started</RouterLink>
    </div>
  </div>
</template>
<script>
import { useRouter } from 'vue-router';
</script>

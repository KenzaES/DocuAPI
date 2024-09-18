<template>
  <div class="fixed top-0 left-0 w-full z-50 bg-white border-b backdrop-blur-lg bg-opacity-80">
    <div class="mx-auto max-w-7xl px-6 sm:px-6 lg:px-8 ">
        <div class="relative flex h-16 justify-between">
            <div class="flex flex-1 items-stretch justify-start">
                <a class="flex flex-shrink-0 items-center" href="#">
                    <img class="block h-12 w-auto" src="@/assets/logo.png" >
                </a>
            </div>
            <div class="flex-shrink-0 flex px-2 py-3 items-center space-x-8">
              <RouterLink class="text-amber-800 hover:bg-amber-500  inline-flex items-center justify-center px-3 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm" to="/welcomeToYourAccount">Home</RouterLink>
              <RouterLink class="text-amber-800 hover:bg-amber-500  inline-flex items-center justify-center px-3 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm" to="/Tasks">Tasks</RouterLink>
              <RouterLink class="text-amber-800 hover:bg-amber-500  inline-flex items-center justify-center px-3 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm" to="/mealCalendar">Dashboard</RouterLink>
              <RouterLink class="text-amber-800 hover:bg-amber-500 inline-flex items-center justify-center px-3 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm" to="/sign-out">Sign Out</RouterLink>
            </div>
        </div>
    </div>
</div>
<HomeUser />
</template>

<script setup>
import { RouterLink, RouterView } from 'vue-router'
import HomeUser from '@/components/HomeUser.vue'
</script>


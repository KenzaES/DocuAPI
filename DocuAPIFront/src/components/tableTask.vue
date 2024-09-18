<template>
      <div class=" top-0 left-0 w-full z-50 bg-white border-b backdrop-blur-lg bg-opacity-80">
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

<div class="mt-20">
    <h1 class="text-center text-orange-700 font-bold text-3xl mb-16">Task List</h1>
    <div class="float-right">
      <!-- Button to trigger the modal -->
      <button @click="showModal.addTask = true"
        class="mb-20 mr-4 bg-yellow-400 text-gray-900 hover:bg-yellow-300 py-2 px-6 rounded-full text-lg font-semibold transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-lg">
        Add Task
      </button>
    </div>
    
    <!-- Modal Component -->
    <AddTaskModal v-if="showModal.addTask" @close="closeModal" />

    <table class="min-w-full divide-y divide-gray-200 overflow-x-auto">
    <thead class="bg-gray-50">
        <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Task Name
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Status
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Progression
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Start Date
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                End Date
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Actions
            </th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        <tr>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                    
                    <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">
                            task1
                        </div>
                        <div class="text-sm text-gray-500">
                            description
                        </div>
                    </div>
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">Important</div>
                
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                    in progress
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                11/09/2024
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                15/09/2024
            </td>
            <td class="px-6 py-4 whitespace-nowrap  text-sm font-medium">
                <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                <a href="#" class="ml-2 text-red-600 hover:text-red-900">Delete</a>
            </td>
        </tr>

    </tbody>
</table>
</div>
</template>

<script setup>
import { ref } from 'vue';
import AddTaskModal from '@/components/addTaskModal.vue'; 

const showModal = ref({
  addTask: false,
});

const closeModal = () => {
  showModal.value.addTask = false;
};
</script>
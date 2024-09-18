<template>
  <div class="fixed inset-0 bg-black bg-opacity-30 flex items-center justify-center overflow-auto ">
    <div class="bg-white dark:bg-orange-400 rounded-lg p-4 mt-20 shadow-lg w-full max-w-lg">
      <h3 class="text-2xl text-orange-800 font-bold mb-2 text-center">Add New Task</h3>
      
      <!-- Task form fields -->
      <div class="mb-4">
        <label class="block text-sm font-semibold mb-2">Title</label>
        <input v-model="taskTitle" type="text" class="w-full p-2 border rounded" placeholder="Enter task title" />
      </div>
      
      <div class="mb-4">
        <label class="block text-sm font-semibold mb-2">Description</label>
        <textarea v-model="taskDescription" class="w-full p-2 border rounded" placeholder="Enter task description"></textarea>
      </div>
      
      <div class="mb-4">
        <label class="block text-sm font-semibold mb-2">Status</label>
        <select v-model="taskStatus" class="w-full p-2 border rounded">
          <option value="normal">Normal</option>
          <option value="important">Important</option>
          <option value="urgent">Urgent</option>
        </select>
      </div>
      
      <div class="mb-4">
        <label class="block text-sm font-semibold mb-2">Progression</label>
        <select v-model="taskProgression" class="w-full p-2 border rounded">
          <option value="waiting">In waiting</option>
          <option value="in progress">In progress</option>
          <option value="done">Done</option>
        </select>
      </div>
      
      <div class="mb-4">
        <label class="block text-sm font-semibold mb-2">Start Date</label>
        <input v-model="taskStartDate" type="date" class="w-full p-2 border rounded" />
      </div>
      
      <div class="mb-4">
        <label class="block text-sm font-semibold mb-2">Deadline</label>
        <input v-model="taskDeadline" type="date" class="w-full p-2 border rounded" />
      </div>
      
      <!-- Actions -->
      <div class="flex justify-end space-x-4">
        <button @click="$emit('close')" class="py-2 px-4 bg-gray-200 rounded-lg">Cancel</button>
        <button @click="submitTask" class="py-2 px-4 bg-blue-500 text-white rounded-lg">Submit</button>
      </div>
    </div>
  </div>
</template>


<script setup>
import { ref } from 'vue';

// Task data management
const taskTitle = ref('');
const taskDescription = ref('');
const taskStatus = ref('normal');
const taskProgression = ref('waiting');
const taskStartDate = ref('');
const taskDeadline = ref('');

const submitTask = () => {
  // Logic to handle task creation
  console.log({
    title: taskTitle.value,
    description: taskDescription.value,
    status: taskStatus.value,
    progression: taskProgression.value,
    startDate: taskStartDate.value,
    deadline: taskDeadline.value,
  });
  
  // After submission, emit close event
  emit('close');
};
</script>
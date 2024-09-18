import { createRouter, createWebHistory } from 'vue-router';
import login from '@/components/login.vue';
import HomeView from '@/views/HomeView.vue';
import register from '@/components/Register.vue';
import Tasks from '@/components/Tasks.vue';
import dashboard from '@/components/tableTask.vue';


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
    },
    {
      path: '/login',
      name: 'login',
      component: login, 
    },
    {
      path: '/register',
      name: 'register',
      component: register, 
    },
    {
      path: '/dashboard',
      name: 'dashboard',
      component: dashboard, 
    },
    {
      path: '/Tasks',
      name: 'Tasks',
      component: Tasks, 
    },
    {
      path: '/YourSpace',
      name: 'userPage',
      component: () => import('../views/userPage.vue'),
    },
  ],
});

export default router;

import { defineStore } from 'pinia';
import axios from 'axios';
import { useRouter } from 'vue-router';

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null,
    token: null,
  }),
  
  actions: {
    async signInWithGoogle() {
      try {
        const response = await axios.get('auth/google');
        window.location.href = response.data.url;
      } catch (error) {
        console.error('Error during Google sign-in:', error);
      }
    },
    
    async loginWithEmail(email, password) {
      const router = useRouter(); 
      try {
        const response = await axios.post('/login', {
          email,
          password,
        });

        this.token = response.data.access_token;
        this.user = response.data.user;

        
        localStorage.setItem('access_token', response.data.access_token);
        localStorage.setItem('user', JSON.stringify(response.data.user));

        
        router.push('/YourSpace');
      } catch (error) {
        console.error('Login failed:', error);
      }
    },
  },
});

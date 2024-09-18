<template>
    <div>
      <button @click="launchToast">Show Toast</button>
  
      <div id="toast" :class="{ show: showToast }">
        <div id="img">Icon</div>
        <div id="desc">{{ message }}</div>
      </div>
    </div>
  </template>
  
  <script>
  import { ref } from 'vue';
  
  export default {
    setup() {
      const showToast = ref(false);
      const message = ref('A notification message..');
  
      function launchToast() {
        showToast.value = true;
        setTimeout(() => {
          showToast.value = false;
        }, 5000);
      }
  
      return {
        showToast,
        message,
        launchToast,
      };
    },
  };
  </script>
  
  <style scoped>
  #toast {
    visibility: hidden;
    max-width: 50px;
    height: 50px;
    margin: auto;
    background-color: #333;
    color: #fff;
    text-align: center;
    border-radius: 2px;
    position: fixed;
    z-index: 1;
    left: 0;
    right: 0;
    bottom: 30px;
    font-size: 17px;
    white-space: nowrap;
    transition: all 0.5s ease-in-out;
  }
  
  #toast.show {
    visibility: visible;
    min-width: 350px;
  }
  
  #toast #img {
    width: 50px;
    height: 50px;
    float: left;
    padding-top: 16px;
    padding-bottom: 16px;
    box-sizing: border-box;
    background-color: #111;
    color: #fff;
  }
  
  #toast #desc {
    color: #fff;
    padding: 16px;
    overflow: hidden;
    white-space: nowrap;
  }
  
  @keyframes fadein {
    from {
      bottom: 0;
      opacity: 0;
    }
    to {
      bottom: 30px;
      opacity: 1;
    }
  }
  
  @keyframes fadeout {
    from {
      bottom: 30px;
      opacity: 1;
    }
    to {
      bottom: 60px;
      opacity: 0;
    }
  }
  </style>
  
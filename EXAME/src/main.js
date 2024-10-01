import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'
import Home from '@/views/Home.vue'
import Jobs from '@/views/Jobs.vue'
import Register from '@/views/Register.vue'
import Message from '@/views/Message.vue'
import Login from '@/views/Login.vue'
import Logout from '@/views/Logout.vue'
import Publish from '@/views/Publish.vue'
import MyOffers from '@/views/MyOffers.vue'
import Welcome from '@/views/Welcome.vue'

const routes = [
  {
    path: '/welcome',
    component: Welcome
  },
  {
    path: '/',
    component: Home
  },
  {
    path: '/jobs',
    component: Jobs
  },
  {
    path: '/register',
    component: Register
  },
  {
    path: '/message',
    component: Message
  },
  {
    path: '/login',
    component: Login
  },
  {
    path: '/logout',
    component: Logout
  },
  {
    path: '/publish',
    component: Publish
  },    
  {
    path: '/myoffers',
    component: MyOffers
  }        
]

createApp(App).use(createPinia()).use(router).mount("#app");

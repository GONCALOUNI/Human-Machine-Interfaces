import { createRouter, createWebHistory } from 'vue-router'
import Home from '@/views/Home.vue'
import Jobs from '@/views/Jobs.vue'
import Register from '@/views/Register.vue'
import Message from '@/views/Message.vue'
import Login from '@/views/Login.vue'
import Logout from '@/views/Logout.vue'
import Publish from '@/views/Publish.vue'
import MyOffers from '@/views/MyOffers.vue'
import Welcome from '@/views/Welcome.vue'

//AVISO: ALTERAR O PATH '/' PARA O COMPONENTE 'Home' NO EXAME

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

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes
})

export default router

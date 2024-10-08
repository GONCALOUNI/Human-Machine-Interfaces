import { createRouter, createWebHistory } from 'vue-router'
import Welcome from '@/views/Welcome.vue'
import Home from '@/views/Home.vue'
import Pets from '@/views/Pets.vue'
import Register from '@/views/Register.vue'
import Message from '@/views/Message.vue'
import Login from '@/views/Login.vue'
import Logout from '@/views/Logout.vue'
import MyPets from '@/views/MyPets.vue'

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
    path: '/pets/:id?',
    component: Pets
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
    path: '/mypets',
    component: MyPets
  },                 
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes
})

export default router

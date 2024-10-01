import {createApp} from 'vue'
import {createPinia} from 'pinia'

import App from './App.vue'
import router from './router'
import Microposts from './views/Microposts.vue'
import Register from './views/Register.vue'
import Login from './views/Login.vue'
import Logout from './views/Login.vue'
import Message from './views/Message.vue'
import Post from './views/Post.vue'
import UpdatePost from './views/UpdatePost.vue'
import CommentPost from './views/CommentPost.vue'

const routes = [
    {
      path: '/',
      component: Microposts
    },
    {
      path: '/register',
      component: Register
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
      path: '/message/:id',
      component: Message
    },
    {
      path: '/post',
      component: Post
    },
    {
      path: '/updatePost/:id',
      component: UpdatePost
    },
    {
      path: '/commentPost/:id',
      component: CommentPost
    },
  ]
   
createApp(App).use(createPinia()).use(router).mount("#app");

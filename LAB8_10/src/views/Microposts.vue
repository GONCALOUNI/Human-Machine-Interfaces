<template>
  <Menu />
  <div>
    <nav id="navbar" class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="navbar-container d-flex justify-content-between align-items-center" style="width: 800px; height: 80px;">
        <div class="d-flex align-items-center">
          <img src="../assets/images/logo.png" alt="PetinhosTalk" style="height: 40px; margin-left: 11px;">
        </div>
        <ul class="navbar-nav ml-auto mt-3" style="margin-right: 60px;">
          <li class="nav-item">
            <router-link to="/" class="nav-link">Home</router-link>
          </li>
          <li class="nav-item" v-if="userStore.isAuthenticated">
            <router-link to="/post" class="nav-link text-center">Post blog</router-link>
          </li>
          <li class="nav-item" v-if="userStore.isAuthenticated">
            <router-link to="/logout" class="nav-link text-center">Logout</router-link>
          </li>
          <li class="nav-item" v-if="!userStore.isAuthenticated">
            <router-link to="/login" class="nav-link text-center">Login</router-link>
          </li>
          <li class="nav-item" v-if="!userStore.isAuthenticated">
            <router-link to="/register" class="nav-link text-center">Register</router-link>
          </li>
        </ul>
        <span class="nav-link text-center welcome" v-if="userStore.isAuthenticated">Welcome {{userStore.user.name}}</span>
      </div>
    </nav>
  </div>
  <div class="content-container container shadow">
    <!-- BEGIN MICROPOSTS -->
    <div v-for="micropost in microposts" :key="micropost.id" class="post-container">
      <div class="post">
        <div class="post-author bold-text">{{micropost.name}}</div>
        <div class="post-date ">Created at: {{micropost.created_at}}</div>
        <div v-if="micropost.name === userStore.user.name && userStore.isAuthenticated" class="post-update">
          <router-link :to="'/updatePost/' + micropost.id"><b>Update blog</b> (Updated at: {{micropost.updated_at}})</router-link>
        </div>
        <div v-else class="post-update">Updated at: {{micropost.updated_at}}</div>
        <div class="post-content">{{micropost.content}}</div>
        <div class="post-comment" style="margin-top: -9px;" v-if="(micropost.name !== userStore.user.name) && (userStore.isAuthenticated)">
          <router-link :to="'/commentPost/' + micropost.id"><br>Comment post</router-link>
        </div>
        <div class="post-comment" style="margin-top: -9px;" v-if="!userStore.isAuthenticated">
          <router-link :to="'/message/8'"><br>Comment post</router-link>
        </div>
        <div class="show-comments" :style="{'margin-bottom': expandedPostId === micropost.id ? '20px' : '0px'}">
          <button class="btn btn-sm" style="color: #ffffff; background-color: #f87538; width: 92px; padding: 0px; text-align: center; line-height: 20px; font-size: 11.5px; margin-top: 14px;" @click="showComments(micropost.id)">
            {{expandedPostId === micropost.id ? 'Hide comments' : 'Show comments'}}
          </button>
        </div>
        <div v-if="expandedPostId === micropost.id">
          <div v-if="commentsStore.getPostComments(micropost.id).length > 0">
            <div v-for="comment in commentsStore.getPostComments(micropost.id)" :key="comment.id">
              <div class="post" style="margin-top: 12px;">
                <div class="post-author bold-text">{{comment.user_name}}</div>
                <div class="post-date">Commented at: {{comment.created_at}}</div>
                <div class="post-content">{{comment.content}}</div>
              </div>
            </div>
          </div>
          <div v-else>
            <p style="margin-top: -5px; margin-bottom: -5px"><b>There are no comments on this post yet, why don't you be the first to reply?</b></p>
          </div>
        </div>
      </div>
    </div>
    <!-- END MICROPOSTS -->
  </div>
  <Footer />
</template>

<script>
import Footer from '@/components/Footer.vue'
import Menu from '@/components/Menu.vue'

import { useUserStore } from '@/store/user'
import { useMicropostsStore } from '@/store/microposts'
import { useCommentsStore } from '@/store/comments'

export default {
  setup() {
    const userStore = useUserStore()
    const micropostsStore = useMicropostsStore()
    const commentsStore = useCommentsStore()
    micropostsStore.getMicropostsDB()
    commentsStore.getCommentsDB()
    return { userStore, commentsStore, micropostsStore }
  },
  components: {
    Footer,
    Menu,
  },
  data() {
    return {
      expandedPostId: null,
    }
  },
  computed: {
    microposts() {
      return this.micropostsStore.getMicroposts
    },
  },
  methods: {
    async showComments(micropostId) {
      if (this.expandedPostId === micropostId) {
        this.expandedPostId = null
      } else {
        this.expandedPostId = micropostId
      }
    },
  },
}
</script>

<style scoped>
  .navbar
  {
    border-radius: 0;
  }

  .bg-light
  {
    background-color: #f87538!important;
    padding: 7px 7px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
  }

  .navbar-nav .nav-link
  {
    color: #7F7F7F;
    text-decoration: none;
    border-radius: 8px;
    font-size: 16px;
    transition: background-color 0.3s, color 0.3s;
  }

  .navbar-nav
  {
    list-style: none;
    padding: 0;
  }

  .navbar-nav .nav-item
  {
    display: inline-block;
    margin-right: 16px;
  }

  .navbar-nav .nav-link:hover
  {
    background-color: #f87538;
    color: #ffffff!important;
  }

  .welcome
  {
    color: #f87538;
    font-size: 16px;
  }

  .container
  {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
  }

  .post-container
  {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 8px;
  }

  .footer-container
  {
    width: 800px;
    height: 60px;
    margin: 0 auto;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
  }

  .navbar-container
  {
    max-width: 800px;
    max-height: 80px;
    margin: 0 auto;
    background-color: #ffffff;
    border-radius: 8px;
    padding: 8.5px 8.5px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    text-align: center;
  }

  .content-container
  {
    width: 800px;
    margin-top: -20px;
    margin-bottom: 8px;
  }

  .post
  {
    max-width: 800px;
    margin-top: -20px;
    border: 1px solid #aaaaaa;
    padding: 20px;
    border-radius: 8px;
  }

  .post-author
  {
    font-weight: bold;
    text-decoration: underline;
    color: #f87538;
  }

  .post-date
  {
    font-style: italic;
    color: #888888;
  }

  .post-update
  {
    font-style: italic;
    color: #888888;
  }

  .post-content
  {
    margin-top: 10px;
  }
</style>
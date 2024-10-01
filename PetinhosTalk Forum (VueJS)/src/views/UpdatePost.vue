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
	  <section class="h-100">
	  <div class="container position-relative shadow" style="margin-top: -20px; margin-bottom: 8px;">
		<div class="content-container py-5 h-100 d-flex">
		  <form @submit.prevent="updateBlog">
			<textarea v-model="post.content" placeholder="Type your blog here:" rows="5" style="resize: none !important; width: 420px; height: 245px; margin-top: 25px; margin-left: 170px;"></textarea>
			<div class="button-container mt-3">
			  <button type="submit" class="btn btn-green btn-lg" name="update">Update</button>
			  <router-link to="/" class="btn btn-red btn-lg ms-2" name="cancel">Cancel</router-link>
			</div>
		  </form>
		</div>
	  </div>
	</section>
   </div>
   <Footer />
</template>
  
<script>
import Footer from '@/components/Footer.vue'
import Menu from '@/components/Menu.vue'
import {useUserStore} from '@/store/user'
import {useMicropostsStore} from '@/store/microposts'

export default {
  setup() {
    const userStore = useUserStore();
    const micropostsStore = useMicropostsStore();
    return {userStore, micropostsStore};
  },
  components: {
    Footer,
    Menu
  },
  data() {
    return {
      submitting: false,
	  error: false,
      post: {
        content: '',
      },
	  user: {
		id: '', 
		name: '', 
		email: '', 
		session_id: ''
	  },
    };
  },
  created()
  {
    this.loadMicropostContent();
  },
  methods:
  {
    async loadMicropostContent()
	{
      const postId = this.$route.params.id;
      this.post.content = this.micropostsStore.getMicropost(postId).content;
	  this.post.user_id = this.micropostsStore.getMicropost(postId).user_id;
    },
	async updateBlog()
	{
		if(!this.userStore.isAuthenticated)
		{
			this.$router.push({path:`/message/${8}`});
			return;
		}
		if(this.userStore.user.id !== this.post.user_id)
		{
			this.$router.push({path:`/message/${9}`});
			return;
		}
		this.submitting = true;
		try
		{
			const updateSuccess = await this.micropostsStore.updateMicropostDB({
				session_id: this.userStore.user.session_id,
				post_id: this.$route.params.id,
				post:
				{
					content: this.post.content,
				},
			});
			if(updateSuccess) {this.$router.push({path:`/message/${1}`});}
		}
		catch(error)
		{
		}
		finally
		{
			this.submitting = false;
		}
	}
  }
};
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
	
	.form-control
	{
	  border-color: #aaaaaa!important;
	  resize: none;
	}
	
	a
	{
	  color: #f87538;
	}
	
	.btn-green
	{
	  color: #ffffff;
	  background-color: #4CAF50;
	  border-color: #4CAF50;
	}
	
	.btn-red
	{
	  color: #ffffff;
	  background-color: #F44336;
	  border-color: #F44336;
	}
  
	.button-container
	{
	  display: flex;
	  justify-content: center;
	  margin-top: 20px;
	}
  
	.btn-green
	{
	  margin-right: 10px;
	}
  </style>
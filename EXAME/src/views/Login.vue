<template>
<div>
<header class="site-navbar mt-3">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="site-logo col-6"><router-link to="/">Careers</router-link></div>
          <nav class="mx-auto site-navigation">
            <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0">
              <li><router-link to="/" v-if="!userStore.isAuthenticated">Home</router-link></li>
              <li><router-link to="/jobs" v-if="!userStore.isAuthenticated">Job Listings</router-link></li>
              <li><router-link to="/register" v-if="!userStore.isAuthenticated">Register</router-link></li>
            </ul>
          </nav>
        </div>
      </div>
</header>
<section class="home-section section-hero inner-page overlay bg-image"
      style="background-image: url('images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-12">
            <div class="mb-5 text-center">
              <h1 class="text-white font-weight-bold">Login</h1>
              <p>Find your dream job with us.</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="site-section" id="next-section">
      <div class="container">
        <div class="row">
			<div class="col-lg-3">
			</div>
          <div class="col-lg-6 mb-5 mb-lg-0">
            <form @submit.prevent="submitForm" method="post">
              <div class="row form-group">
                <div class="col-md-6">
                  <label class="text-black" for="email">Email</label>
                  <input v-model="user.email" type="email" id="email" class="form-control">
                </div>
              </div>
			  <div class="row form-group">
                <div class="col-md-6">
                  <label class="text-black" for="password">Password</label>
                  <input v-model="user.password" type="password" id="password" class="form-control">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Login" class="btn btn-primary btn-md text-white">
                </div>
              </div>
            </form>
          </div>
		<div class="col-lg-3">
		</div>
        </div>
      </div>
    </section>
<Footer />
</div>
</template>
<script>
import Footer from '@/components/Footer.vue'
import Header from '@/components/Header.vue'


import { useUserStore } from '@/store/user'

export default {
	setup() {
		const userStore = useUserStore()		
		return { userStore }
  },    
  components: {
      Footer,
      Header
  },
  data() {
      return {
        user:
        {
            email: '',
            password: '',        
        },
        alertMessageStyle: 'display:none;'      
      }
  },
  mounted() {
    if(this.userStore.isAuthenticated) 
        {
            localStorage.setItem('message', "Error: You are already logged in!");
            this.$router.push({path:`/message`});
        }
  },
  methods:
 {
  async submitForm()
    {
      if(!this.user.email || !this.user.password)
      {
        this.resetForm();
        return;
      }
      if(this.userStore.isAuthenticated) 
      {
        localStorage.setItem('message', "Error: You are already logged in!");
        this.$router.push({path:`/message`});
        return;
      }
      try
      {
        const success = await this.userStore.loginUserDB(this.user);
        if(success)
        {
          this.userStore.isAuthenticated = true;
          localStorage.setItem('message', "Welcome back!");
          this.$router.push({path:`/message`});
        }
        else
        {
          this.resetForm();
          return;
        }
      }
      catch(error)
      {
        this.resetForm();
      }
    },
    resetForm()
    {
      this.user.email = '';
      this.user.password = '';
    },
  },
  computed: {
      invalidEmail() {

      },
      invalidPassword() {

      },                        
  },
}
</script>
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
              <li><router-link to="/login" v-if="!userStore.isAuthenticated">Login</router-link></li>
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
              <h1 class="text-white font-weight-bold">Register</h1>
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
            <form @submit.prevent="submitForm">
              <div class="row form-group">
                <div class="col-md-6">
                  <label class="text-black" for="name">Name</label>
                  <input v-model="user.name" type="text" id="username" class="form-control">
                </div>
              </div>
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
                <div class="col-md-6">
                  <label class="text-black" for="password">Confirm Password</label>
                  <input v-model="passwordConfirm" type="password" id="passwordConfirm" class="form-control">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Register" class="btn btn-primary btn-md text-white">
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
                name: '',
                email: '',
                password: '',
            },
            passwordConfirm: '',     
        }
    },

    mounted() {
        if(this.userStore.isAuthenticated) 
        {
            localStorage.setItem('message', "Error: You are already logged in!");
            this.$router.push({path:`/message`});
        }
    },
    methods: {
        async submitForm()
    {
      if(this.userStore.isAuthenticated) 
      {
        localStorage.setItem('message', "Error: You are already logged in!");
        this.$router.push({path:`/message`});
      }
      if(!this.user.name || !this.user.email || !this.user.password || !this.passwordConfirm)
      {
        this.resetForm();
      }
      else if(!/^\S+@\S+\.\S+$/.test(this.user.email))
      {
        this.resetForm();
      }
      else if(this.user.password !== this.passwordConfirm)
      {
        this.resetForm();
      }
      try
      {
        const userExists = await this.userStore.userExistsDB(this.user);
        if(userExists)
        {
            this.resetForm();
        }
        else
        {
          await this.userStore.addUserDB(this.user);
          localStorage.setItem('message', 'Welcome! You can now login');
          this.$router.push({ path: '/message' });
        }
      }
      catch(error)
      {
        this.resetForm();
      }
      finally
      {
      }
    },
    resetForm()
    {
      this.user.name = '';
      this.user.email = '';
      this.user.password = '';
      this.passwordConfirm = '';
    },        
    },
    computed: {
        invalidName: function () {

        },
        invalidEmail: function () {

        },
        invalidPassword: function () {

        },
        invalidPasswordConfirm: function () {

        },                
    },

}
</script>
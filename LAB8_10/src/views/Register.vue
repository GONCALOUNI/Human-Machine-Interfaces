<template>
  <div>
    <Menu />
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
      <div class="container shadow" style="margin-top: -20px; margin-bottom: 8px;">
        <div class="content-container py-5 h-100" style="margin-top: -20px;">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <h3 class="mb-5 text-uppercase text-center" >Join our family!</h3>
            <form @submit.prevent="submitForm">
              <h4 v-if="errorMessage" style="color: #DC3545; margin-top: 17px;" class="text-center text-danger mb-5 text-uppercase">{{errorMessage}}</h4>
              <div class="form-group">
                <label for="form3Example1m">Your name:</label>
                <input v-model="user.name" type="text" id="form3Example1m" name="name" class="form-control form-control-lg" placeholder="Input your name please" required style="max-width: 790px;">
              </div>
              <div class="form-group">
                <label for="form3Example97">Your e-mail address:</label>
                <input v-model="user.email" type="email" id="form3Example97" name="email" class="form-control form-control-lg" placeholder="someone@mail.com" required style="max-width: 790px;">
              </div>
              <div class="form-group">
                <label for="form3Example8">Desired password:</label>
                <input v-model="user.password" type="password" id="form3Example8" name="password" class="form-control form-control-lg" placeholder="Enter password" required style="max-width: 790px;">
              </div>
              <div class="form-group">
                <label for="form3Example90">Password confirmation:</label>
                <input v-model="passwordConfirmation" type="password" id="form3Example90" name="password_confirmation" class="form-control form-control-lg" placeholder="Retype password" required style="max-width: 790px;">
              </div>
              <div class="d-flex justify-content-center pt-3" style="margin-left: 291.5px">
                <button type="reset" class="btn btn-light btn-lg">Clear</button>
                <button type="submit" class="btn btn-warning btn-lg ms-2">Register Account</button>
              </div>
              <p class="text-center mt-3" style="margin-top: 20px">Already have an account? <router-link to="/login">Login here!</router-link></p>
            </form>
          </div>
        </div>
      </div>
    </section>
    <Footer />
  </div>
</template>

<script>
import Footer from '@/components/Footer.vue'
import Menu from '@/components/Menu.vue'

import {useUserStore} from '@/store/user'

export default {
  setup() {
    const userStore = useUserStore()
    return { userStore }
  },
  components: {
    Footer,
    Menu
  },
  data() {
    return {
      user: {
        name: '',
        email: '',
        password: '',
      },
      passwordConfirmation: '',
      submitting: true,
      error: true,
      errorMessage: '',
    }
  },
  methods:
  {
    async submitForm()
    {
      this.errorMessage = '';
      this.submitting = true;

      if (
        !this.user.name ||
        !this.user.email ||
        !this.user.password ||
        !this.passwordConfirmation
      ) {
        this.errorMessage = 'Missing input fields.';
        this.resetForm();
      } else if (!/^\S+@\S+\.\S+$/.test(this.user.email)) {
        this.errorMessage = 'Invalid email format.';
        this.resetForm();
      } else if (this.user.password !== this.passwordConfirmation) {
        this.errorMessage = 'Passwords do not match.';
        this.resetForm();
      }

      if(this.errorMessage)
      {
        return;
      }
      try
      {
        const userExists = await this.userStore.userExistsDB(this.user);
        if(userExists)
        {
          this.errorMessage = 'User already exists.';
          this.resetForm();
        }
        else
        {
          await this.userStore.addUserDB(this.user);
          this.$router.push({path: `/message/${4}`});
        }
      }
      catch(error)
      {
        this.resetForm();
      }
      finally
      {
        this.submitting = false;
      }
    },
    resetForm()
    {
      this.user.name = '';
      this.user.email = '';
      this.user.password = '';
      this.passwordConfirmation = '';
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

  .card-registration .select-input.form-control[readonly]:not([disabled])
  {
	font-size: 1rem;
    line-height: 2.15;
    padding-left: .75em;
    padding-right: .75em;
  }        
  
  .card-registration .select-arrow
  {
	top: 13px;
  }

  .form-control
  {
	border-color: #aaaaaa!important;
  }

  a
  {
	color: #f87538;
  }

  .btn-warning
  {
	color: #ffffff;
	background-color: #f87538;
	border-color: #f87538;
  }

  .btn-warning:hover
  {
	background-color: #f87538;
	color: #ffffff;
	border-color: #f87538;
  }
</style>
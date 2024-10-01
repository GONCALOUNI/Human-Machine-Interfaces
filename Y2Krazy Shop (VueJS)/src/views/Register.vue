<template>
  <div class="registration-page">
    <nav class="navbar">
      <router-link to="/" class="logo">Y2Krazy Shop®</router-link>
      <span style="left: 216px; color: yellow; position: absolute">Rewind, Refresh, Relove the 2000s!</span>
      <div class="nav-links">
        <router-link to="/" class="nav-link">Home</router-link>
        <router-link to="/menu" class="nav-link">Products</router-link>
        <router-link to="/register" v-if="!userStore.isAuthenticated" class="nav-link">Register</router-link>
        <router-link to="/login" v-if="!userStore.isAuthenticated" class="nav-link">Login</router-link>
        <router-link to="/basket" class="nav-link">Basket</router-link>
        <router-link to="/myorders" v-if="userStore.isAuthenticated" class="nav-link">My Orders</router-link>
        <router-link to="/logout" v-if="userStore.isAuthenticated" class="nav-link">Logout</router-link>
        <span v-if="userStore.isAuthenticated" style="margin-right: 22px; color: yellow">{{userStore.user.name}}</span>
      </div>
    </nav>
    <div class="registration-container">
      <h1 style="margin-left: 50px;">Join the Y2Krazy Family!</h1>
      <form @submit.prevent="submitForm" style="margin-bottom: 110px;">
        <img src="../assets/images/at.gif" alt="At" style="height: 43px; margin-left: 35px; margin-top: -20px; margin-bottom: -8px;">
        <h2 v-if="errorMessage" style="color: #DC3545; margin-top: 4px; margin-left: 45px;">{{errorMessage}}</h2>
        <div class="form-group">
          <label style="margin-left: 50px;" for="username">Username:</label>
          <input v-model="user.name" type="text" id="username" name="username" class="form-control" style="width: 300px;
	        font-family: 'Comic Sans MS', 'Chalkboard SE', 'Comic Neue', cursive; margin-left: 20px;" required> 
        </div>
        <div class="form-group">
          <label style="margin-left: 43px;" for="email">Email:</label>
          <input v-model="user.email" type="email" id="email" name="email" class="form-control" style="width: 300px;
	        font-family: 'Comic Sans MS', 'Chalkboard SE', 'Comic Neue', cursive; margin-left: 20px;" required>
        </div>
        <div class="form-group">
          <label style="margin-left: 48px;" for="password">Password:</label>
          <input v-model="user.password" type="password" id="password" name="password" class="form-control" style="width: 300px;
          font-family: 'Comic Sans MS', 'Chalkboard SE', 'Comic Neue', cursive; margin-left: 20px;" required>
        </div>
        <div class="form-group">
          <label style="margin-left: 50px;" for="confirmPassword">Confirm Password:</label>
          <input v-model="passwordConfirmation" type="password" id="confirmPassword" name="confirmPassword" class="form-control" style="width: 300px; 
	        font-family: 'Comic Sans MS', 'Chalkboard SE', 'Comic Neue', cursive; margin-left: 20px;" required>
        </div>
        <button type="submit" class="btn btn-warning" style="margin-left: 40px;">Register Account</button>
        <p class="text-center mt-3" style="margin-top: 20px; margin-left: 32px;">Already have an account? <router-link to="/login">Login here!</router-link></p>
      </form>
    </div>
    <Footer />
  </div>
</template>

<Footer />

<script>
import Footer from '@/components/Footer.vue'
import Header from '@/components/Header.vue'

import {useUserStore} from '@/store/user'

export default
{
	
	setup()
  {
		const userStore = useUserStore()
		return {userStore}
  },
	components:
  {
		Footer,
    Header
	},
	data()
  {
    return {	
      user:
      {
			  name: '',
			  email: '',
			  password: '',
      },
		  passwordConfirmation: '',
		  submitting: true,
		  error: true,	
    }
  },
  mounted()
  {
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
      this.submitting = true;
      
      if(this.userStore.isAuthenticated) 
      {
        localStorage.setItem('message', "Error: You are already logged in!");
        this.$router.push({path:`/message`});
      }
      if(!this.user.name || !this.user.email || !this.user.password || !this.passwordConfirmation)
      {
        this.resetForm();
      }
      else if(!/^\S+@\S+\.\S+$/.test(this.user.email))
      {
        this.errorMessage = 'Invalid email format.';
        this.resetForm();
      }
      else if(this.user.password !== this.passwordConfirmation)
      {
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
  }
}
</script>

<style scoped>

.navbar
{
	background: linear-gradient(to right, #11117c, #3498db);
	padding: 10px;
	display: flex;
	justify-content: space-between;
	align-items: center;
	font-family: 'Comic Sans MS', 'Chalkboard SE', 'Comic Neue', cursive;
}

.logo
{
	font-size: 24px;
	font-weight: bold;
	color: #ffffff;
	text-decoration: none;
}

.nav-links
{
	display: flex;
}

.nav-link
{
  text-decoration: none;
  color: #ffffff;
  margin-right: 30px;
  font-size: 16px;
  position: relative;
}

.nav-link::before
{
  content: '';
  position: absolute;
  width: 8px;
  height: 8px;
  background: linear-gradient(to bottom, #ffffff, #bbbbbb);
  border-radius: 50%;
  left: -11px;
  top: 50%;
  transform: translateY(-50%);
  display: block;
}
  
.nav-link:hover
{
  text-decoration: underline;
}

.registration-container
{
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
  margin-top: 20px;
  font-family: 'Comic Sans MS', cursive;
}

.registration-container h1
{
  margin-bottom: 20px;
}

.form-group
{
 margin-bottom: 15px;
 width: 300px;
}

.form-control
{
 width: 100%;
}

.btn
{
 background: linear-gradient(to right, #ffcc00, #ff9933);
 width: 130px;
 margin-left: 6px;
 margin-bottom: 30px;
 cursor: pointer;
 color: #ffffff;
 font-family: 'Comic Sans MS', cursive;
}

.footer-container
{
  width: 94.3vw;
  padding: 20px;
	font-family: 'Comic Sans MS', 'Chalkboard SE', 'Comic Neue', cursive;
	display: bottom;
}
</style>
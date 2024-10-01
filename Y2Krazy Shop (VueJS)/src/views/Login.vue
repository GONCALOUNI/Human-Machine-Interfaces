<template>
  <div class="login-page">
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
   <div class="login-container">
    <div>
      <h1 style="margin-left: 35px;">Login now!</h1>
      <img src="../assets/images/cool.png" alt="Emoticon" style="width: 40px; margin-top: -20px; margin-left: 35px;"/>
    </div>
    <form @submit.prevent="submitForm" style="margin-bottom: 241px;">
       <div class="form-group">
         <label for="email" style="margin-left: 30px;">Email: </label>
         <input v-model="user.email" type="email" id="email" name="email" class="form-control" style="width: 300px; height: 19px; margin-right: 38px; margin-bottom: 5px; 
         font-family: 'Comic Sans MS', 'Chalkboard SE', 'Comic Neue', cursive;" required>
       </div>
       <div class="form-group">
         <label for="password" style="margin-left: 30px;">Password: </label>
         <input v-model="user.password" type="password" id="password" name="password" class="form-control" style="width: 300px; height: 19px; margin-right: 66px;" required>
       </div>
       <button type="submit" class="btn btn-warning" style="margin-left: 30px;">Login</button>
       <p style="margin-top: 20px; margin-left: 35px;">Not a member yet? <router-link to="/register">Register your free account here!</router-link></p>
    </form>
   </div>
   <Footer />
 </div>
</template>

<script>
import Footer from '@/components/Footer.vue'
import Header from '@/components/Header.vue'

import {useUserStore} from '@/store/user'
import {useBasketStore} from '@/store/basket'

export default
{

 setup()
 {
   const userStore = useUserStore()
	 const basketStore = useBasketStore()
   return {userStore, basketStore}
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
        email: '',
        password: '',
      },
      submitting: false,
      error: false,
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

      if(!this.user.email || !this.user.password)
      {
        this.submitting = false;
        this.resetForm();
        return;
      }
      if(this.userStore.isAuthenticated) 
      {
        localStorage.setItem('message', "Error: You are already logged in!");
        this.submitting = false;
        this.$router.push({path:`/message`});
        return;
      }
      try
      {
        const user = {email: this.user.email, password: this.user.password};
        const success = await this.userStore.loginUserDB(user);
        if(success)
        {
          this.userStore.isAuthenticated = true;
          this.basketStore.clearBasket();
          localStorage.setItem('message', "Welcome back " + this.userStore.getUser.name + "!");
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
      finally
      {
        this.submitting = false;
      }
    },
    resetForm()
    {
      this.user.email = '';
      this.user.password = '';
      this.submitting = false;
      this.errorMessage = '';
    },
  },
 computed:
 {
 },
 directives:
 {
 },
 created: function ()
 {
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

.login-container
{
 display: flex;
 flex-direction: column;
 align-items: center;
 justify-content: center;
 text-align: center;
 margin-top: 20px;
 font-family: 'Comic Sans MS', cursive;
}

.login-container h1
{
 margin-bottom: 20px;
}

.form-group
{
 margin-bottom: 15px;
}

.form-control
{
 width: 100%;
}

.btn
{
 background: linear-gradient(to right, #ffcc00, #ff9933);
 width: 100px;
 margin-left: -5px;
 margin-bottom: 30px;
 cursor: pointer;
 color: #ffffff;
 text-align: center;
 font-family: 'Comic Sans MS', cursive;
}

.footer-container
{
  width: 94.3vw;
  padding: 20px;
	font-family: 'Comic Sans MS', 'Chalkboard SE', 'Comic Neue', cursive;
	display: bottom;
	justify-content: space-between;
}
</style>
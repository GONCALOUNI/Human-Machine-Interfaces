<template>
	<header id="header">
	  <div class="container main-menu">
		  <div class="row align-items-center justify-content-between d-flex">
			<div id="logo">
				<router-link to="/"><img src="/img/logo.png" alt="" title="Logo Image" /></router-link>
			</div>
			<nav id="nav-menu-container">
			  <ul v-if="userIsEmpty" class="nav-menu">
				<li><router-link to="/pets/1">Dogs</router-link></li>
				<li><router-link to="/pets/2">Cats</router-link></li>
				<li><router-link to="/register">Register</router-link></li>   
				<li><router-link to="/login">Login</router-link></li>                                                 						  
			  </ul>
			  <ul v-else class="nav-menu">
				<li><router-link to="/pets/1">Dogs</router-link></li>
				<li><router-link to="/pets/2">Cats</router-link></li>                                                                       
				<li><router-link to="/mypets">My pets</router-link></li>
				<li><router-link to="/logout">Logout</router-link></li>	
				<li><router-link to="#">Welcome {{userName}}</router-link></li>	 				  
			  </ul>                        
			</nav><!-- #nav-menu-container -->		    		
		  </div>
	  </div>
	</header><!-- #header -->
</template>

<script>

import { useUserStore } from '@/store/user'

export default {

setup() {
	const userStore = useUserStore()
	return { userStore }
},

methods: {
logout() {
  localStorage.setItem('message', `Bye ${this.userStore.user.name}, see you back soon!`);
  this.userStore.logoutUser()
  this.$router.push('/message')
}
},
computed: {
userIsEmpty() {
  let obj = this.userStore.getUser
  return Object.keys(obj).length === 0;
},
userName() {
  return this.userStore.getUser.name
}
},

}


</script>

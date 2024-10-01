<template>
</template>
  
<script>
import {useUserStore} from '@/store/user'

export default
{
	setup()
	{
	  const userStore = useUserStore()
	  return {userStore}
	},
	data()
	{
	  return {
		success: false,
		user: {},
	  }
	},
	methods:
	{
		logout()
		{
			this.userStore.isAuthenticated = false;
  			localStorage.setItem('message', `Bye ${this.userStore.user.name}, see you back soon!`);
  			this.userStore.logoutUser()
  			this.$router.push('/message')
		}
	},
	mounted()
	{
	  this.logout();
	},
};
</script>
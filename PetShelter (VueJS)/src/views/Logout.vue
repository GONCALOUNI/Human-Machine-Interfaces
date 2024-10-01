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
	  async performLogout()
	  {
		try
		{
      		localStorage.setItem('message', "Bye " + this.userStore.user.name + ", come back soon!");
      		this.userStore.isAuthenticated = false;
      		this.$router.push({path:`/message`});
			this.userStore.logoutUser();
		  	userStore.clearUser();
		  	this.success = true;
		}
		catch(error)
		{
		}
		finally
		{
			this.sucess = false;
		}
	  },
	},
	mounted()
	{
	  this.performLogout();
	},
};
</script>
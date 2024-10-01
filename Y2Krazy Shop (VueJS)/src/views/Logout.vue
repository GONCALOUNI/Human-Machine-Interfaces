<template>
</template>
  
<script>
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
			this.basketStore.clearBasket();
     		this.userStore.logoutUserDB();
      		this.userStore.isAuthenticated = false;
      		this.$router.push({path:`/message`});
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
<template>
    <div>
        <Header />
        <!-- start banner Area -->
			<section class="banner-area relative" id="home">	
				<div class="overlay overlay-bg"></div>
				<div class="container">				
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h1 class="text-white">
								Register			
							</h1>	
						</div>	
					</div>
				</div>
			</section>
			<!-- End banner Area -->	
				
			<!-- Start Volunteer-form Area -->
			<section class="Volunteer-form-area section-gap">
				<div class="container">
					
					<div class="row justify-content-center">
						<form @submit.prevent="submitForm" class="col-lg-9">
						  <div class="form-group">
						    <label for="name">Name</label>
						    <input v-model="user.name" type="text" id="username" name="username" class="form-control" placeholder="Name" required autofocus>
						  </div>
						   <div class="form-group">
								<label for="email">Email Address</label>
						   		<input v-model="user.email" type="email" id="email" name="email" class="form-control" placeholder="Valid email Address" required>
							</div>	
						  
						  <div class="form-row"> 							  	
						  	<div class="col-6 mb-30">
						  		<label for="password">Password</label>
						   		<input v-model="user.password" type="password" id="password" name="password" class="form-control" placeholder="Password" required>
						  	</div>
						  	<div class="col-6 mb-30">
						  		<label for="passwordConfirm">Confirm Password</label>
						   		<input v-model="passwordConfirm" type="password" id="passwordConfirm" name="passwordConfirm" class="form-control" placeholder="Repeat Password" required>						  		
						  	</div>
						  </div>		
						  
						  <button type="submit" class="primary-btn float-right">Submit</button>
						</form>
					</div>
				</div>	
			</section>
			<!-- End Volunteer-form Area -->
        <Footer />

    </div>
</template>
<script>
import Footer from '@/components/Footer.vue'
import Header from '@/components/Header.vue'

import { useUserStore } from '@/store/user'

export default {
    name: 'register',
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
    methods:
    {
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
               
    },

}
</script>
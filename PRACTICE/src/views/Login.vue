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
								Login			
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
						  
						  <div class="form-row"> 							  	
						  	<div class="col-6 mb-30">
						  		<label for="email">Email</label>
						   		<input v-model="user.email" type="email" id="email" class="form-control" placeholder="Enter a valid email" required>
						  	</div>
						  	<div class="col-6 mb-30">
						  		<label for="password">Password</label>
						   		<input v-model="user.password" type="password" id="password" class="form-control" placeholder="Enter Password" required>						  		
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

import { useAdoptionsStore } from '@/store/adoptions'
import { useUserStore } from '@/store/user'

export default {
	setup() {
		const adoptionsStore = useAdoptionsStore()
		const userStore = useUserStore()		
		return { adoptionsStore, userStore }
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
    },
    resetForm()
    {
      this.user.email = '';
      this.user.password = '';
    },
  },
    computed: {
                       
    },
}
</script>
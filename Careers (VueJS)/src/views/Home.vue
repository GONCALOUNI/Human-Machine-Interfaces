<template>
	<div class="site-wrap">
		<header class="site-navbar mt-3">
		<div class="container-fluid">
			<div class="row align-items-center">
			<div class="site-logo col-6"><router-link to="/">Careers</router-link></div>
			<nav class="mx-auto site-navigation">
			</nav>
			</div>
		</div>
		</header>
		<section class="home-section section-hero overlay bg-image" style="background-image: url('images/hero_1.jpg');" id="home-section">

      		<div class="container">
        		<div class="row align-items-center justify-content-center">
          		<div class="col-md-12">
            		<div class="mb-5 text-center">
              		<h1 class="text-white font-weight-bold">A Dream Career!</h1>
              		<p>Find your dream job in our website.</p>
						<router-link to="/jobs" class="btn btn-primary"><span class="icon-search icon mr-2"></span>Search our Job Listings</router-link>
            		</div>

          		</div>
        		</div>
      		</div>
    	</section>
		<footer class="site-footer">	
		<div class="container">
			<div class="row text-center">
				<div class="col-12">
				<p>
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					Copyright &copy;
					{{ year }} All rights reserved | This template is made with <i
					class="icon-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
				</p>
				</div>
			</div>
		</div>
	</footer>
	</div>

</template>

<script>
import { useJobsStore } from '@/store/jobs'
import { useJobCategoriesStore } from '@/store/jobcategories'
export default {

	setup() {
		const jobsStore = useJobsStore()
		const jobCategoriesStore = useJobCategoriesStore()		
		return { jobsStore, jobCategoriesStore }
  	},

    components: {

    },
   
    mounted() {

    },

}

</script>

<style scoped>
</style>
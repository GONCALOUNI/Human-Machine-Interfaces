<template>
<div class="site-wrap">
  <header class="site-navbar mt-3">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="site-logo col-6"><router-link to="/">Careers</router-link></div>
          <nav class="mx-auto site-navigation">
            <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0">
              <li><router-link to="/">Home</router-link></li>
              <li><router-link to="/register" v-if="!userStore.isAuthenticated">Register</router-link></li>
              <li><router-link to="/login" v-if="!userStore.isAuthenticated">Login</router-link></li>
			        <li><router-link to="/logout" v-if="userStore.isAuthenticated">Logout</router-link></li>
              <li><router-link to="#" v-if="userStore.isAuthenticated">Welcome {{userStore.user.name}}</router-link></li>	 	 
              <li><router-link to="/publish" v-if="userStore.isAuthenticated">Publish</router-link></li> 
              <li><router-link to="/myoffers" v-if="userStore.isAuthenticated">My Offers</router-link></li>	 	 
            </ul>
          </nav>
        </div>
      </div>
    </header>
    <section class="home-section section-hero inner-page overlay bg-image" style="background-image: url('images/hero_1.jpg');"
      id="home-section">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-12">
            <div class="mb-5 text-center">
			  <p>Find your dream job in our website!</p>
			  <h1 class="text-white font-weight-bold">Job Listings</h1>
        <button class="btn btn-primary" style="margin-right: 8px;">Freelancer</button>
        <button class="btn btn-primary" style="margin-right: 8px;">Part-time</button>
        <button class="btn btn-primary" style="margin-right: 8px;">Full-time</button>
        <button class="btn btn-primary" style="margin-right: 8px;">Internship</button>
        <button class="btn btn-primary">Temporary</button>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="site-section">
      <div class="container">
        <div class="mb-5">
          <div v-for="job in jobs" :key="job.id" class="row align-items-start job-item border-bottom pb-3 mb-3 pt-3">
            <div class="col-md-2">
              <img :src="getImageUrl(job.image)" alt="Image" class="img-fluid">
            </div>
            <div class="col-md-4">
              <span class="badge badge-primary px-2 py-1 mb-3">{{job.category}}</span>
              <h2>{{job.title}}</h2>
              <p class="meta">Publisher: <strong>{{job.publisher}}</strong> <br>
              Published: <strong>{{job.created_at}}</strong></p>              
            </div>
            <div class="col-md-3 text-left">
              <h3>{{job.location}}</h3>
            </div>
            <div class="col-md-3 text-md-right">
              <p class="meta">Annual salary: <strong>&euro;{{job.salary}}</strong></p>
            </div>
          </div>
        </div>
      </div>
    </section>
  <Footer />
</div>
</template>

<script>
import Footer from '@/components/Footer.vue'
import Header from '@/components/Header.vue'


import { useJobsStore } from '@/store/jobs'
import { useJobCategoriesStore } from '@/store/jobcategories'
import { useUserStore } from '@/store/user'

export default {

  setup() {	
      const jobsStore = useJobsStore()		
      const jobCategoriesStore = useJobCategoriesStore()
      const userStore = useUserStore()	
      jobsStore.getJobsDB()
      jobCategoriesStore.getCategoriesDB()
      return {jobsStore, jobCategoriesStore, userStore}
  },  

  components: {
    Footer,
    Header
  },
  data()
  {
  },
  mounted()
  {
    this.getJobs();
    this.getCategories();
  },
  methods:
  {
    getImageUrl(name)
    {
      return new URL(`../assets/images/${name}`, import.meta.url).href
    },
    getJobs()
    {
      this.jobsStore.getJobsDB();
    },
    getCategories()
    {
      this.jobCategoriesStore.getCategoriesDB();
    },
  },
  computed:
  {
    jobs()
    {
      return this.jobsStore.getjobs
    },
    categories()
    {
      return this.jobCategoriesStore.getCategories;
    },
  },  
}
</script>

<style scoped>
</style>
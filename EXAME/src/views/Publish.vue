<template>
<div>

<header class="site-navbar mt-3">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="site-logo col-6"><router-link to="/">Careers</router-link></div>
          <nav class="mx-auto site-navigation">
            <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0">
              <li><router-link to="/" v-if="userStore.isAuthenticated">Home</router-link></li>
              <li><router-link to="/jobs" v-if="userStore.isAuthenticated">Job Listings</router-link></li>
              <li><router-link to="#" v-if="userStore.isAuthenticated">Welcome {{userStore.user.name}}</router-link></li>
            </ul>
          </nav>
        </div>
      </div>
</header>
<section class="home-section section-hero inner-page overlay bg-image"
      style="background-image: url('images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-12">
            <div class="mb-5 text-center">
              <h1 class="text-white font-weight-bold">Publish</h1>
              <p>Publish here the job offer! </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="site-section" id="next-section">
      <div class="container">
        <div class="row">
		  <div class="col-lg-3 ml-auto">
          </div>
          <div class="col-lg-6 mb-5 mb-lg-0">
            <form action="#" method="post">
                <div class="row form-group">
          
                      <div class="col-md-6">
                        <label class="text-black" >Company Name</label>
                        <input type="text"  name="company" class="form-control" placeholder="Enter here the company name">
                      </div>
                      <div class="col-md-6">
                        <label class="text-black" >Job Logo</label><br>
                        <select class="form-control" name="image"> 
                          <option disabled selected >Choose the company logo</option>                         
                          <option value="1.jpg">Logo 1</option>
                          <option value="2.jpg">Logo 2</option>
                          <option value="3.jpg">Logo 3</option>
                          <option value="4.jpg">Logo 4</option> 
                          <option value="5.jpg">Logo 5</option>                       
                        </select>
                      </div>
                </div>
 

                <div class="row form-group">          
                  <div class="col-md-6">
                    <label class="text-black" >Job Title</label>
                    <input type="text"  name="title" class="form-control" placeholder="Enter here a job title">
                  </div>

                  <div class="col-md-6">
                    <label class="text-black" >Job Category</label><br>
                    <select class="form-control" name="cat_id"> 
                      <option disabled selected>Choose the job category</option>                                          
                      <option value="1">Full-time</option>
                      <option value="2">Part-time</option>
                      <option value="3">Freelancer</option>
                      <option value="4">Internship</option> 
                      <option value="5">Temporary</option>                       
                    </select>
                  </div>
                </div> 
              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black">Job Description</label>
                  <textarea name="description" cols="30" rows="7" class="form-control"
                    placeholder="Write here a few lines to describe the job..."></textarea>
                </div>
              </div>
		  	  <div class="row form-group">
                <div class="col-md-6">
                  <label class="text-black">Salary</label>
                  <input type="text" name="salary" class="form-control" placeholder="Annual salary in euros...">
                </div>
                <div class="col-md-6">
                  <label class="text-black" >Job Location </label>
                  <input type="text" name="location" class="form-control" placeholder="Enter here the city...">
                </div>
          </div>
			  <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Publish" class="btn btn-primary btn-md text-white">
                </div>
        </div>
            </form>
          </div>
          <div class="col-lg-3 ml-auto">
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

import { useUserStore } from '@/store/user'
import { useJobsStore } from '@/store/jobs'

export default {
  setup() {
    const userStore = useUserStore()
    const jobsStore = useJobsStore()	
    return { userStore, jobsStore }
  },  
  components: {
    Footer,
    Header
  },

  data() {
      return {
          title:'',
          image:'',
          location:'',
          salary:'',
          description:'',
          company:'',
          cat_id:''     
      }
  },

  mounted() {
  },
  methods: {    
    onSubmit() {

          // data valid                                        

          const newJob = {
              title : this.title,
              image : this.image,
              location : this.location,
              salary : this.salary,
              description : this.description,
              company : this.company,
              cat_id : this.cat_id,
          }
          this.addJob(newJob)

    },
    async addJob(newJob) {
        
    },        
  },
  computed: {
    invalidCompany: function () {

    },
    invalidLocation: function () {

    },        
    invalidTitle: function () {

    },
    invalidDescription: function () {

    }, 
    invalidSalary: function () {

    },                
  },

}
</script>
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
              My pets !
            </h1>
          </div>
        </div>
      </div>
    </section>
    <!-- End banner Area -->

    <!-- Start pet-list Area -->
    <section class="cat-list-area section-gap">
      <div class="container">
        <div v-for="adoption in adoptions" :key="adoption.id" class="media" style="margin-bottom: 22px;">
          <div class="media-left">
            <img :src="getImageUrl(adoption.pet_image)" alt="Pet Image" class="img-fluid">
          </div>
          <div class="media-body">
            <h3 class="mb-30">&nbsp;{{adoption.pet_name}}</h3>
            <h4 class="media-heading">&nbsp;{{adoption.pet_description}}</h4>
            <br><p>I was adopted "{{adoption.created_at}}"</p>
          </div>
        </div>
        <br> 
      </div>
    </section>
    <!-- End pet-list Area -->
    <Footer />
  </div>
</template>

<script>
import Footer from '@/components/Footer.vue'
import Header from '@/components/Header.vue'

import {useAdoptionsStore} from '@/store/adoptions'
import {useUserStore} from '@/store/user'

export default {
	setup()
  {
		const adoptionsStore = useAdoptionsStore()	
		const userStore = useUserStore()			
    adoptionsStore.addadoptions()
		return {adoptionsStore,  userStore} 
  }, 
  components:
  {
		Footer,
    Header
	},
	data()
  {
		return {
			adoptions: [],
		}
	},
	mounted()
  {
    this.getAdoptionsShowing();
	},
	methods:
  {
    getImageUrl(name)
    {
      return new URL(`../assets/images/${name}`, import.meta.url).href
    },
    async getAdoptionsShowing()
    {
      this.adoptionsStore.getMyadoptionsDB(this.userStore.user.id);
    }
	},
  computed:
  {
    adoptions()
    {
      return this.adoptionsStore.getadoptions;
    }
  },
}
</script>

<style scoped>
</style>
<template>
<div> 
<Header />
<section class="banner-area relative" id="home">	
	<div class="overlay overlay-bg"></div>
		<div class="container">				
			<div class="row d-flex align-items-center justify-content-center">
				<div class="about-content col-lg-12">
					<h1 v-if="type == 1" class="text-white">
						Dogs				
					</h1>
					<h1 v-if="type == 2" class="text-white">
						Cats				
					</h1>
				</div>	
			</div>
		</div>
</section>

<!-- Start pet-list Area -->
<section class="cat-list-area section-gap">
	<div class="container">
		<div class="row">
			<div v-for="pet in pets" :key="pet.id" class="col-lg-3 col-md-6">
				<div v-if="(pet.status !== 0 && type == 1 && pet.cat_name == 'Dogs') || (pet.status !== 0 && type == 2 && pet.cat_name == 'Cats')" class="single-cat-list">
					<img :src="getImageUrl(pet.image)" alt="Pet Image" class="img-fluid">
						<div class="overlay">
							<div class="text">
							<p style="text-align: left;">{{pet.name}}</p>
							<p><a @click="adopt(pet)"><u>Adopt me!</u></a></p>
							</div>
					    </div>
				    </div>
			    </div>							
		    </div>
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
import {usePetsStore} from '@/store/pets'
import {usePetCategoriesStore} from '@/store/petcategories'

export default {
    setup() {
		const adoptionsStore = useAdoptionsStore()
		const userStore = useUserStore()
        const petsStore = usePetsStore()	
        const petCategoriesStore = usePetCategoriesStore()	
		petsStore.getPetsDB()        	
		return {adoptionsStore, userStore,  petsStore, petCategoriesStore}
  	}, 
    components:
	{
        Footer,
        Header
    },
    data()
	{
        return {
        }
    },
    created()
	{
    },
    methods:
	{
        getImageUrl(name)
        {
            return new URL(`../assets/images/${name}`, import.meta.url).href
        },
		async adopt(pet) 
		{
			try
			{	
				if(!this.userStore.isAuthenticated)
				{
        			localStorage.setItem('message', "Error: Login first!");
        			this.$router.push({path:`/message`});
        			return;
				}			
				if(this.userStore.isAuthenticated)
				{
					let currentAdoption = {
						pet_id: pet.id,
						petlover_id: this.userStore.getUser.id,
					}
					await this.adoptionsStore.newAdoptionDB(currentAdoption);
					localStorage.setItem('message', 'Success! ' + pet.name + ' adopted!');
					this.$router.push({path: '/message'});
				}
			} 
			catch(error)
			{
			}
			finally
			{
			}
		},
    },
    computed:
    {
        pets()
        {
            return this.petsStore.getpets
	    },
		type()
		{
			return this.$route.params.id;
		}
    }
 
}
</script>

<style scoped>
</style>
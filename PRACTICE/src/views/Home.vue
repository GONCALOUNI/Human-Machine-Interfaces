<template>
<div id="wrapper">      
			<Header />	
			<!-- start banner Area -->
			<section class="banner-area relative" id="home">
				<div class="container">
					<div class="overlay overlay-bg"></div>
					<div class="row fullscreen d-flex align-items-center justify-content-start">
						<div class="banner-content col-lg-8 col-md-12">
							<h1 class="text-uppercase">
								Adopt Us. <br>
								We need your help.		
							</h1>
							<router-link to="/pets/1" class="primary-btn header-btn text-uppercase">View our pets!</router-link>
						</div>											
					</div>
				</div>
			</section>
			<!-- End banner Area -->

			<!-- Start image-carusel Area -->
			<section class="image-carusel-area">
				<div class="container">
					<div class="row">
						<div class="active-image-carusel">
							<div class="single-image-carusel">
								<img class="img-fluid" src="/img/c1.jpg" alt="">
							</div>
							<div class="single-image-carusel">
								<img class="img-fluid" src="/img/c2.jpg" alt="">
							</div>
							<div class="single-image-carusel">
								<img class="img-fluid" src="/img/c3.jpg" alt="">
							</div>
							<div class="single-image-carusel">
								<img class="img-fluid" src="/img/c4.jpg" alt="">
							</div>	
							<div class="single-image-carusel">
								<img class="img-fluid" src="/img/c1.jpg" alt="">
							</div>
							<div class="single-image-carusel">
								<img class="img-fluid" src="/img/c2.jpg" alt="">
							</div>
							<div class="single-image-carusel">
								<img class="img-fluid" src="/img/c3.jpg" alt="">
							</div>
							<div class="single-image-carusel">
								<img class="img-fluid" src="/img/c4.jpg" alt="">
							</div>
							<div class="single-image-carusel">
								<img class="img-fluid" src="/img/c1.jpg" alt="">
							</div>
							<div class="single-image-carusel">
								<img class="img-fluid" src="/img/c2.jpg" alt="">
							</div>
							<div class="single-image-carusel">
								<img class="img-fluid" src="/img/c3.jpg" alt="">
							</div>
							<div class="single-image-carusel">
								<img class="img-fluid" src="/img/c4.jpg" alt="">
							</div>															
						</div>
					</div>
				</div>	
			</section>
			<!-- End image-carusel Area -->
		<Footer />
</div>

</template>

<script>

import Footer from "@/components/Footer.vue";
import Header from "@/components/Header.vue";
    export default {
		
        components: {
			Footer,
			Header,
        },
    
        mounted() {

        },

    }
</script>

<style scoped>
</style>
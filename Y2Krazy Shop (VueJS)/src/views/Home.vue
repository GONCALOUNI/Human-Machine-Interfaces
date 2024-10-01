<template>
	<div class="landing-page">
	  <Header />
	  <div class="intro" style="margin-top: 42px;">
		<h1>Welcome to the Y2Krazy Shop®!</h1>
		<p>
		  Explore a curated selection of nostalgic items from the early-late Y2K era.
		  Our shop is designed to transport you back to the iconic vibes of
		  these years. Rewind, Refresh, Relove the 2000s!
		</p>
		<img src="../assets/images/monophy.gif" alt="Cursor Image" class="cursor-anim" />
		<button @click="startShopping">Start shopping now!</button>
	  </div>
	  <Footer />
	</div>
  </template>
  
  <script>
  import Footer from "@/components/Footer.vue";
  import Header from "@/components/Header.vue";
  
  export default
  {	
	components:
	{
	  Footer,
	  Header,
	},
	methods:
	{
	  startShopping()
	  {
		this.$router.push("/menu");
	  },
	},
  };
  </script>

  <style scoped>
  
  .landing-page
  {
	min-height: 100vh;
	display: flex;
	flex-direction: column;
	align-items: center;
	justify-content: center;
  }
  
  .intro
  {
	position: relative;
	background: linear-gradient(to right, #11117c, #3498db);
	text-align: center;
	max-width: 600px;
	padding: 20px;
  }
  
  h1,
  p,
  button
  {
	color: #ffffff;
	font-family: 'Comic Sans MS', cursive;
  }
  
  button {
	background: linear-gradient(to right, #ffcc00, #ff9933);
	padding: 10px 20px;
	font-size: 16px;
	border: none;
	cursor: pointer;
  }
  
  .cursor-anim
  {
  	width: 40px;
  	height: 40px;
  	position: absolute;
  	top: 210px;
  	left: 390px;
  	z-index: 1;
	pointer-events: none;
  }
  
  .footer-container
  {
    width: 600px;
    padding: 20px;
	margin: 0 auto;
	font-family: 'Comic Sans MS', 'Chalkboard SE', 'Comic Neue', cursive;
	display: bottom;
  }
</style>  
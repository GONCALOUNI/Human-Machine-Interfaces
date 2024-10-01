<template>
	<div class="message-page">
	  <Header />
	  <div class="intro">
		<h1>{{message}}</h1>
		<img src="../assets/images/bar.gif" alt="GIF" style="width: 225px; border-radius: 12px;"/>
	  </div>
	  <Footer />
	</div>
</template>

<script>

export default {	

	data() {
		return {
			message: ''
		}
	},
	mounted() {
		this.setMessage()
	},
	methods: {
		setMessage() {	
				this.message = localStorage.getItem('message')
																				
				var timeleft = 2;
				var downloadTimer = setInterval(() => {
					if(timeleft <= 0){
						clearInterval(downloadTimer)
						this.$router.push('/menu')
					}
				timeleft -= 1
				}, 1000)
		},
	},
}
</script>

<style scoped>

.message-page
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
  p
  {
	color: #ffffff;
	font-family: 'Comic Sans MS', cursive;
  }
</style>

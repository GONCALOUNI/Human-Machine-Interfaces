<template>
  <div>
    <nav id="navbar" class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="navbar-container d-flex justify-content-between align-items-center" style="width: 800px; height: 80px;">
        <img src="../assets/images/logo.png" alt="PetinhosTalk" style="height: 40px; margin-left: 11px;">
        <span class="slogan">Where pets love... finds its place!</span>
      </div>
    </nav>
    <section class="h-100">
      <div class="container shadow" style="margin-top: -20px; margin-bottom: 8px;">
        <div class="post-container py-5 h-100" style="margin-top: -20px;">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-6 d-none d-xl-block"></div>
            <div class="card card-registration my-4">
              <div class="card-body p-md-5 text-black">
                <h2 class="mb-4 text-uppercase text-center">{{message}}</h2>
                <p class="text-center">{{countdownMessage}}</p>
              </div>
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
import { useUserStore } from '@/store/user'

export default {
  setup() {
    const userStore = useUserStore()
    return { userStore }
  },

  data() {
    return {
      message: '',
      countdownMessage: ''
    }
  },

  mounted() {
    this.setMessage()
  },

  methods: {
    setMessage() {
      if (this.$route.params.id == 1) {
        this.message = "Success: Post updated"
        this.startCountdown(3);
      }
      if (this.$route.params.id == 2) {
        this.message = "Success: User deleted"
        this.startCountdown(3);
      }
      if (this.$route.params.id == 3) {
        this.message = "Success: Post added to database"
        this.startCountdown(3);
      }
      if (this.$route.params.id == 4) {
        this.message = "Welcome! You can now login"
        this.startCountdown(2);
      }
      if (this.$route.params.id == 5) {
        this.message = "Welcome back " + this.userStore.getUser.name + "!"
        this.startCountdown(3);
      }
      if (this.$route.params.id == 6) {
        this.message = `Bye ${this.userStore.user.name}, come back soon!`
        this.startCountdown(3);
      }
      if (this.$route.params.id == 7) {
        this.message = "Success: Comment added to database"
        this.startCountdown(3);
      }
      if (this.$route.params.id == 8) {
        this.message = "Error: Login first please!"
        this.startCountdown(2);
      }
      if (this.$route.params.id == 9) {
        this.message = "Error: Can't update other's posts!"
        this.startCountdown(2);
      }
      if (this.$route.params.id == 10) {
        this.message = "Error: Can't comment own posts!"
        this.startCountdown(2);
      }
    },

    startCountdown(time)
    {
      let timeleft = time;
      this.updateCountdownMessage(timeleft);
      
      let downloadTimer = setInterval(() => {
        timeleft -= 1;
        if (timeleft <= 0) {
          clearInterval(downloadTimer);
          this.$router.push('/');
        }
        else {
          this.updateCountdownMessage(timeleft);
        }
      }, 1000);
    },
    updateCountdownMessage(timeleft)
    {
      this.countdownMessage = `You'll be redirected to our homepage in ${timeleft} second${timeleft > 1 ? 's' : ''}...`;
    }
  },
}
</script>


<style scoped>
	.logout {
	margin: 0 auto;
	max-width: 800px;
	}

	.success-message {
	color: #32a95d;
	}

	.error-message {
	color: #d33c40;
	}

	.navbar
  {
    border-radius: 0;
  }

  .bg-light
  {
    background-color: #f87538!important;
    padding: 7px 7px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
  }

  .navbar-nav .nav-link
  {
    color: #7F7F7F;
    text-decoration: none;
    border-radius: 8px;
    font-size: 16px;
    transition: background-color 0.3s, color 0.3s;
  }

  .navbar-nav
  {
    list-style: none;
    padding: 0;
  }

  .navbar-nav .nav-item
  {
    display: inline-block;
    margin-right: 16px;
  }

  .navbar-nav .nav-link:hover
  {
    background-color: #f87538;
    color: #ffffff!important;
  }

  .welcome
  {
    color: #f87538;
    font-size: 16px;
  }

  .container
  {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
  }

  .post-container
  {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 8px;
  }

  .footer-container
  {
    width: 800px;
    height: 60px;
    margin: 0 auto;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
  }

  .navbar-container
  {
    max-width: 800px;
    max-height: 80px;
    margin: 0 auto;
    background-color: #ffffff;
    border-radius: 8px;
    padding: 8.5px 8.5px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    text-align: center;
  }

  .content-container
  {
    width: 800px;
    margin-top: -20px;
    margin-bottom: 8px;
  }

  .post
  {
    max-width: 800px;
    margin-top: -20px;
    border: 1px solid #aaaaaa;
    padding: 20px;
    border-radius: 8px;
  }

  .post-author
  {
    font-weight: bold;
    text-decoration: underline;
    color: #f87538;
  }

  .post-date
  {
    font-style: italic;
    color: #888888;
  }

  .post-update
  {
    font-style: italic;
    color: #888888;
  }

  .post-content
  {
    margin-top: 10px;
  }
  
  .form-control
  {
    border-color: #aaaaaa!important;
	  resize: none;
  }

  .slogan
  {
	  font-size: 16px;
	  font-style: italic;
	  color: #555555;
	  margin-left: 10px;
	  vertical-align: bottom;
  }
</style>
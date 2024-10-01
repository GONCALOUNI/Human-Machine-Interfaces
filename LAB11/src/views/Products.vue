<template>
  <div class="navbar">
	  <router-link to="/menu" class="logo">Y2Krazy Shop®</router-link>
	  <div class="nav-links">
		<router-link to="/" class="nav-link">Home</router-link>
		<router-link to="/products" class="nav-link">Products</router-link>
		<router-link to="/register" v-if="!userStore.isAuthenticated" class="nav-link">Register</router-link>
		<router-link to="/login" v-if="!userStore.isAuthenticated" class="nav-link">Login</router-link>
		<router-link to="/basket" class="nav-link">Basket</router-link>
		<router-link to="/myorders" v-if="userStore.isAuthenticated" class="nav-link">Orders</router-link>
        <span v-if="userStore.isAuthenticated" style="margin-right: 22px; color: yellow">{{userStore.user.name}}</span>
	  </div>
	</div>
  <div class="product-container">
    <div v-for="product in products" :key="product.id" class="product">
      <img :src="`path/to/your/images/${product.image}`" alt="Product Image">
      <h3>{{product.name}}</h3>
      <p>{{product.description}}</p>
      <p>{{product.price}} €</p>
    </div>
  </div>
  <Footer />
</template>

<Footer />

<script>
import Footer from '@/components/Footer.vue'
import Header from '@/components/Header.vue'

import {useUserStore} from '@/store/user'
import {useProductsStore} from '@/store/products'

export default {
	
	setup() {
		const userStore = useUserStore()
    const productsStore = useProductsStore()
    productsStore.getProductsDB()
		return {userStore, productsStore}
  	},

	components: {
		Footer,
        Header
	},
	data() {
      return {	
        user: {
			name: '',
			email: '',
			password: '',
        },
		passwordConfirmation: '',
		submitting: true,
		error: true,	
      }
    },

  computed: {
    products() {
    },
  },

	methods:
	{
	}
}
</script>

<style scoped>

.navbar {
	background: linear-gradient(to right, #11117c, #3498db);
	padding: 10px;
	display: flex;
	justify-content: space-between;
	align-items: center;
	font-family: 'Comic Sans MS', 'Chalkboard SE', 'Comic Neue', cursive;
}

.logo {
	font-size: 24px;
	font-weight: bold;
	color: #ffffff;
	text-decoration: none;
}

.nav-links {
	display: flex;
}

.nav-link {
  text-decoration: none;
  color: #ffffff;
  margin-right: 30px;
  font-size: 16px;
  position: relative;
}

.nav-link::before {
  content: '';
  position: absolute;
  width: 8px;
  height: 8px;
  background: linear-gradient(to bottom, #ffffff, #bbbbbb);
  border-radius: 50%;
  left: -11px;
  top: 50%;
  transform: translateY(-50%);
  display: block;
}
  
.nav-link:hover {
  text-decoration: underline;
}

.product-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around;
  margin-top: 20px;
}

.product {
  width: 200px;
  margin-bottom: 20px;
}

.product img {
  max-width: 100%;
  height: auto;
}
</style>
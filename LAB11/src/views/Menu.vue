<template>
  <nav class="navbar">
    <router-link to="/" class="logo">Y2Krazy Shop®</router-link>
    <span style="left: 216px; color: yellow; position: absolute">Rewind, Refresh, Relove the 2000s!</span>
    <div class="nav-links">
      <router-link to="/" class="nav-link">Home</router-link>
      <router-link to="/menu" class="nav-link">Products</router-link>
      <router-link to="/register" v-if="!userStore.isAuthenticated" class="nav-link">Register</router-link>
      <router-link to="/login" v-if="!userStore.isAuthenticated" class="nav-link">Login</router-link>
      <router-link to="/basket" class="nav-link">Basket
        <span v-if="quantities > 0" class="basket-noti">{{displayQuantity}}</span>
      </router-link>
      <router-link to="/myorders" v-if="userStore.isAuthenticated" class="nav-link">My Orders</router-link>
      <router-link to="/logout" v-if="userStore.isAuthenticated" class="nav-link">Logout</router-link>
      <span v-if="userStore.isAuthenticated" style="margin-right: 22px; color: yellow">{{userStore.user.name}}</span>
    </div>
  </nav>
	<h1 style="margin-left: 50px;">Enjoy our current offers!</h1>
	<div class="product-container">
    <div v-for="product in products" :key="product.id" class="product">
	    <img :src="getImageUrl(product.image)" alt="Product Image">
      <h2>{{product.name}}</h2>
      <p>{{product.description}}</p>
      <p style="margin-bottom: 20px;"><b>{{product.price}}€</b></p>
      <div>
        <button @click="addToBasket(product)">Add to basket</button>
      </div>
    </div>
  </div>
  <Footer />
</template>
  
<script>
import Footer from '@/components/Footer.vue'
import Header from '@/components/Header.vue'

import {useBasketStore} from '@/store/basket'
import {useProductsStore} from '@/store/products'
import {useUserStore} from '@/store/user'

export default
{
	setup()
	{
		const basketStore = useBasketStore()
		const productsStore = useProductsStore()
		const userStore = useUserStore()
		productsStore.getProductsDB()
		return {basketStore, productsStore, userStore}
  },
  components:
	{
		Footer,
    Header
	},
  data()
  {
  },
	mounted()
	{
	},
	methods:
	{
    getImageUrl(name)
    {
      return new URL(`../assets/images/${name}`, import.meta.url).href
    },
    addToBasket(product)
    { 
      if(!this.userStore.isAuthenticated) 
      {
        localStorage.setItem('message', "Error: Login first!");
        this.$router.push({path:`/message`});
        return;
      }
			this.basketStore.incrementProduct(product.id);
		}
	},
  computed:
	{
	  products()
    {
      return this.productsStore.getProducts
	  },
    quantities()
    {
      return this.basketStore.getAllQuantities
    },
    displayQuantity()
    {
      return this.quantities > 99 ? '99+' : this.quantities;
    }
  },
}
</script>
  
<style scoped>
.navbar
{
	background: linear-gradient(to right, #11117c, #3498db);
	padding: 10px;
	display: flex;
	justify-content: space-between;
	align-items: center;
	font-family: 'Comic Sans MS', 'Chalkboard SE', 'Comic Neue', cursive;
}

.logo
{
	font-size: 24px;
	font-weight: bold;
	color: #ffffff;
	text-decoration: none;
}

.nav-links
{
	display: flex;
}

.nav-link
{
  text-decoration: none;
  color: #ffffff;
  margin-right: 30px;
  font-size: 16px;
  position: relative;
}

.nav-link::before
{
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
  
.nav-link:hover
{
  text-decoration: underline;
}

h1
{
	text-align: center;
	font-family: 'Comic Sans MS', 'Chalkboard SE', 'Comic Neue', cursive;
}

.product-container
{
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  margin-top: 20px;
  margin-left: 15px;
}

.product
{
  width: 200px;
  height: 650px;
  margin-bottom: 20px;
  margin-right: 20px;
  border: 1px solid #000000;
  text-align: center;
  font-family: 'Comic Sans MS', 'Chalkboard SE', 'Comic Neue', cursive;
  text-align: center;
  box-sizing: border-box;
  display: center;
  position: relative;
}

.product h2
{
  color: #11117c;
  margin-bottom: 5px;
  font-size: 1rem;
}

.product p
{
  text-align: center;
  font-size: 0.9rem;
}

.product img
{
  max-width: 100%;
  height: auto;
}

button
{
  background: linear-gradient(to right, #ffcc00, #ff9933);
  width: 100%;
  width: 130px;
  cursor: pointer;
  color: #ffffff;
  font-family: 'Comic Sans MS', cursive;
  position: absolute;
  bottom: 10px;
  left: 33px;
}

.footer-container
{
  width: 94.3vw;
  padding: 20px;
	font-family: 'Comic Sans MS', 'Chalkboard SE', 'Comic Neue', cursive;
	display: bottom;
}

.basket-noti
{
  background-color: red;
  color: white;
  border-radius: 50%;
  width: 20px;
  height: 20px;
  line-height: 20px;
  text-align: center;
  font-size: 12px;
  margin-left: -2px;
  text-decoration: none;
  display: inline-block;
	font-family: 'Comic Sans MS', 'Chalkboard SE', 'Comic Neue', cursive;
}
</style>
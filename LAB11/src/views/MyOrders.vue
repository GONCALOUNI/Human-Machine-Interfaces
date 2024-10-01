<template>
	<nav class="navbar">
    <router-link to="/" class="logo">Y2Krazy Shop®</router-link>
    <span style="left: 216px; color: yellow; position: absolute">Rewind, Refresh, Relove the 2000s!</span>
    <div class="nav-links">
      <router-link to="/" class="nav-link">Home</router-link>
      <router-link to="/menu" class="nav-link">Products</router-link>
      <router-link to="/register" v-if="!userStore.isAuthenticated" class="nav-link">Register</router-link>
      <router-link to="/login" v-if="!userStore.isAuthenticated" class="nav-link">Login</router-link>
      <router-link to="/basket" class="nav-link">Basket</router-link>
      <router-link to="/myorders" v-if="userStore.isAuthenticated" class="nav-link">My Orders</router-link>
      <router-link to="/logout" v-if="userStore.isAuthenticated" class="nav-link">Logout</router-link>
      <span v-if="userStore.isAuthenticated" style="margin-right: 22px; color: yellow">{{userStore.user.name}}</span>
    </div>
  </nav>
  <div>
    <h1>Your Orders:</h1>
    <div class="order-container">
    <div v-for="order in orders" class="order-item">
      <h2>{{order.id}}</h2>
      <p>{{order.created_at}}</p>
      <p>{{order.total}}</p>
    </div>
  </div>
  </div>
  <Footer />
</template>

<script>
import Footer from '@/components/Footer.vue'
import Header from '@/components/Header.vue'

import {useOrdersStore} from '@/store/orders'
import {useUserStore} from '@/store/user'

export default
{
	setup()
  {
		const ordersStore = useOrdersStore()
    const userStore = useUserStore()	
		return {ordersStore, userStore}
  },    
  components:
  {
		Footer,
    Header
	},
	data()
  {
		return {
            isHidden: false,
            id: 0,
            orders: 
            [
            //{
            //"id":"11",
            //"customer_id":"20",
            //"created_at":"2021-12-03 18:20:31",
            //"status_id":"1",
            //"total":"190",
            //"order_items":[{"product_id":"2","name":"Salmon Roll","price":"18","quantity":"4"},{"product_id":"3","quantity":"3"},{"product_id":"4","quantity":"2"}]
            //}
            ]
		}
	},
  mounted()
  {
    if(!this.userStore.isAuthenticated)
    {
      localStorage.setItem('message', 'Error: Login first!');
      this.$router.push({ path: '/message' });
    }
  },
	methods:
  {
    orders()
    {
      return this.ordersStore.getMyOrdersDB;
    },
	},
  computed:
  {
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

.main-container
{
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
}

.total-container
{
  border: solid #000000 2px;
  max-height: 200px;
  max-width: 300px;
}

.basket-container
{
  border: solid #000000 2px;
  max-width: 700px;
}

.basket-item
{
  display: grid;
  grid-template-columns: auto 1fr;
  gap: 10px;
  align-items: center;
  display: flex;
  align-items: center;
}

.basket-item h2
{
  color: #11117c;
	font-family: 'Comic Sans MS', 'Chalkboard SE', 'Comic Neue', cursive;
  font-size: 20px;
}

.basket-item h2
{
  color: #11117c;
	font-family: 'Comic Sans MS', 'Chalkboard SE', 'Comic Neue', cursive;
  font-size: 20px;
}

.basket-item p
{
	font-family: 'Comic Sans MS', 'Chalkboard SE', 'Comic Neue', cursive;
}

.basket-item img
{
  width: 100px;
  height: auto;
  font-family: 'Comic Sans MS', 'Chalkboard SE', 'Comic Neue', cursive;
}

button
{
  background: linear-gradient(to right, #ffcc00, #ff9933);
  width: 100%;
  width: 30px;
  cursor: pointer;
  color: #ffffff;
  font-family: 'Comic Sans MS', cursive;
  margin-top: auto;
  margin-bottom: 10px;
}

.footer-container
{
  width: 94.3vw;
  padding: 20px;
	font-family: 'Comic Sans MS', 'Chalkboard SE', 'Comic Neue', cursive;
	display: bottom;
}
</style>
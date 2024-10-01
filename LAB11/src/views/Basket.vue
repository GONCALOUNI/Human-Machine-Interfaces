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
    <h1>Your Basket:</h1>
    <div v-if="products.length > 0" class="main-container" style="margin-left: 210px;">
      <div class="basket-container">
        <div v-for="product in products" :key="product.id" class="basket-item">
          <img :src="getImageUrl(product.image)" alt="Product Image">
          <div>
            <h2>{{product.name}}</h2>
            <p style="margin-left: 5px;"><b>Price: {{getPrice(product)}}€</b></p>
            <div class="quantity-controls" style="margin-top: -10px;">
              <button style="font-size: 18px; font-weight: bold;" @click="removeOne(product.id)">-</button>
              <p>Quantity: {{product.quantity}}</p>
              <button style="font-size: 18px; font-weight: bold;" @click="addOne(product.id)">+</button>
            </div>
          </div>
        </div>
      <button style="width: 130px; margin-top: 20px; margin-left: 190px; background: linear-gradient(to right, #DC3545, red);" @click="clear()">Clear Basket</button>
      </div>
      <div class="total-container">
        <p style="margin-left: 5px; 
	      font-family: 'Comic Sans MS', 'Chalkboard SE', 'Comic Neue', cursive;">{{quantities}} products</p>
        <h2 style="margin-left: 5px; 
	      font-family: 'Comic Sans MS', 'Chalkboard SE', 'Comic Neue', cursive;">Shipping: FREE!</h2>
        <h2 style="margin-left: 5px; 
	      font-family: 'Comic Sans MS', 'Chalkboard SE', 'Comic Neue', cursive;">Total price: {{getTotalPrice()}}€</h2>
        <button style="width: 130px; margin-bottom: 100px; margin-left: 85px;" @click="placeOrder()">Proceed to order</button>
      </div>
    </div>
    <div v-else>
      <h2 style="text-align: center; color: #11117c; font-size: 20px; font-family: 'Comic Sans MS', 'Chalkboard SE', 'Comic Neue', cursive;" >It seems that you haven't added a product from our offers yet. Why don't you choose something that you like?</h2>
    </div>
  <Footer />
  </div>
</template>

<script>
import Footer from '@/components/Footer.vue'
import Header from '@/components/Header.vue'

import {useBasketStore} from '@/store/basket'
import {useOrdersStore} from '@/store/orders'
import {useUserStore} from '@/store/user'

export default
{
  setup()
  {
    const basketStore = useBasketStore()
    const ordersStore = useOrdersStore()
    const userStore = useUserStore()
    return {basketStore, ordersStore, userStore}
  },
  components:
  {
    Footer,
    Header
  },
  mounted()
  {
    if(!this.userStore.isAuthenticated) 
    {
      localStorage.setItem('message', "Error: Login first!");
      this.$router.push({path:`/message`});
    }
  },
  computed:
  {
    products()
    {
      return this.basketStore.getProducts
    },
    quantities()
    {
      return this.basketStore.getAllQuantities
    },
  },
  methods:
  {
    getImageUrl(name)
    {
      return new URL(`../assets/images/${name}`, import.meta.url).href
    },
    addOne(productId)
    {
      if(!this.userStore.isAuthenticated) 
      {
        localStorage.setItem('message', "Error: Login first!");
        this.$router.push({path:`/message`});
        return;
      }
      this.basketStore.incrementProduct(productId);
    },
    removeOne(productId)
    {
      if(!this.userStore.isAuthenticated) 
      {
        localStorage.setItem('message', "Error: Login first!");
        this.$router.push({path:`/message`});
        return;
      }
      this.basketStore.decrementProduct(productId);
    },
    clear()
    {
      if(!this.userStore.isAuthenticated) 
      {
        localStorage.setItem('message', "Error: Login first!");
        this.$router.push({path:`/message`});
        return;
      }
      this.basketStore.clearBasket();
    },
    getPrice(product)
    {
      return (product.price * product.quantity)
    },
    getTotalPrice()
    {
      return this.products.reduce((total, product) => total + product.price * product.quantity, 0)
    },
    async placeOrder()
    {
      const placedOrder = {
        totalAmount: this.getTotalPrice(),
        status_id: 1, 
        items: this.products.map(product => ({
          product_id: product.id,
          quantity: product.quantity,
        })),
      };
      const success = await this.ordersStore.addOrderDB(placedOrder);
      if(success)
      {
        this.basketStore.clearBasket();
        localStorage.setItem('message', "Success: Order was placed.");
        this.$router.push({path:`/message`});;
      }
      else
      {
        this.basketStore.clearBasket();
        localStorage.setItem('message', "Error: Order not successful!");
        this.$router.push({path:`/message`}); 
      }
    },
  },
};
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
  border: solid #000000 1px;
  max-height: 200px;
  max-width: 300px;
}

.basket-container
{
  border: solid #000000 1px;
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

.quantity-controls
{
  display: flex;
  align-items: center;
}

.quantity-controls button
{
  margin: 0 5px;
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

.quantity-controls
{
  display: flex;
  align-items: center;
}

.quantity-controls button
{
    margin: 0 5px;
}
</style>
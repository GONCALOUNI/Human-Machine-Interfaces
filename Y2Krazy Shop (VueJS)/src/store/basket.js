 
  import { defineStore } from 'pinia'
  import { useProductsStore } from '@/store/products'
  export const useBasketStore = defineStore({
  id: 'basket',
  state: () => ( {
    products: [
    //  {
    //    id: 1,
    //    quantity: 5
    //  },
    //  {
    //   id: 2,        
    //    quantity: 2
    //  },
    //  {
    //    id: 3,        
    //    quantity: 3
    //  }
    ]
  }),
  getters: {
    getProducts (state) {
      return state.products;
    }, 
    getAllQuantities(state) {
    return state.products.reduce((total, product) => total + product.quantity, 0);
    },
  },

  actions: {
    clearBasket() {
      this.products = [];
    },
    incrementProduct(idToIncrement) {
      const productsStore = useProductsStore()
      const index = this.products.findIndex((p) => p.id === idToIncrement);
      if (index !== -1) {
        this.products[index].quantity++
      } else {
        const details = productsStore.getProduct(idToIncrement)
        this.products.push({
          id: idToIncrement,
          quantity: 1,
          name: details.name,
          image: details.image,
          price: details.price,
        })
      }
    },
    decrementProduct(idToDecrement) {
      const index = this.products.findIndex((p) => p.id === idToDecrement);
      if (index !== -1) {
        this.products[index].quantity--;
        if (this.products[index].quantity <= 0) {
        this.products.splice(index, 1);
        }
      }
    },
  },
});
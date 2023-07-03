<template>
    <div class="container shadow p-4">
    <h1 class="mb-4">Carrito de compras</h1>
    <div class="table-responsive">
      <table class="table carrito table-bordered">
        <tbody>
          <tr v-for="(cart, index) in products" :key="index">
            <td data-label="Imagen" class="text-center text-md-start" :class="{'order-1': $mq === 'md', 'order-2': $mq === 'sm' || $mq === 'xs'}">
              <img class="img-thumbnail" src="https://http2.mlstatic.com/D_NQ_NP_2X_698010-MLA51072219180_082022-F.webp" alt="">
            </td>
            <td data-label="Producto" :class="{'order-2': $mq === 'md', 'order-1': $mq === 'sm' || $mq === 'xs'}">
              <h5 class="mb-0">{{ cart.product[0].name }}</h5>
            </td>
            <td data-label="Cantidad" :class="{'order-3': $mq === 'md', 'order-3': $mq === 'sm' || $mq === 'xs'}">
              <div class="mb-3">
                <v-select v-model.number="cart.quantity" :options="getQuantityOptions(cart.product[0].stock)" label="Cantidad" placeholder="Seleccionar cantidad" :rules="[v => !!v || 'El campo no puede estar vacío', v => v >= 1 && v <= cart.product[0].stock || `El valor debe estar entre 1 y ${cart.product[0].stock}`]"></v-select>
              </div>
              <span class="text-muted mt-2">{{ cart.product[0].stock }} Disponibles</span>
            </td>
            <td data-label="Total" :class="{'order-4': $mq === 'md', 'order-4': $mq === 'sm' || $mq === 'xs'}">
              <h4 class="text-primary">${{ (cart.product[0].price * cart.quantity).toLocaleString() }}</h4>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="">
      Total: $982808
    </div>
  </div>
</template>

<script>
export default {
    props:['user_id'],
    data() {
        return {
            user: null,
            products:null
        }
    },
    created() {
        this.index()
        
    },
    methods: {
        index() {
            this.user = this.user_id
            this.getCartForUser()
        },
        async getCartForUser() {
            const { data } = await axios.get(`/carts/cart/${this.user}`)
            this.products = data.carts
            console.log(this.products);
        },
        getQuantityOptions(stock) {
            return Array.from({ length: stock }, (_, i) => i + 1);
        }
        
          
    }
}
</script>

<style>
@media (max-width: 576px) {
  .carrito td {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
  }
  .carrito td img {
    margin-bottom: 1rem;
    width: 8rem;
  }
}
</style>

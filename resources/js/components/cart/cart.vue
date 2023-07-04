<template>
  <div class="container shadow p-4">
    <h1 class="mb-4">Carrito de compras</h1>
    <div class="table-responsive">
      <table class="table carrito ">
        <tbody>
          <tr v-for="(cart, index) in products" :key="index">
            <td data-label="Imagen" class="text-center text-md-start">
              <img v-if="cart.product[0].image" style="width: 7rem;" :src="getImageUrl(cart.product[0].image)"
                class="img-fluid rounded border" alt="Product Image">
              <section v-else>
                <img style="width: 7rem;" class="img-fluid img-thumbnail rounded border"
                  src="https://images.pexels.com/photos/2582928/pexels-photo-2582928.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                  alt="Default Image">
              </section>
            </td>
            <td data-label="Producto">
              <h5 class="mb-0">{{ cart.product[0].name }}</h5>
              <a name="" @click="deleteProduct(cart.id)" id="" class="btn btn-danger" href="#" role="button">Eliminar</a>
            </td>
            <td data-label="Cantidad">
              <div class="mb-3">
                <v-select @change="updateQuantity(cart.id, cart.quantity)"  v-model.number="cart.quantity" :options="getQuantityOptions(cart.product[0].stock)"
                  label="Cantidad" placeholder="Seleccionar cantidad"
                  :rules="[v => !!v || 'El campo no puede estar vacío', v => v >= 1 && v <= cart.product[0].stock || `El valor debe estar entre 1 y ${cart.product[0].stock}`]"
                  ></v-select>
              </div>
              <span class="text-muted mt-2">{{ cart.product[0].stock }} Disponibles</span>
            </td>
            <td data-label="Total">
              <h4 class="text-primary">${{ (cart.product[0].price * cart.quantity).toLocaleString() }}</h4>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="text-end">
      <h5>Total: ${{ calculateTotal().toLocaleString() }}</h5>
      <a name="" id="" class="btn btn-success" href="#" role="button">Comprar Todo</a>
    </div>
  </div>
</template>

<script>
export default {
  props: ['user_id'],
  data() {
    return {
      user: null,
      products: null
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
    },
    getImageUrl(imageName) {
      return "/storage/images/" + imageName;
    },
    calculateTotal() {
      let total = 0;
      if (this.products) {
        this.products.forEach(cart => {
          total += cart.product[0].price * cart.quantity;
        });
      }
      return total;
    },
    async updateQuantity(cart_id, newQuantity) {
      try {
        console.log('holi');
        await axios.put(`/api/carts/UpdateCart/${cart_id}`, { quantity: newQuantity });
      } catch (error) {
        console.error(error);
      }
    },
    async deleteProduct(cart_id) {
      try {
        const result = await swal.fire({
          title: 'Seguro quieres borrar el producto?',
          text: "Esta acción no se puede revertir",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Eliminar',
          cancelButtonText: 'Cancelar'
        })
        if (result.isConfirmed) {
          await axios.delete(`/api/carts/DeleteCart/${cart_id}`)
          this.getCartForUser()
          swal.fire(
            'Eliminado',
            'El producto se ha eliminado.',
            'success'
          )
        }
      } catch (error) {
        console.error(error);
      }
    },
    
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

<template>
    <div class="modal fade" id="productModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-yellow">
            <div class="modal-header" style="background-color: #fff159">
                <h5 class="modal-title" id="modalTitleId">Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container mt-4">
                <div class="row">
                    <div class="col-lg-6 container text-center mb-3">
                        <img v-if="product.image" style="height: 14rem;" :src="getImageUrl(product.image)" class="img-fluid rounded border" alt="Product Image">
                        <section v-else>
                            <img style="height: 14rem;" class="img-fluid img-thumbnail rounded border" src="https://images.pexels.com/photos/2582928/pexels-photo-2582928.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" alt="Default Image">
                        </section>
                    </div>
                    <div class="col-lg-6">
                        <h4 class="mb-3">{{ product.name }}</h4>
                        <h4>Precio: <strong class="text-primary">${{ product.price.toLocaleString() }}</strong></h4>
                        <p class="mb-3"><strong>Descripción:</strong> {{ product.description }}</p>
                        <p>Disponible: {{ product.stock }} Unidades</p>
                        <v-select v-model="quantityValue" class="mb-3" :options="getQuantityOptions(product.stock)" label="Cantidad" placeholder="Seleccionar cantidad" :rules="[v => !!v || 'El campo no puede estar vacío', v => v >= 1 && v <= product.stock || `El valor debe estar entre 1 y ${product.stock}`]"></v-select>
                        <a name="" id="" @click="addCart" class="btn btn-primary w-100" href="#" role="button">Agregar al carrito</a>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:['data_product','user_id'],
    data() {
        return {
            product: null,
            quantityValue: 1,
            data:null
        }
    },
    created() {
        this.index()
        console.log(this.user_id);
    },
    methods: {
        index() {
            this.product = this.data_product
        },
        getQuantityOptions(stock) {
            return Array.from({ length: stock }, (_, i) => i + 1);
        },
        async addCart() {
            if (this.user_id) {
                this.data = {
                    "product_id": this.product.id,
                    "user_id": this.user_id,
                    "quantity": this.quantityValue
                }
                console.log(this.data);
                try {
                    await axios.post('/api/carts/AddProduct', this.data)
                    swal.fire({
                        icon: 'success',
                        title: 'El producto se ha agregado al carrito',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    this.$parent.closeModal()
                } catch (error) {
                    console.error(error);
                }
            } else {
                swal.fire({
                    icon: 'warning',
                    title: 'Por favor inicia sesión',
                    showConfirmButton: false,
                    timer: 1500
                })
                setTimeout(() => {
                    window.location.href = `/login`;
                console.log("Han pasado 1 segundo");
                }, 1500);
            }
        },
        getImageUrl(imageName) {
            return  "/storage/images/" + imageName;
        },
          
    }
}
</script>


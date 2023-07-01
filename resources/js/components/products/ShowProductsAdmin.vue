<template>
    <div>
        <div class="table-responsive border shadow p-3">
            <div class="d-flex justify-content-between">
                <div>
                    <h1>Productos</h1>
                </div>
                <div>
                    <button @click="createProduct()" class="btn btn-success" href="#" role="button">Crear Producto</button>
                </div>
            </div>
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Categoria</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">imagen</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(product,index) in products" :key="index">
                        <td scope="row" >{{ product.category.name }}</td>
                        <td>{{product.name}}</td>
                        <td>{{product.stock}}</td>
                        <td>{{product.price}}</td>
                        <td>{{product.description}}</td>
                        <td>{{product.imagen}}</td>
                        <td>
                            <div class="d-flex justify-content-start">
                                <button @click="editButton(product.id)" class="col btn btn-warning me-2" role="button">Editar</button>
                                <button @click="deleteProduct(product.id)"  name="" id="" class="col btn btn-danger" role="button">Eliminar</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <section v-if="load_modal">
        <create-edit-modal :product_data="product"/>
    </section>
</template>

<script>
import CreateEditModal from './ModalProducts.vue'
export default {
    components: {
        CreateEditModal,
    },
    data() {
        return {
            products: [],
            load_modal: false,
            modal: null,
            product: null
        }
    },
    created() {
        this.index()
    },
    methods: {
        index() {
            this.getAllProducts()
        },
        async getAllProducts() {
            try {
                const { data } = await axios.get('/api/products/GetAllProducts')
                this.products = data.products
                console.log(this.products);
            } catch (error) {
                console.error(error);
            }
        },
        async createProduct() {
            this.openModal()
        },
        openModal() {
            this.load_modal = true;
            setTimeout(() => {
                this.modal = new bootstrap.Modal(document.getElementById('createEditmodalId'), {
                    keyboard: false
                });
                this.modal.show();
                const modal = document.getElementById('createEditmodalId');
                modal.addEventListener('hidden.bs.modal', () => {
                    this.load_modal = false
                    this.product = null
                })
            }, 200);
        },

        async editButton(product_id) {
            try {
                const { data } = await axios.get(`/api/products/GetAProduct/${product_id}`)
                this.product = data.product
                this.openModal()
            } catch (error) {
                console.log(error);
            }
        },
        closeModal() {
            this.modal.hide()
            this.getAllProducts()
        },
        async deleteProduct(product_id){
            try {
                const result=await swal.fire({
                    title: 'Seguro quieres borrar el producto?',
                    text: "Esta acción no se puede revertir",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Eliminar',
                    cancelButtonText:'Cancelar'
                })
                    if (result.isConfirmed) {
                        await axios.delete(`/api/products/DeleteProduct/${product_id}`)
                        this.getAllProducts()
                        swal.fire(
                            'Eliminado',
                            'El producto se ha eliminado.',
                            'success'
                        )
                    }
            } catch (error) {
                console.error(error);
            }
        }
    }
}
</script>
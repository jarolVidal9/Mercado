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
                        <th scope="col">Nombre</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(category,index) in categories" :key="index">
                        <td>{{category.name}}</td>
                        <td>
                            <div class="d-flex justify-content-start">
                                <button @click="editButton(category.id)" class="col btn btn-warning me-2" role="button">Editar</button>
                                <button @click="deleteProduct(category.id)"  name="" id="" class="col btn btn-danger" role="button">Eliminar</button>
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
import CreateEditModal from './ModalCategories.vue'
export default {
    components: {
        CreateEditModal,
    },
    data() {
        return {
            categories: [],
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
            this.getAllcategories()
        },
        async getAllcategories() {
            try {
                const { data } = await axios.get('/api/categories/GetAllCategories')
                this.categories = data.categories
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
                const { data } = await axios.get(`/api/categories/GetAProduct/${product_id}`)
                this.product = data.product
                this.openModal()
            } catch (error) {
                console.log(error);
            }
        },
        closeModal() {
            this.modal.hide()
            this.getAllcategories()
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
                        await axios.delete(`/api/categories/DeleteProduct/${product_id}`)
                        this.getAllcategories()
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
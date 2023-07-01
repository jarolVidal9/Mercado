<template>
    <div class="modal fade" id="createEditmodalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">{{ `${is_create ? 'Crear' : 'Actualizar'} Producto` }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row" @submit.prevent="storeProduct" enctype="multipart/form-data">
                        <div class="col">
                            <div class="mb-3">
                                <label for="" class="form-label">Categoria</label>
                                <v-select id="category" :options="categories" v-model="product.category_id"
                                            :reduce="category => category.id" label="name" :clearable="false"></v-select>
                                <div style="color: red;"  v-if="errors && errors.category_id">{{ errors.category_id[0] }}</div>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Elegir Imagen</label>
                                <input type="file" class="form-control" name="" id="file" accept="image/*" @change="loadImage" placeholder=""
                                    aria-describedby="fileHelpId" >
                                <div style="color: red;"  v-if="errors && errors.image">{{ errors.image[0] }}</div>

                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Nombre</label>
                                <input type="text" v-model="product.name" class="form-control" name="name" id="name"
                                    aria-describedby="helpId" placeholder="">
                                <div style="color: red;"  v-if="errors && errors.name">{{ errors.name[0] }}</div>

                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="" class="form-label">Stock</label>
                                <input type="number" v-model="product.stock" class="form-control" name="" id=""
                                    aria-describedby="helpId" placeholder="">
                                <div style="color: red;"  v-if="errors && errors.stock">{{ errors.stock[0] }}</div>
                                
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Precio</label>
                                <input type="number" v-model="product.price" class="form-control" name="" id=""
                                    aria-describedby="helpId" placeholder="">
                                <div style="color: red;"  v-if="errors && errors.price">{{ errors.price[0] }}</div>

                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Descripción</label>
                                <textarea class="form-control" v-model="product.description" name="" id=""
                                    rows="3"></textarea>
                                <div style="color: red;"  v-if="errors && errors.description">{{ errors.description[0] }}</div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">{{ `${is_create ? 'Crear' : 'Actualizar'} `
                            }}</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['product_data'],
    data() {
        return {
            is_create: true,
            product: {},
            categories: [],
            errors: {},
            file: null
        }
    },
    created() {
        this.index()
    },
    methods: {
        index() {
            this.getCategories()
            this.setProduct()
        },
        async getCategories() {
            try {
                const { data } = await axios.get('/api/categories/GetAllCategories')
                this.categories = data.categories
                console.log(this.categories);
            } catch (error) {
                console.log(error);
            }
        },
        setProduct() {
            if (!this.product_data) return
            this.is_create = false
            this.product = this.product_data
        },
        loadFormData() {
            const form_data = new FormData()
            if (this.product.category_id) form_data.append('category_id', this.product.category_id)
            if (this.file) form_data.append('image', this.file, this.file.name)
            if (this.product.name) form_data.append('name', this.product.name)
            if (this.product.stock) form_data.append('stock', this.product.stock)
            if (this.product.price) form_data.append('price', this.product.price)
            if (this.product.description) form_data.append('description', this.product.description)
            return form_data
        },
        async storeProduct() {
            try {
                const productForm = this.loadFormData()
                if (this.is_create) {
                    await axios.post('/api/products/CreateProduct', productForm)
                    swal.fire({
                        icon: 'success',
                        title: 'El producto se ha guardado',
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    await axios.post(`/api/products/EditProduct/${this.product.id}`, productForm)
                    swal.fire({
                        icon: 'success',
                        title: 'El producto se ha actualizado',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
                this.$parent.closeModal()
            } catch (error) {
                if (error.response.status == 422) {
                    this.errors = error.response.data.errors
                } else {
                    console.log(error)
                }
            }
        },
        loadImage() {
            this.file = event.target.files[0]
        }
    }
}
</script>

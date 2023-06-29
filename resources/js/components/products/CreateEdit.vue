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
                    <form class="row" @submit.prevent="storeProduct">
                        <div class="col">
                            <div class="mb-3">
                                <label for="" class="form-label">Categoria</label>
                                <select class="form-select" name="" id="">
                                    <option selected>Select one</option>
                                    <option value="">New Delhi</option>
                                    <option value="">Istanbul</option>
                                    <option value="">Jakarta</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Elegir Imagen</label>
                                <input type="file" class="form-control" name="" id="" placeholder=""
                                    aria-describedby="fileHelpId">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Nombre</label>
                                <input type="text" v-model="product.name" class="form-control" name="name" id="name"
                                    aria-describedby="helpId" placeholder="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="" class="form-label">Stock</label>
                                <input type="number" v-model="product.stock" class="form-control" name="" id=""
                                    aria-describedby="helpId" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Precio</label>
                                <input type="number" v-model="product.price" class="form-control" name="" id=""
                                    aria-describedby="helpId" placeholder="">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Descripción</label>
                                <textarea class="form-control" v-model="product.description" name="" id=""
                                    rows="3"></textarea>
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
            categories:{}
        }
    },
    created() {
        this.index()
    },
    methods: {
        index() {
            this.setProduct()
            this.getCategories()
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
            if (this.product.name) form_data.append('name', this.product.name)
            if (this.product.stock) form_data.append('stock', this.product.stock)
            if (this.product.price) form_data.append('price', this.product.price)
            if (this.product.description) form_data.append('description', this.product.description)
            return form_data
        },
        async storeProduct() {
            console.log('holi');
            try {
                const productForm = this.loadFormData()
                if (this.is_create) {
                    await axios.post('/api/products/CreateProduct', productForm)
                } else {

                }
            } catch (error) {
                console.error(error);
            }
        }
    }
}
</script>

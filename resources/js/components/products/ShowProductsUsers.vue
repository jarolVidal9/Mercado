<template>
    <div v-if="categories.length>0">
        <div v-for="(categoryProduct, index) in categories" :key="index">
            <div v-if="categoryProduct.products.length > 0" class="shadow-lg p-3 mb-5 bg-body rounded">
                <div class="d-flex flex-wrap">
                    <h6 class="me-5">Categoria: {{ categoryProduct.name }}</h6>
                    <a href="">
                        <h6>ver mas...</h6>
                    </a>
                </div>
                <div class="d-flex justify-content-center flex-wrap m-2">
                    <div v-for="(product, index) in categoryProduct.products" :key="index">
                        <div class="card m-2" style="width: 12rem; height: 37rem;">
                            <img src="https://http2.mlstatic.com/D_NQ_NP_2X_612155-MLA54687684485_032023-F.webp"
                                class="card-img-top img-fluid" alt="...">
                            <div class="card-body">
                                <h6><strong> ${{ product.price }}</strong></h6>
                                <h6 class="card-title">{{ product.name }}</h6>
                                <p class="card-text">Disponible: {{ product.stock }} unidades</p>
                                <a href="#" class="btn btn-primary">Agregar a carrito</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <section v-else class="text-center">
            <div class="spinner-border text-success" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </section>
</template>

<script>
export default {
    data() {
        return {
            categories: []
        }
    },
    created() {
        this.index()
    },
    methods: {
        index() {
            this.getAllCategoriesProductsWithCategories()
        },

        async getAllCategoriesProductsWithCategories() {
            try {
                const { data } = await axios.get('/api/products/GetAllProductsForCategory')
                this.categories = data.products
                console.log(this.categories);
            } catch (error) {
                console.error(error);
            }

        }
    }
}
</script>
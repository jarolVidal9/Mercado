<template>
    <div class="container shadow-lg p-3 mb-5 bg-body rounded">
        <h5><strong class="ms-4">{{ categoryCopy.name }}</strong></h5>
            <div v-if="products.length>0">
                    <div class="d-flex justify-content-center flex-wrap m-2">
                        <div v-for="(product, index) in products" :key="index">
                            <div class="card m-2" style="width: 12rem; height: 28rem;">
                                <img v-if="product.image" :src="getImageUrl(product.image)"
                                    class="card-img-top w-100 h-100 img-fluid" alt="...">
                                <section v-else>
                                    <img  src="https://images.pexels.com/photos/2582928/pexels-photo-2582928.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                                    class="card-img-top w-100 h-100 img-fluid" alt="...">
                                </section>
                                <div class="card-body h-50">
                                    <h6><strong> ${{ product.price.toLocaleString() }}</strong></h6>
                                    <h6 class="card-title">{{ product.name }}</h6>
                                    <p class="card-text">Disponible: {{ product.stock }} unidades</p>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <section v-else class="text-center">
                <div class="spinner-border text-success" role="status">
                    <span class="visually-hidden">Cargando...</span>
                </div>
            </section>
    </div>
</template>

<script>

export default {
    props:['category'],
    data() {
        return {
            products: [],
            categoryCopy: null
        }
    },
    created() {
        this.index()
    },
    methods: {
        index() {
            this.getCategory()
            this.getProductByCategory()
        },
        getCategory() {
            this.categoryCopy = this.category
        },
        async getProductByCategory() {
            try {
                const { data } = await axios.get(`/products/ProductsByCategory/${this.categoryCopy.id}`)
                this.products = data.products
                console.log(this.categories);
            } catch (error) {
                console.error(error);
            }

        },
        getImageUrl(imageName) {
            return  "/storage/images/" + imageName;
        }
    }
}
</script>
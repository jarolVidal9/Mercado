<template>
    <div class="container">
        <div v-if="categories.length>0">
            <div v-for="(categoryProduct, index) in categories" :key="index">
                <div v-if="categoryProduct.products.length > 0" class="shadow-lg p-3 mb-5 bg-body rounded">
                    <div class="d-flex flex-wrap">
                        <a class="text-decoration-none d-flex text-black ms-3" role="button" @click="RedirectProductsByCategory(categoryProduct.id)">
                            <h5>
                            <strong class="me-3"> Categoria: {{ categoryProduct.name }}</strong>
                            ver mas...
                            </h5>
                        </a>
                    </div>
                    <div class="d-flex justify-content-center flex-wrap m-2">
                        <div v-for="(product, index) in categoryProduct.products" :key="index">
                            <div class="card m-2" style="width: 12rem; height: 28rem;">
                                <img v-if="product.image" :src="getImageUrl(product.image)"
                                    class="card-img-top h-100" alt="...">
                                <section v-else>
                                    <img  src="https://images.pexels.com/photos/2582928/pexels-photo-2582928.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                                    class="card-img-top h-100" alt="...">
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
            </div>
        </div>
            <section v-else class="text-center">
                <div class="spinner-border text-success" role="status">
                    <span class="visually-hidden">Cargando...</span>
                </div>
            </section>
    </div>
    <section v-if="load_modal">
        <product-modal :product_data="product"/>
    </section>
</template>

<script>
import ProductModal from './ModalViewProduct.vue'
export default {
    data() {
        return {
            categories: [],
            load_modal:false
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

        },
        getImageUrl(imageName) {
            return  "/storage/images/" + imageName;
        },
        RedirectProductsByCategory(category_id) {
            window.location.href = `products/ShowProductsForCategory/${category_id}`;
        }
    }
}
</script>
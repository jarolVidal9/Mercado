<template>
    <div class="container shadow-lg p-3 mb-5 bg-body rounded">
        <h5><strong class="ms-4">{{ categoryCopy.name }}</strong></h5>
            <div v-if="products.length>0">
                    <div class="d-flex justify-content-center flex-wrap m-2">
                        <div v-for="(product, index) in products" :key="index">
                            <div class="card m-2" style="width: 12rem; height: 28rem;">
                                <a  role="button" @click="viewProduct(product)">
                                <div class="card-img-container">
                                        <img v-if="product.image" :src="getImageUrl(product.image)"
                                        class="card-img-top card-img h-100" alt="...">
                                        
                                        <img v-else src="https://images.pexels.com/photos/2582928/pexels-photo-2582928.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                                            class="card-img-top card-img h-100" alt="...">
                                    </div>
                                
                                <div class="card-body h-50">
                                    <h6><strong> ${{ product.price.toLocaleString() }}</strong></h6>
                                    <h6 class="card-title">{{ product.name }}</h6>
                                    <p class="card-text">Disponible: {{ product.stock }} unidades</p>
                                </div>
                                </a>
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
        <product-modal :data_product="product" :user_id="user_id"/>
    </section>
</template>

<script>
import ProductModal from './ModalViewProduct.vue'
export default {
    props: ['category', 'user_id'],
    components: {
      ProductModal  
    },
    data() {
        return {
            products: [],
            categoryCopy: null,
            load_modal:false
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
        },
        viewProduct(product) {
            this.openModal()
            this.product = product
        },
        openModal() {
            this.load_modal = true;
            setTimeout(() => {
                this.modal = new bootstrap.Modal(document.getElementById('productModal'), {});
                this.modal.show();
                const modal = document.getElementById('productModal');
                modal.addEventListener('hidden.bs.modal', () => {
                    this.load_modal = false
                    this.product_id = null
                })
            }, 200);
        },
        closeModal() {
            this.modal.hide()
        },
    }
}
</script>
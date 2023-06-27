<template>
    <div v-for="(product,index) in products" :key="index">
        <div class="card text-start">
          <img class="card-img-top" src="holder.js/100px180/" alt="Title">
          <div class="card-body">
            <h4 class="card-title">{{product.name}}</h4>
            <p class="card-text">Body</p>
          </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            products: []
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
            const { data } = await axios.get('/api/products/GetAllProducts')
            this.products = data.products
            console.log(this.products);
        }
    }
}
</script>
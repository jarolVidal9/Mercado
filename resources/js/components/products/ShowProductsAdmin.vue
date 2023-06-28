<template>
    <div>
        <h1>Usuarios</h1>
        <div class="table-responsive border shadow p-3">
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
                        <td scope="row">{{ product.category.name }}</td>
                        <td>{{product.name}} {{ product.name }}</td>
                        <td>{{product.stock}}</td>
                        <td>{{product.price}}</td>
                        <td>{{product.description}}</td>
                        <td>{{product.imagen}}</td>
                        <td class="roe">
                            <a name="" id="" class="col btn btn-warning me-2" href="#" role="button">Button</a>
                            <a name="" id="" class="col btn btn-danger" href="#" role="button">Button</a>
                        </td>
                    </tr>
                </tbody>
            </table>
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
            try {
                const { data } = await axios.get('/api/products/GetAllProducts')
                this.products = data.products
                console.log(this.products);
            } catch (error) {
                console.error(error);
            }

        }
    }
}
</script>
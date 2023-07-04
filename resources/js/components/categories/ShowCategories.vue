<template>
    <div class="row">
        <div class="col-lg-6 border shadow p-3">
            <div class="">
                <div class="">
                    <h1>{{ `${is_create ? 'Crear' : 'Actualizar'} Categoria` }}</h1>
                    <form action="" @submit.prevent="storeCategory">
                        <div class="mb-3">
                          <label for="" class="form-label">Nombre</label>
                          <input type="text" class="form-control" v-model="category.name"  name="" id="" aria-describedby="helpId" placeholder="">
                            <div style="color: red;"  v-if="errors && errors.name">{{ errors.name[0] }}</div>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" name="" id="" class="btn btn-primary">{{ `${is_create ? 'Crear' : 'Actualizar'}` }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6 table-responsive border shadow p-3">
            <div class="d-flex justify-content-between">
                <div>
                    <h1>Categorias</h1>
                </div>
                <div>
                    <button @click="createCategory()" class="btn btn-success" href="#" role="button">Crear Categoria</button>
                </div>
            </div>
            <table class="table table-striped" id="tableCategories">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(category,index) in categories" :key="index">
                        <td>{{ index+1 }}</td>
                        <td>{{category.name}}</td>
                        <td>
                            <div class="d-flex justify-content-start">
                                <button @click="editButton(category.id)" class="col btn btn-warning me-2" role="button">Editar</button>
                                <button @click="deleteCategory(category.id)"  name="" id="" class="col btn btn-danger" role="button">Eliminar</button>
                            </div>
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
            categories: [],
            category: {},
            is_create: true,
            errors: null
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
                this.$nextTick(() => {
                    $('#tableCategories').DataTable()
                })
            } catch (error) {
                console.error(error);
            }
        },
        async editButton(category_id) {
            try {
                const { data } = await axios.get(`/api/categories/GetACategory/${category_id}`)
                this.category = data.category
                this.is_create=false
            } catch (error) {
                console.log(error);
            }
        },
        loadFormData() {
            const form_data = new FormData()
            if (this.category.name) form_data.append('name', this.category.name)
            return form_data
        },
        async storeCategory() {
            try {
                const categoryForm = this.loadFormData()
                if (this.is_create) {
                    await axios.post('/api/categories/CreateCategory', categoryForm)
                    swal.fire({
                        icon: 'success',
                        title: 'La categoria se ha guardado',
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    await axios.post(`/api/categories/EditCategory/${this.category.id}`, categoryForm)
                    swal.fire({
                        icon: 'success',
                        title: 'El producto se ha actualizado',
                        showConfirmButton: false,
                        timer: 1500
                    })  
                }
                this.getAllcategories()
                this.category={}
            } catch (error) {
                if (error.response.status == 422) {
                    this.errors = error.response.data.errors
                } else {
                    console.log(error)
                }
            }
        },
        createCategory() {
            this.is_create = true
            this.category = {}
        },
        async deleteCategory(category_id){
            try {
                const result=await swal.fire({
                    title: 'Seguro quieres borrar la categoria?',
                    text: "Esta acción no se puede revertir",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Eliminar',
                    cancelButtonText:'Cancelar'
                })
                    if (result.isConfirmed) {
                        await axios.delete(`/api/categories/DeleteCategory/${category_id}`)
                        this.getAllcategories()
                        swal.fire(
                            'Eliminado',
                            'La categoria se ha eliminado.',
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
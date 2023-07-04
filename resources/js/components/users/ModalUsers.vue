<template>
    <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
        aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">{{ `${is_create ? 'Crear' : 'Actualizar'} Usuario` }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row" @submit.prevent="storeUser">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Tipo de Usuario</label>
                                <select class="form-select" v-model="user.roles[0].name" id="role">
                                    <option v-for="(rol, index) in roles" :key="index">{{ rol }}</option>
                                </select>

                                <div style="color: red;" v-if="errors && errors.roles">{{ errors.roles[0] }}</div>
                            </div>
                            <div class="mb-3">
                                <label for="number_id" class="form-label">Cedula:</label>
                                <input type="number" v-model="user.number_id" id="number_id" class="form-control" placeholder="">
                                <div style="color: red;" v-if="errors && errors.number_id">{{ errors.number_id[0] }}</div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col">
                                    <label for="name" class="form-label">Nombre</label>
                                    <input type="text" v-model="user.name" id="name" class="form-control" >
                                    <div style="color: red;" v-if="errors && errors.name">{{ errors.name[0] }}</div>
                                </div>
                                <div class="mb-3 col">
                                    <label for="" class="form-label">Apellido</label>
                                    <input type="text" v-model="user.last_name"  id="last_name" class="form-control">
                                    <div style="color: red;" v-if="errors && errors.last_name">{{ errors.last_name[0] }}</div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Dirección</label>
                                <input type="text" v-model="user.address" id="address" class="form-control" >
                                <div style="color: red;" v-if="errors && errors.address">{{ errors.address[0] }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Celular</label>
                                <input type="text" v-model="user.cellphone" id="cellphone" class="form-control" >
                                <div style="color: red;" v-if="errors && errors.cellphone">{{ errors.cellphone[0] }}</div>


                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo</label>
                                <input type="email" v-model="user.email" id="email" class="form-control" >
                                <div style="color: red;" v-if="errors && errors.email">{{ errors.email[0] }}</div>

                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Contraseña</label>
                                <input type="password" v-model="user.password" id="password" class="form-control" >
                                <div style="color: red;"  v-if="errors && errors.password">{{ errors.password[0] }}</div>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Confirmar Contraseña</label>
                                <input type="password" v-model="user.password_confirmation" id="password_confirmation" class="form-control" >
                            </div>
                        </div>
                        <!--Botones-->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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
    props: ['user_data'],
    data() {
        return {
            is_create: true,
            user: {},
            errors: {},
            roles:null
        }
    },
    created() {
        this.index()
    },
    methods: {
        index() {
            this.setUser()
            this.getAllRoles()
        },
        setUser() {
            if (!this.user_data)
            {
                this.user.roles = [{ name: '' }];
                return
                
            }    
            this.user = this.user_data
            this.is_create = false
        },
        loadFormData() {
            const form_data = new FormData()
            if (this.user.roles[0].name) form_data.append('role', this.user.roles[0].name)
            if (this.user.number_id) form_data.append('number_id', this.user.number_id)
            if (this.user.name) form_data.append('name', this.user.name)
            if (this.user.last_name) form_data.append('last_name', this.user.last_name)
            if (this.user.address) form_data.append('address', this.user.address)
            if (this.user.cellphone) form_data.append('cellphone', this.user.cellphone)
            if (this.user.email) form_data.append('email', this.user.email)
            if (this.user.password) form_data.append('password', this.user.password)
            if (this.user.password_confirmation) form_data.append('password_confirmation', this.user.password_confirmation)
            return form_data
            
        },
        async getAllRoles() {
            const { data } = await axios.get('users/GetAllRoles')
            this.roles = data.roles
        },
        async storeUser() {
            try {
                const userform = this.loadFormData()
                console.log(userform);
                if (this.is_create) {
                    await axios.post('/api/users/CreateUser', userform)
                    this.$parent.closeModal()
                    swal.fire({
                        icon: 'success',
                        title: 'El usuario se ha guardado',
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    await axios.post(`/api/users/EditUser/${this.user.id}`, userform)
                    this.$parent.closeModal()
                    swal.fire({
                        icon: 'success',
                        title: 'El usuario se ha actualizado',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            } catch (error) { 
                if (error.response.status == 422) {
                    this.errors = error.response.data.errors
                } else {
                    console.log(error)
                }
            }
        }
    }
}
</script>

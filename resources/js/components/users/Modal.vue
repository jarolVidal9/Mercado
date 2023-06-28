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
                    <form action="" method="post" class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Tipo de Usuario</label>
                                <select class="form-select" id="">
                                    <option selected>Admin</option>
                                    <option value="">Usuario</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="number_id" class="form-label">Cedula:</label>
                                <input type="number" v-model="user.number_id" id="number_id" class="form-control">
                            </div>
                            <div class="row">
                                <div class="mb-3 col">
                                    <label for="name" class="form-label">Nombre</label>
                                    <input type="text" v-model="user.name" id="name" class="form-control" >
                                </div>
                                <div class="mb-3 col">
                                    <label for="" class="form-label">Apellido</label>
                                    <input type="text" v-model="user.last_name" name="last_name" id="last_name" class="form-control">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Dirección</label>
                                <input type="text" v-model="user.address" id="address" class="form-control" >
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Celular</label>
                                <input type="text" v-model="user.cellphone" id="cellphone" class="form-control" >
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo</label>
                                <input type="email" v-model="user.email" id="email" class="form-control" >
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Contraseña</label>
                                <input type="password" id="password" class="form-control" >
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Confirmar Contraseña</label>
                                <input type="password" id="password_confirm" class="form-control" >
                            </div>
                        </div>
                        <!--Botones-->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary">{{ `${is_create ? 'Crear' : 'Actualizar'} `
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
            user: {}
        }
    },
    created() {
        this.index()
    },
    methods: {
        index() {
            this.setUser()
        },
        setUser() {
            if (!this.user_data) return
            this.user = this.user_data
            this.is_create = false
        }
    }
}
</script>

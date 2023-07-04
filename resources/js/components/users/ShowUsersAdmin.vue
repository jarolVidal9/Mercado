<template>
    <div>
        <div class="table-responsive border shadow p-3">
            <div class="d-flex justify-content-between">
                <div>
                    <h1>Usuarios</h1>
                </div>
                <div>
                    <button @click="CreateUser()" class="btn btn-success" href="#" role="button">Crear Usuario</button>
                </div>
            </div>
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Documento</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(user, index) in users" :key="index">
                        <td scope="row">{{ user.number_id }}</td>
                        <td>{{ user.name }} {{ user.last_name }}</td>
                        <!-- hacer mutador -->
                        <td>{{ user.address }}</td>
                        <td>{{ user.cellphone }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.roles[0].name}}</td>
                        <td>
                            <div class="d-flex justify-content-start">
                                <button @click="EditButton(user.id)" name="" id="" class="col btn btn-warning me-2"
                                    role="button">Editar</button>
                                <button @click="deleteUser(user.id)" name="" id="" class="col btn btn-danger" role="button">Eliminar</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <section v-if="load_modal">
        <modal-form :user_data="user" />
    </section>
</template>

<script>
import ModalForm from './ModalUsers.vue'
export default {
    components: {
        ModalForm,
    },
    data() {
        return {
            users: [],
            load_modal: false,
            user: null,
            modal:null
        }
    },
    created() {
        this.index()
    },
    methods: {
        index() {
            this.getAllUsers()
        },
        async EditButton(user_id) {
            try {
                const { data } = await axios.get(`/api/users/GetAUser/${user_id}`)
                this.user = data.user
                this.openModal()
            } catch (error) {
                console.log(error);
            }
        },
        async CreateUser() {
            try {
                this.openModal()
            } catch (error) {
                console.error(error);
            }
        },
        async getAllUsers() {
            try {
                const { data } = await axios.get('/api/users/GetAllUsers')
                this.users = data.users
            } catch (error) {
                console.error(error);
            }
        },
        openModal() {
            this.load_modal = true;
            setTimeout(() => {
                this.modal = new bootstrap.Modal(document.getElementById('modalId'), {
                    keyboard: false
                });
                this.modal.show();
                const modal = document.getElementById('modalId');
                modal.addEventListener('hidden.bs.modal', () => {
                    this.load_modal = false
                    this.user = null
                })
            }, 200);

        },
        closeModal() {
            this.modal.hide()
            this.getAllUsers()
        },
        async deleteUser(user_id){
            try {
                const result=await swal.fire({
                    title: 'Seguro quieres borrar el Usuario?',
                    text: "Esta acción no se puede revertir",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Eliminar',
                    cancelButtonText:'Cancelar'
                })
                    if (result.isConfirmed) {
                        await axios.delete(`/api/users/DeleteUser/${user_id}`)
                        this.getAllUsers()
                        swal.fire(
                            'Eliminado',
                            'El usuario se ha eliminado.',
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

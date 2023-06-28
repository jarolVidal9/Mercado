<template>
    <div>
        <h1>Usuarios</h1>
        <div class="table-responsive border shadow p-3">
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
                        <td>Admin</td>
                        <td class="roe">
                            <button @click="getAUSer(user.id)" name="" id="" class="col btn btn-warning me-2" href="#"
                                role="button">Editar</button>
                            <a name="" id="" class="col btn btn-danger" href="#" role="button">Eliminar</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <modal-form></modal-form>
</template>

<script>
import ModalForm from './Modal.vue'
export default {
    data() {
        return {
            users: [],
        }
    },
    created() {
        this.index()
    },
    methods: {
        index() {
            this.getAllUsers()
        },
        async getAUSer(user_id) {
            try {
                const { data } = await axios.get(`/api/users/GetAUser/${user_id}`)
                console.log(data.user)
            } catch (error) {

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
        async deleteUser() {
            try {

            } catch (error) {

            }
        }
    }
}
</script>

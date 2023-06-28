import './bootstrap';
import { createApp } from 'vue';
import ExampleComponent from './components/ExampleComponent.vue';
import ShowProducts from './components/products/ShowProductsUsers.vue';
import ShowProductsAdmin from './components/products/ShowProductsAdmin.vue';
import ListUsers from './components/users/ListUsers.vue';

const app = createApp({
    components: {
        ExampleComponent,
        ShowProducts,
        ListUsers,
        ShowProductsAdmin
    }
});




app.mount('#app');

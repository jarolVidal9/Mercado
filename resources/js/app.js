import './bootstrap';
import { createApp } from 'vue';
import ExampleComponent from './components/ExampleComponent.vue';
import ShowProducts from './components/products/ShowProductsUsers.vue';
import ShowProductsAdmin from './components/products/ShowProductsAdmin.vue';
import ShowUsersAdmin from './components/users/ShowUsersAdmin.vue';
import ShowCategories from './components/categories/ShowCategories.vue';

import vSelect from "vue-select";

const app = createApp({
    components: {
        ExampleComponent,
        ShowProducts,
        ShowUsersAdmin,
        ShowProductsAdmin,
        ShowCategories
    }
});
app.component("v-select", vSelect);
app.mount('#app');

import './bootstrap';
import { createApp } from 'vue';
import ExampleComponent from './components/ExampleComponent.vue';
import ShowProducts from './components/products/ShowProducts.vue';



const app = createApp({
    components: {
        ExampleComponent,
        ShowProducts,
    }
});




app.mount('#app');

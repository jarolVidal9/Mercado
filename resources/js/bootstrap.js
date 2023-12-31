import * as bootstrap from 'bootstrap';
import axios from 'axios';
import swal from 'sweetalert2';
import _ from 'lodash'; 
import jQuery from 'jquery';
import 'datatables.net-bs5';


window._ = _;
window.axios = axios;
window.swal = swal;
window.bootstrap = bootstrap;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.$=jQuery


const csrf_token = document.head.querySelector('meta[name="csrf-token"]');
if (csrf_token) {
    window.csrf_token=csrf_token.content
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = window.csrf_token;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}



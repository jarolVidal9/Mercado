import 'bootstrap';
import axios from 'axios';
import swal from 'sweetalert2';
import _ from 'lodash'; 

window._ = _;
window.axios = axios;
window.swal = swal;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


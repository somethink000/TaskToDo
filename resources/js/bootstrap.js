import 'bootstrap';


import axios from 'axios';
window.axios = axios;
awindow.axios.defaults.withCredentials = true;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
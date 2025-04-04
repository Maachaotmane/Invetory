import axios from 'axios';
window.axios = axios;

axios.defaults.baseURL = 'https://invetory-production.up.railway.app';
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

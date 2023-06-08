import './bootstrap';

import {createApp} from 'vue';
import App from '../js/App.vue';
import axios from 'axios';
import router from './router';
import functions from './functions.js'

const app = createApp(App);
app.use(functions);
app.use(router).mount('#app');


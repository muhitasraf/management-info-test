import './bootstrap';

import {createApp} from 'vue';
import App from '../js/App.vue';
import axios from 'axios';
import router from './router';

createApp(App).use(router).mount('#app');

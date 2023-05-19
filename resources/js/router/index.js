
import {createWebHistory, createRouter} from "vue-router";

import Home from '../pages/Home.vue';

import Company from '../components/company/Show.vue';
import CompanyCreate from '../components/company/Add.vue';

import CustomerList from '../components/customer/List.vue';
import CustomerCreate from '../components/customer/Add.vue';
import ViewCustomer from '../components/customer/Show.vue';
import EditCustomer from '../components/customer/Edit.vue';


export const routes = [
    { name: 'Home', path: '/', component: Home },

    { name: 'Company', path: '/company', component: Company },
    { name: 'CompanyCreate', path: '/company/create', component: CompanyCreate },
    // {  name: 'EditCompany', path: '/company/edit/:id', component: EditCompany },

    { name: 'CustomerList', path: '/customer', component: CustomerList },
    { name: 'CustomerCreate', path: '/customer/create', component: CustomerCreate },
    { name: 'ViewCustomer', path: '/customer/view/:id', component: ViewCustomer },
    { name: 'EditCustomer', path: '/customer/edit/:id', component: EditCustomer }
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;

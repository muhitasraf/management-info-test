
import {createWebHistory, createRouter} from "vue-router";

import Home from '../pages/Home.vue';

import Company from '../components/company/Show.vue';
import CompanyCreate from '../components/company/Add.vue';

import CustomerList from '../components/customer/List.vue';
import CustomerCreate from '../components/customer/Add.vue';
import ViewCustomer from '../components/customer/Show.vue';
import EditCustomer from '../components/customer/Edit.vue';

import SupplierList from '../components/supplier/List.vue';
import CreateSupplier from '../components/supplier/Add.vue';
import ViewSupplier from '../components/supplier/Show.vue';
import EditSupplier from '../components/supplier/Edit.vue';

import EmployeeList from '../components/employee/List.vue';
import CreateEmployee from '../components/employee/Add.vue';
import ViewEmployee from '../components/employee/Show.vue';
import EditEmployee from '../components/employee/Edit.vue';

import Unit from '../components/unit/Show.vue';
import CreateUnit from '../components/unit/Add.vue';

export const routes = [
    { name: 'Home', path: '/', component: Home },

    { name: 'Company', path: '/company', component: Company },
    { name: 'CompanyCreate', path: '/company/create', component: CompanyCreate },
    // {  name: 'EditCompany', path: '/company/edit/:id', component: EditCompany },

    { name: 'CustomerList', path: '/customer', component: CustomerList },
    { name: 'CustomerCreate', path: '/customer/create', component: CustomerCreate },
    { name: 'ViewCustomer', path: '/customer/view/:id', component: ViewCustomer },
    { name: 'EditCustomer', path: '/customer/edit/:id', component: EditCustomer },

    { name: 'SupplierList', path: '/supplier', component: SupplierList },
    { name: 'CreateSupplier', path: '/supplier/create', component: CreateSupplier },
    { name: 'ViewSupplier', path: '/supplier/view/:id', component: ViewSupplier },
    { name: 'EditSupplier', path: '/supplier/edit/:id', component: EditSupplier },

    { name: 'EmployeeList', path: '/employee', component: EmployeeList },
    { name: 'CreateEmployee', path: '/employee/create', component: CreateEmployee },
    { name: 'ViewEmployee', path: '/employee/view/:id', component: ViewEmployee },
    { name: 'EditEmployee', path: '/employee/edit/:id', component: EditEmployee },

    { name: 'Unit', path: '/unit', component: Unit },
    { name: 'CreateUnit', path: '/unit/create', component: CreateUnit },
    // { name: 'ViewEmployee', path: '/unit/view/:id', component: ViewUnit },
    // { name: 'EditUnit', path: '/unit/edit/:id', component: EditUnit }
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;

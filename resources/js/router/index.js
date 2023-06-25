
import {createWebHistory, createRouter} from "vue-router";

import Home from '../pages/Home.vue';
import Login from '../pages/Login.vue';

import Company from '../components/company/Show.vue';
import CompanyCreate from '../components/company/Add.vue';

import User from '../components/user/List.vue';

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

import Designation from '../components/designation/Show.vue';
import CreateDesignation from '../components/designation/Add.vue';

import Department from '../components/department/Show.vue';
import CreateDepartment from '../components/department/Add.vue';

import District from '../components/address/district/Show.vue';
import CreateDistrict from '../components/address/district/Add.vue';

import Division from '../components/address/division/Show.vue';
import CreateDivision from '../components/address/division/Add.vue';

import Thana from '../components/address/thana/Show.vue';
import CreateThana from '../components/address/thana/Add.vue';

import Union from '../components/address/union/Show.vue';
import CreateUnion from '../components/address/union/Add.vue';

import CreateMowza from '../components/address/mowza/Add.vue';

import EmployeeSalary from '../components/employee_salary/List.vue';
import CreateEmployeeSalary from '../components/employee_salary/Add.vue';
import ViewEmployeeSalary from '../components/employee_salary/Show.vue';
import EditEmployeeSalary from '../components/employee_salary/Edit.vue';

import Booking from '../components/booking/List.vue';
import CreateBooking from '../components/booking/Add.vue';
import ViewBooking from '../components/booking/Show.vue';
import EditBooking from '../components/booking/Edit.vue';

import Registration from '../components/registration/List.vue';
import CreateRegistration from '../components/registration/Add.vue';
import ViewRegistration from '../components/registration/Show.vue';
import EditRegistration from '../components/registration/Edit.vue';

import Collection from '../components/collection/List.vue';
import CreateCollection from '../components/collection/Add.vue';
import ViewCollection from '../components/collection/Show.vue';
import EditCollection from '../components/collection/Edit.vue';

import Purchase from '../components/purchase/List.vue';
import CreatePurchase from '../components/purchase/Add.vue';
import ViewPurchase from '../components/purchase/Show.vue';
import EditPurchase from '../components/purchase/Edit.vue';

export const routes = [
    { name: 'Home', path: '/', component: Home, meta : {requiresAuth:true} },
    { name: 'Login', path: '/login', component: Login, meta : {requiresGuest:true} },

    { name: 'Company', path: '/company', component: Company, meta : {requiresAuth:true} },
    { name: 'CompanyCreate', path: '/company/create', component: CompanyCreate, meta : {requiresAuth:true} },
    // {  name: 'EditCompany', path: '/company/edit/:id', component: EditCompany },

    { name: 'User', path: '/user', component: User, meta : {requiresAuth:true} },

    { name: 'CustomerList', path: '/customer', component: CustomerList, meta : {requiresAuth:true} },
    { name: 'CustomerCreate', path: '/customer/create', component: CustomerCreate, meta : {requiresAuth:true} },
    { name: 'ViewCustomer', path: '/customer/view/:id', component: ViewCustomer, meta : {requiresAuth:true} },
    { name: 'EditCustomer', path: '/customer/edit/:id', component: EditCustomer, meta : {requiresAuth:true} },

    { name: 'SupplierList', path: '/supplier', component: SupplierList, meta : {requiresAuth:true} },
    { name: 'CreateSupplier', path: '/supplier/create', component: CreateSupplier, meta : {requiresAuth:true} },
    { name: 'ViewSupplier', path: '/supplier/view/:id', component: ViewSupplier, meta : {requiresAuth:true} },
    { name: 'EditSupplier', path: '/supplier/edit/:id', component: EditSupplier, meta : {requiresAuth:true} },

    { name: 'EmployeeList', path: '/employee', component: EmployeeList, meta : {requiresAuth:true} },
    { name: 'CreateEmployee', path: '/employee/create', component: CreateEmployee, meta : {requiresAuth:true} },
    { name: 'ViewEmployee', path: '/employee/view/:id', component: ViewEmployee, meta : {requiresAuth:true} },
    { name: 'EditEmployee', path: '/employee/edit/:id', component: EditEmployee },

    { name: 'Unit', path: '/unit', component: Unit, meta : {requiresAuth:true} },
    { name: 'CreateUnit', path: '/unit/create', component: CreateUnit, meta : {requiresAuth:true} },
    // { name: 'ViewEmployee', path: '/unit/view/:id', component: ViewUnit },
    // { name: 'EditUnit', path: '/unit/edit/:id', component: EditUnit }

    { name: 'Designation', path: '/designation', component: Designation, meta : {requiresAuth:true} },
    { name: 'CreateDesignation', path: '/designation/create', component: CreateDesignation, meta : {requiresAuth:true} },

    { name: 'Department', path: '/department', component: Department, meta : {requiresAuth:true} },
    { name: 'CreateDepartment', path: '/department/create', component: CreateDepartment, meta : {requiresAuth:true} },

    { name: 'District', path: '/district', component: District, meta : {requiresAuth:true} },
    { name: 'CreateDistrict', path: '/district/create', component: CreateDistrict, meta : {requiresAuth:true} },

    { name: 'Division', path: '/division', component: Division, meta : {requiresAuth:true} },
    { name: 'CreateDivision', path: '/division/create', component: CreateDivision, meta : {requiresAuth:true} },

    { name: 'Thana', path: '/thana', component: Thana, meta : {requiresAuth:true} },
    { name: 'CreateThana', path: '/thana/create', component: CreateThana, meta : {requiresAuth:true} },

    { name: 'Union', path: '/union', component: Union, meta : {requiresAuth:true} },
    { name: 'CreateUnion', path: '/union/create', component: CreateUnion, meta : {requiresAuth:true} },

    { name: 'CreateMowza', path: '/mowza/create', component: CreateMowza, meta : {requiresAuth:true} },

    { name: 'EmployeeSalary', path: '/employee_salary', component: EmployeeSalary, meta : {requiresAuth:true} },
    { name: 'CreateEmployeeSalary', path: '/employee_salary/create', component: CreateEmployeeSalary, meta : {requiresAuth:true} },
    { name: 'ViewEmployeeSalary', path: '/employee_salary/view/:id', component: ViewEmployeeSalary, meta : {requiresAuth:true} },
    { name: 'EditEmployeeSalary', path: '/employee_salary/edit/:id', component: EditEmployeeSalary },

    { name: 'Booking', path: '/booking', component: Booking, meta : {requiresAuth:true} },
    { name: 'CreateBooking', path: '/booking/create', component: CreateBooking, meta : {requiresAuth:true} },
    { name: 'ViewBooking', path: '/booking/view/:id', component: ViewBooking, meta : {requiresAuth:true} },
    { name: 'EditBooking', path: '/booking/edit/:id', component: EditBooking, meta : {requiresAuth:true} },

    { name: 'Registration', path: '/registration', component: Registration, meta : {requiresAuth:true} },
    { name: 'CreateRegistration', path: '/registration/create', component: CreateRegistration, meta : {requiresAuth:true} },
    { name: 'ViewRegistration', path: '/registration/view/:id', component: ViewRegistration, meta : {requiresAuth:true} },
    { name: 'EditRegistration', path: '/registration/edit/:id', component: EditRegistration, meta : {requiresAuth:true} },

    { name: 'Collection', path: '/collection', component: Collection, meta : {requiresAuth:true} },
    { name: 'CreateCollection', path: '/collection/create', component: CreateCollection, meta : {requiresAuth:true} },
    { name: 'ViewCollection', path: '/collection/view/:id', component: ViewCollection, meta : {requiresAuth:true} },
    { name: 'EditCollection', path: '/collection/edit/:id', component: EditCollection, meta : {requiresAuth:true} },

    { name: 'Purchase', path: '/purchase', component: Purchase, meta : {requiresAuth:true} },
    { name: 'CreatePurchase', path: '/purchase/create', component: CreatePurchase, meta : {requiresAuth:true} },
    { name: 'ViewPurchase', path: '/purchase/view/:id', component: ViewPurchase, meta : {requiresAuth:true} },
    { name: 'EditPurchase', path: '/purchase/edit/:id', component: EditPurchase, meta : {requiresAuth:true} },

];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});


router.beforeEach((to, from) => {
    const authenticated = localStorage.getItem("authenticated");

    if (to.meta.requiresGuest && authenticated) {
        return {
            name: "Home",
        };
    } else if (to.meta.requiresAuth && !authenticated) {
        return {
            name: "Login",
        };
    }
});

export default router;

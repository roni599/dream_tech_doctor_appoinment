import { createRouter, createWebHistory } from 'vue-router';
import Login from '../components/hospital/admin/auth/Login.vue';
import Register from '../components/hospital/admin/auth/Register.vue'
import Forget from '../components/hospital/admin/auth/Forget.vue';

import Home from '../components/hospital/user/Home.vue';

import Dashboard from '../components/hospital/admin/dashboard/Dashboard.vue';

import Doctor from '../components/hospital/admin/dashboard/doctor/Doctor.vue';
import DoctorCreate from '../components/hospital/admin/dashboard/doctor/DoctorCreate.vue';
import DoctorView from '../components/hospital/admin/dashboard/doctor/DoctorView.vue';
import DoctorviewOffline from '../components/hospital/admin/dashboard/doctor/DoctorviewOffline.vue';
import DoctorEdit from '../components/hospital/admin/dashboard/doctor/DoctorEdit.vue';

import AppoinmentCreate from '../components/hospital/admin/dashboard/appoinment/AppoinmentCreate.vue';

const routes = [
    { name: 'Home', component: Home, path: '/' },


    { name: 'Login', component: Login, path: '/login' },
    { name: 'Register', component: Register, path: '/register' },
    { name: 'Forget', component: Forget, path: '/forget' },
    { name: 'DoctorviewOffline', component: DoctorviewOffline, path: '/doctorview/:id' },


    {
        path: '/hospital_dashboard',
        name: 'Dashboard',
        component: Dashboard,
        children: [
            {
                path: '/doctor',
                name: 'Doctor',
                components: {
                    default: Dashboard,
                    content: Doctor,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/doctor_create',
                name: 'DoctorCreate',
                components: {
                    default: Dashboard,
                    content: DoctorCreate,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/doctor_view/:id',
                name: 'DoctorView',
                components: {
                    default: Dashboard,
                    content: DoctorView,
                },
                meta: { hideMainContent: true },
            },
            {
                path: '/doctoredit/:id',
                name: 'DoctorEdit',
                components: {
                    default: Dashboard,
                    content: DoctorEdit,
                },
                meta: { hideMainContent: true },
            },

            {
                path: '/appoinment_create',
                name: 'AppoinmentCreate',
                components: {
                    default: Dashboard,
                    content: AppoinmentCreate,
                },
                meta: { hideMainContent: true },
            },
        ]
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
});



export default router;
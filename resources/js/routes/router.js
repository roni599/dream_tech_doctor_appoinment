import { createRouter, createWebHistory } from 'vue-router';
import Login from '../components/hospital/admin/auth/Login.vue';
import Register from '../components/hospital/admin/auth/Register.vue'
import Forget from '../components/hospital/admin/auth/Forget.vue';

import Dashboard from '../components/hospital/admin/dashboard/Dashboard.vue';
import Doctor from '../components/hospital/admin/dashboard/doctor/Doctor.vue';
import DoctorCreate from '../components/hospital/admin/dashboard/doctor/DoctorCreate.vue';
const routes = [
    { name: 'Login', component: Login, path: '/' },
    { name: 'Register', component: Register, path: '/register' },
    { name: 'Forget', component: Forget, path: '/forget' },


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
        ]
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
});



export default router;
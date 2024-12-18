import { createRouter, createWebHistory } from 'vue-router';
import Dashboard from '../components/hospital/admin/dashboard/Dashboard.vue';
import Login from '../components/hospital/admin/auth/Login.vue';
import Register from '../components/hospital/admin/auth/Register.vue'
const routes = [
    { name: 'Dashboard', component: Dashboard, path: '/' },
    { name: 'Login', component: Login, path: '/login' },
    { name: 'Register', component: Register, path: '/register' },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
});



export default router;
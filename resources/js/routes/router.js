import { createRouter, createWebHistory } from 'vue-router';
import Dashboard from '../components/hospital/admin/dashboard/Dashboard.vue';
import Login from '../components/hospital/admin/auth/Login.vue';
import Register from '../components/hospital/admin/auth/Register.vue'
import Forget from '../components/hospital/admin/auth/Forget.vue';
const routes = [
    { name: 'Dashboard', component: Dashboard, path: '/hospital_dashboard' },
    { name: 'Login', component: Login, path: '/' },
    { name: 'Register', component: Register, path: '/register' },
    { name: 'Forget', component: Forget, path: '/forget' }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
});



export default router;
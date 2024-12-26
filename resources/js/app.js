import { createApp } from 'vue';
import './bootstrap';
import router from './routes/router';
import App from './components/App.vue';
const app = createApp(App);
app.use(router);
app.mount('#app');
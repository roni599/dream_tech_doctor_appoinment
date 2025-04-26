<template>
    <div class="container">
        <div class="d-flex w-100 mb-sm-0">
            <router-link to="/pathology" class="btn btn-primary ms-2">
                + Pathology List
            </router-link>
        </div>
        <div class="d-flex justify-content-center align-items-center mt-2">
            <div class="card" style="width: 1300px;">
                <div class="card-header mt-3">
                    <h5 class="card-title">Pathology</h5>
                </div>
                <div class="card-body">
                    <form @submit.prevent="submitForm">
                        <div class="row form-section mb-2">
                            <div class="col-md-12 mb-3">
                                <label for="department" class="form-label mb-0">Pathology-Category-Name</label>
                                <select id="department-category" v-model="form.pathology_category" class="form-select">
                                    <option value="" selected>Choose...</option>
                                    <option v-for="pathology_category in pathology_categories" :key="pathology_category.id" :value="pathology_category.id">
                                        {{ pathology_category.name }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-section mb-2">
                            <div class="col-md-12">
                                <label for="pathology_name" class="form-label mb-0">Pathology Name</label>
                                <input type="text" v-model="form.name" class="form-control" id="pathology_name">
                                <div v-if="errors.name" class="text-danger">{{ errors.name[0] }}</div>
                            </div>
                        </div>
                        <div class="row form-section mb-3">
                            <div class="col-md-12">
                                <label for="pathology_price" class="form-label mb-0">Price</label>
                                <input type="number" v-model="form.price" class="form-control" id="pathology_price">
                                <div v-if="errors.price" class="text-danger">{{ errors.price[0] }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-primary me-3 w-100">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { ref, onMounted } from 'vue';
import Cookies from 'js-cookie';
import { useRouter } from 'vue-router';
export default {
    name: "PathologyCreate",
    setup() {
        const pathology_categories = ref([]);
        const router = useRouter();
        const access_token = ref('');
        const form = ref({
            pathology_category:'',
            name: '',
            price: ''
        })
        const errors = ref({});
        const submitForm = async () => {
            try {
                const response = await axios.post('/api/auth/pathology/create', form.value, {
                    headers: {
                        'Authorization': `Bearer ${access_token.value}`
                    }
                });
                if (response.data && response.status === 201) {
                    formReset();
                    router.push({ name: 'Pathology' })
                    Swal.fire({
                        title: response.data.message,
                        icon: "success",
                        draggable: true
                    });
                }
            } catch (error) {
                if (error.response && error.response.status === 422) {
                    errors.value = error.response.data.errors;
                } else {
                    console.error('Something went wrong:', error);
                }
            }
        }
        const fetchPathologyCategories = async () => {
            try {
                const response = await axios.get('/api/auth/pathology-category', {
                    headers: {
                        'Authorization': `Bearer ${access_token.value}`
                    }
                });
                if (response.data && response.status === 200) {
                    pathology_categories.value = response.data;
                }
            } catch (error) {
                console.log(error)
            }
        }
        const formReset = async () => {
            form.value.name = '',
                form.value.price = ''
        }
        onMounted(() => {
            access_token.value = Cookies.get('access_token');
            fetchPathologyCategories();
        })
        return {
            form,
            submitForm,
            errors,
            pathology_categories,
            
        }
    }
}
</script>

<style></style>
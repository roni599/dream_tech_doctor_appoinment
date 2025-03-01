<template>
    <div class="container">
        <div class="d-flex w-100 mb-sm-0">
            <router-link to="/department-category" class="btn btn-primary ms-2">
                + Department-Category List
            </router-link>
        </div>
        <div class="d-flex justify-content-center align-items-center mt-2">
            <div class="card" style="width: 1300px;">
                <div class="card-header mt-3">
                    <h5 class="card-title">Department-Category</h5>
                </div>
                <div class="card-body">
                    <form @submit.prevent="submitDepartment">
                        <div class="row form-section mb-4">
                            <div class="col-md-12">
                                <label for="department" class="form-label mb-0">Department-Category</label>
                                <input v-model="form.department_category" type="text" class="form-control"
                                    id="reg-number">
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
import { onMounted, ref } from 'vue';
import Cookies from 'js-cookie';
import { useRouter } from 'vue-router';
export default {
    name: 'DepartmentCreate',
    setup() {
        const router = useRouter();
        const form = ref({
            department_category: ''
        })
        const access_token = ref('');
        const submitDepartment = async () => {
            try {
                const response = await axios.post('/api/auth/department/store', form.value, {
                    headers: {
                        'Authorization': `Bearer ${access_token.value}`
                    }
                });
                if (response.data && response.status === 201) {
                    router.push({name:'Department'})
                    Swal.fire({
                        title: response.data.message,
                        icon: "success",
                        draggable: true
                    });
                    form.value.department_category = '';
                }
            } catch (error) {
                console.error("Error occurred:", error);
                Swal.fire({
                    title: "Error",
                    text: error.response?.data?.message || "An unexpected error occurred",
                    icon: "error",
                    draggable: true
                });
            }
        }
        onMounted(() => {
            access_token.value = Cookies.get('access_token');
        })
        return {
            form,
            submitDepartment
        }
    }
}
</script>

<style></style>
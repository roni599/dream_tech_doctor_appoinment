<template>
    <div class="container">
        <div class="d-flex w-100 mb-sm-0">
            <router-link to="/pathology-category" class="btn btn-primary ms-2">
                + Pathology-Category-List
            </router-link>
        </div>
        <div class="d-flex justify-content-center align-items-center mt-2">
            <div class="card" style="width: 1300px;">
                <div class="card-header mt-3">
                    <h5 class="card-title">Pathology-Category</h5>
                </div>
                <div class="card-body">
                    <form @submit.prevent="formSubmit">
                        <div class="row form-section mb-2">
                            <div class="col-md-12">
                                <label for="pathology_name" class="form-label mb-0">Pathology-category-Name</label>
                                <input type="text" v-model="form.name" class="form-control" id="pathology_name">
                                <div v-if="errors.name" class="text-danger">{{ errors.name[0] }}</div>
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
    name: "CategoryCreate",
    setup() {
        const router = useRouter();
        const access_token=ref('');
        const form = ref({
            name: '',
        })
        const errors = ref({});
        const formSubmit = async () => {
            try {
                const response = await axios.post('/api/auth/pathology-category/create', form.value, {
                    headers: {
                        'Authorization': `Bearer ${access_token.value}`
                    }
                });
                if (response.data && response.status === 201) {
                    formReset();
                    router.push({ name: 'Category' })
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
        const formReset=()=>{
            form.value.name='';
        }
        onMounted(() => {
            access_token.value = Cookies.get('access_token');
        })
        return {
            form,
            errors,
            formSubmit
        }
    }
}
</script>

<style></style>
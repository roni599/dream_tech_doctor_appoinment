<template>
    <div class="container">
        <div class="d-flex w-100 mb-sm-0">
            <router-link to="/medicine-group" class="btn btn-primary ms-2">
                + Medicine-Group List
            </router-link>
        </div>
        <div class="d-flex justify-content-center align-items-center mt-2">
            <div class="card" style="width: 1300px;">
                <div class="card-header mt-3">
                    <h5 class="card-title">Medicine-Group</h5>
                </div>
                <div class="card-body">
                    <form @submit.prevent="submitMedicineGroup">
                        <div class="row form-section mb-4">
                            <div class="col-md-12">
                                <label for="department" class="form-label mb-0">Medicine-Group</label>
                                <input v-model="form.medicine_group" type="text" class="form-control"
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
    name: "MedicinegroupCreate",
    setup() {
        const router = useRouter();
        const form = ref({
            medicine_group: ''
        })
        const access_token = ref('');
        const submitMedicineGroup = async () => {
            try {
                const response = await axios.post('/api/auth/medicine-group/store', form.value, {
                    headers: {
                        'Authorization': `Bearer ${access_token.value}`
                    }
                });
                console.log(response)
                if (response.data && response.status === 201) {
                    router.push({ name: 'MedicineGroup' })
                    Swal.fire({
                        title: response.data.message,
                        icon: "success",
                        draggable: true
                    });
                    form.value.medicine_group = '';
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
            submitMedicineGroup
        }
    }
}
</script>

<style scoped></style>
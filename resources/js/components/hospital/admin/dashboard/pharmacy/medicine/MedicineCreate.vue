<template>
    <div class="container">
        <div class="d-flex w-100 mb-sm-0">
            <router-link to="/medicine" class="btn btn-primary ms-2">
                + Medicine List
            </router-link>
        </div>
        <div class="d-flex justify-content-center align-items-center mt-2">
            <div class="card" style="width: 1300px;">
                <div class="card-header mt-3">
                    <h5 class="card-title">Medicine</h5>
                </div>
                <div class="card-body">
                    <form @submit.prevent="submitMedicine">
                        <div class="row form-section mb-2">
                            <div class="col-md-12">
                                <select v-model="form.medicine_group_id" id="medicine_group" class="form-control">
                                    <option value="">Select Medicine Group</option>
                                    <option v-for="medicine_group in medicineGroup" :value="medicine_group.id"
                                        :key="medicine_group.id">{{ medicine_group.group_name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-section mb-2">
                            <div class="col-md-12">
                                <label for="department" class="form-label mb-0">Medicine Name</label>
                                <input v-model="form.medicine_name" type="text" class="form-control" id="reg-number">
                            </div>
                        </div>
                        <div class="row form-section mb-2">
                            <div class="col-md-12">
                                <label for="department" class="form-label mb-0">Strength<span
                                        class="text-danger">*</span> (gm/mg)</label>
                                <input v-model="form.medicine_strength" type="text" class="form-control"
                                    id="reg-number">
                            </div>
                        </div>
                        <div class="row form-section mb-4">
                            <div class="col-md-12">
                                <label for="department" class="form-label mb-0">Dosages Description <span
                                        class="text-danger">*</span>(tab/syp)</label>
                                <input v-model="form.dosages_description" type="text" class="form-control"
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
    name: "MedicineCreate",
    setup() {
        const router = useRouter();
        const medicineGroup = ref([]);
        const form = ref({
            medicine_group_id: '',
            medicine_name: '',
            medicine_strength: '',
            dosages_description: ''
        })
        const access_token = ref('');

        const fetchMedicineGroup = async () => {
            try {
                const response = await axios.get('/api/auth/medicine-group', {
                    headers: {
                        'Authorization': `Bearer ${access_token.value}`
                    }
                });
                if (response.data && response.status === 200) {
                    medicineGroup.value = response.data;
                }
            } catch (error) {
            }
        }
        const submitMedicine = async () => {
            try {
                const response = await axios.post('/api/auth/medicine/create', form.value, {
                    headers: {
                        'Authorization': `Bearer ${access_token.value}`
                    }
                });
                if (response.data && response.status === 201) {
                    form.value.medicine_group_id = '';
                    form.value.medicine_name = '';
                    form.value.medicine_strength = '';
                    form.value.dosages_description = '';
                    router.push({ name: 'Medicine' })
                    Swal.fire({
                        title: response.data.message,
                        icon: "success",
                        draggable: true
                    });
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
            fetchMedicineGroup()
        })
        return {
            form,
            submitMedicine,
            medicineGroup,
        }
    }
}
</script>

<style scoped></style>
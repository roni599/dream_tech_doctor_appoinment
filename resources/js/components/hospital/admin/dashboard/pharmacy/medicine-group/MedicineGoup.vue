<template>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3 w-100">
            <div class="d-flex w-100 mb-2 mb-sm-0">
                <router-link to="/medicine-group-create" class="btn btn-primary ms-2">
                    + Create Medicine-Group
                </router-link>
            </div>
        </div>
        <div class="allFeature">
            <div class="row mb-1">
                <div class="col-md-12 mb-3">
                    <label for="department" class="form-label mb-0">Medicine-Group</label>
                    <select id="department-category" v-model="medicine_group" class="form-select">
                        <option value="" selected>Choose...</option>
                        <option v-for="medicine_group in medicineGroup" :key="medicine_group.id"
                            :value="medicine_group.group_name">{{ medicine_group.group_name }}</option>
                    </select>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>Sl No</th>
                            <th>Medicine Group Name</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(medicine_group, index) in filteredmedicineGroup" :key="medicine_group.id">
                            <td>{{ index + 1 }}</td>
                            <td>{{ medicine_group.group_name }}</td>
                            <td>
                                <span class="badge bg-success" v-if="medicine_group.status === 1">Active</span>
                                <span v-else class="badge bg-danger">InActive</span>
                            </td>
                            <td class="text-end">
                                <router-link :to="{ name: 'MedicinegroupEdit', params: { id: medicine_group.id } }"
                                    class="btn btn-outline-warning btn-sm me-2">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </router-link>
                                <button class="btn btn-outline-danger btn-sm"
                                    @click="deleteMedicineGroup(medicine_group.id)">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
import { ref, computed, onMounted } from 'vue';
import Cookies from 'js-cookie';
export default {
    name: "MedicineGroup",
    setup() {
        const access_token = ref('');
        const medicineGroup = ref([]);
        const medicine_group = ref('');


        const filteredmedicineGroup = computed(() => {
            return medicineGroup.value.filter(medicinegroup =>
                medicinegroup.group_name.toLowerCase().includes(medicine_group.value.toLowerCase())
            );
        });


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
        const deleteMedicineGroup = async (id) => {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        const response = await axios.post('/api/auth/medicine-group/delete', { id }, {
                            headers: {
                                'Authorization': `Bearer ${access_token.value}`
                            }
                        })

                        if (response.data && response.status === 200) {
                            fetchMedicineGroup();
                            Swal.fire({
                                title: response.data.message,
                                icon: "success",
                                draggable: true
                            });
                        }
                    } catch (error) {
                        console.error(error.response);
                    }
                }
            });
        }
        onMounted(() => {
            access_token.value = Cookies.get('access_token');
            fetchMedicineGroup();
        })
        return {
            medicineGroup,
            deleteMedicineGroup,
            filteredmedicineGroup,
            medicine_group
        }
    }
}
</script>

<style scoped></style>
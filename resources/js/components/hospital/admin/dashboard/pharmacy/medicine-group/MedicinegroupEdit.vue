<template>
    <router-link to="/medicine-group" class="btn btn-primary w-100 mb-2">
        <i class="fa-solid fa-list"></i> Medicine-Group List</router-link>
    <div class="d-flex justify-content-center align-items-center">
        <div class="card w-100" style="max-width: 1230px">
            <div class="card-header mt-2">
                <h5 class="card-title">Medicine-Group Edit</h5>
            </div>
            <div class="card-body">
                <form @submit.prevent="medicineGroupEdit">
                    <div class="row form-section mb-4">
                        <div class="col-md-12">
                            <label for="symptom" class="form-label mb-0">Medicine-Group</label>
                            <input v-model="form.medicine_group" type="text" class="form-control" id="symptom"
                                required />
                        </div>
                    </div>
                    <div class="row row form-section mb-4">
                        <div class="col-md-12">
                            <label for="status" class="form-label mb-0">Status</label>
                            <select name="status" class="form-control" id="status" v-model="form.status">
                                <option value="">Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <button class="btn btn-primary w-100">Update</button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";
import { onMounted, ref } from "vue";
import { useRouter, useRoute } from 'vue-router';
import Cookies from "js-cookie";
export default {
    name: "MedicinegroupEdit",
    setup() {
        const router = useRouter();
        const route = useRoute();
        const medicineGroup_id = ref("");
        const access_token = ref("");
        const form = ref({
            id: "",
            medicine_group: "",
            status: ''
        });

        const medicineGroupEdit = async () => {
            try {
                const response = await axios.post("/api/auth/medicine-group/edit", form.value, {
                    headers: {
                        Authorization: `Bearer ${access_token.value}`,
                    },
                });
                if (response.data && response.status === 200) {
                    router.push({ name: "MedicineGroup" })
                    Swal.fire({
                        title: response.data.message,
                        icon: "success",
                        draggable: true,
                    });
                    form.value = '';
                }
            } catch (error) {
                console.log(error)
            }
        }

        const medicineGroupEditView = async () => {
            try {
                const response = await axios.get(`/api/auth/medicine-group/editdata/${medicineGroup_id.value}`,
                    {
                        headers: {
                            Authorization: `Bearer ${access_token.value}`,
                        },
                    }
                );
                if (response.data && response.status === 200) {
                    form.value.medicine_group = response.data.group_name;
                    form.value.id = response.data.id;
                    form.value.status = response.data.status
                }
            } catch (error) {
                console.log(error.response);
            }
        };

        onMounted(() => {
            access_token.value = Cookies.get("access_token");
            medicineGroup_id.value = route.params.id;
            medicineGroupEditView();
        });
        return {
            form,
            medicineGroupEdit
        }
    }
}
</script>

<style scoped></style>
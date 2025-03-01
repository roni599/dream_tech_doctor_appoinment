<template>
    <router-link to="/department-category" class="btn btn-primary w-100 mb-2">
        <i class="fa-solid fa-list"></i> Department Category List</router-link>
    <div class="d-flex justify-content-center align-items-center">
        <div class="card w-100" style="max-width: 1230px">
            <div class="card-header mt-2">
                <h5 class="card-title">Department Category Create</h5>
            </div>
            <div class="card-body">
                <form @submit.prevent="departmentEdit">
                    <div class="row form-section mb-4">
                        <div class="col-md-12">
                            <label for="symptom" class="form-label mb-0">Symptom</label>
                            <input v-model="form.department_category" type="text" class="form-control" id="symptom"
                                required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary w-100">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { onMounted, ref } from "vue";
import { useRouter,useRoute } from 'vue-router';
import Cookies from "js-cookie";
export default {
    name: 'DepartmentEdit',
    setup() {
        const router = useRouter();
        const route=useRoute();
        const specialist_id = ref("");
        const access_token = ref("");
        const form = ref({
            id: "",
            department_category: "",
        });

        const departmentEdit = async () => {
            try {
                const response = await axios.post("/api/auth/department/department-edit", form.value, {
                    headers: {
                        Authorization: `Bearer ${access_token.value}`,
                    },
                });
                if (response.data && response.status === 200) {
                    router.push({name:"Department"})
                    Swal.fire({
                        title: response.data.message,
                        icon: "success",
                        draggable: true,
                    });
                    form.value.specialist = response.data.department.department_category;
                }
            } catch (error) {
                console.log(error)
            }
        }

        const DepartmentEditView = async () => {
            try {
                const response = await axios.get(`/api/auth/department/department-editdata/${specialist_id.value}`,
                    {
                        headers: {
                            Authorization: `Bearer ${access_token.value}`,
                        },
                    }
                );
                if (response.data && response.status === 200) {
                    form.value.department_category = response.data.department_category;
                    form.value.id = response.data.id;
                }
            } catch (error) {
                console.log(error.response);
            }
        };
        
        onMounted(() => {
            access_token.value = Cookies.get("access_token");
            specialist_id.value = route.params.id;
            DepartmentEditView();
        });
        return {
            form,
            departmentEdit
        }
    }
}
</script>

<style></style>
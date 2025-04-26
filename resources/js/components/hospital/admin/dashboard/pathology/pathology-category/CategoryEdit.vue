<template>
    <router-link to="/pathology" class="btn btn-primary w-100 mb-2">
        <i class="fa-solid fa-list"></i> Pathology List</router-link>
    <div class="d-flex justify-content-center align-items-center">
        <div class="card w-100" style="max-width: 1230px">
            <div class="card-header mt-2">
                <h5 class="card-title">Pathology Edit</h5>
            </div>
            <div class="card-body">
                <form @submit.prevent="pathologyCategoryEdit">
                    <div class="row form-section mb-2">
                        <div class="col-md-12">
                            <label for="department" class="form-label mb-0">Pathology Name</label>
                            <input type="text" v-model="form.name" class="form-control" id="reg-number">
                            <div v-if="errors.name" class="text-danger">{{ errors.name[0] }}</div>
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
import { onMounted, ref } from 'vue';
import Cookies from 'js-cookie';
import { useRouter, useRoute } from 'vue-router';
export default {
    name: "CategoryEdit",
    setup() {
        const router = useRouter();
        const route = useRoute();
        const access_token = ref('');
        const pathology_category_id = ref('');
        const form = ref({
            id: '',
            name: '',
            status: '',
        });
        const errors = ref({});
        const pathologyCategoryEditView = async () => {
            try {
                const response = await axios.get(`/api/auth/pathology-category/editdata/${pathology_category_id.value}`,
                    {
                        headers: {
                            Authorization: `Bearer ${access_token.value}`,
                        },
                    }
                );
                if (response.data && response.status === 200) {
                    form.value.id = response.data.id;
                    form.value.name = response.data.name;
                    form.value.status = response.data.status;
                }
            } catch (error) {
                console.log(error.response);
            }
        };
        const pathologyCategoryEdit = async () => {
            try {
                const response = await axios.post("/api/auth/pathology-category/edit", form.value, {
                    headers: {
                        Authorization: `Bearer ${access_token.value}`,
                    },
                });
                if (response.data && response.status === 200) {
                    Swal.fire({
                        title: response.data.message,
                        icon: "success",
                        draggable: true,
                    });
                    form.value.id = '';
                    form.value.name = '';
                    form.value.status = '';
                    router.push({ name: "Category" })
                }
            } catch (error) {
                if (error.response && error.response.status === 422) {
                    errors.value = error.response.data.errors;
                } else {
                    console.error('Something went wrong:', error);
                }
            }
        }
        onMounted(async () => {
            access_token.value = Cookies.get("access_token");
            pathology_category_id.value = route.params.id;
            pathologyCategoryEditView();
        });
        return {
            form,
            errors,
            pathologyCategoryEdit
        }
    }
}
</script>

<style></style>
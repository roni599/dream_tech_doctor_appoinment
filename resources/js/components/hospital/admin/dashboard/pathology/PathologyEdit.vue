<template>
    <router-link to="/pathology" class="btn btn-primary w-100 mb-2">
        <i class="fa-solid fa-list"></i> Pathology List</router-link>
    <div class="d-flex justify-content-center align-items-center">
        <div class="card w-100" style="max-width: 1230px">
            <div class="card-header mt-2">
                <h5 class="card-title">Pathology Edit</h5>
            </div>
            <div class="card-body">
                <form @submit.prevent="pathologyEdit">
                    <div class="row form-section mb-2">
                        <div class="col-md-12">
                            <label for="department" class="form-label mb-0">Pathology Name</label>
                            <input type="text" v-model="form.name" class="form-control" id="reg-number">
                            <div v-if="errors.name" class="text-danger">{{ errors.name[0] }}</div>
                        </div>
                    </div>
                    <div class="row form-section mb-2">
                        <div class="col-md-12">
                            <label for="department" class="form-label mb-0">Price</label>
                            <input type="number" v-model="form.price" class="form-control" id="reg-number">
                            <div v-if="errors.price" class="text-danger">{{ errors.price[0] }}</div>
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
    name: "PathologyEdit",
    setup() {
        const router = useRouter();
        const route = useRoute();
        const access_token = ref('');
        const pathology_id = ref('');
        const form = ref({
            id: '',
            name: '',
            price: '',
            status: '',
        });
        const errors = ref({});
        const pathologyEditView = async () => {
            try {
                const response = await axios.get(`/api/auth/pathology/editdata/${pathology_id.value}`,
                    {
                        headers: {
                            Authorization: `Bearer ${access_token.value}`,
                        },
                    }
                );
                if (response.data && response.status === 200) {
                    form.value.id = response.data.id;
                    form.value.name = response.data.name;
                    form.value.price = response.data.price;
                    form.value.status = response.data.status;
                }
            } catch (error) {
                console.log(error.response);
            }
        };
        const pathologyEdit = async () => {
            try {
                const response = await axios.post("/api/auth/pathology/edit", form.value, {
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
                    form.value.price = '';
                    form.value.status = '';
                    router.push({ name: "Pathology" })
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
            pathology_id.value = route.params.id;
            pathologyEditView();
        });
        return {
            form,
            errors,
            pathologyEdit
        }
    }
}
</script>

<style></style>
<template>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3 w-100">
            <div class="d-flex w-100 mb-2 mb-sm-0">
                <router-link to="/pathology-category-create" class="btn btn-primary ms-2">
                    + Create Pathology-Category
                </router-link>
            </div>
        </div>
        <div class="allFeature">
            <div class="row mb-1">
                <div class="col-md-12 mb-3">
                    <label for="department" class="form-label mb-0">Pathology-Category-Name</label>
                    <select id="department-category" class="form-select">
                        <option value="" selected>Choose...</option>
                        <option value="">One</option>
                    </select>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>Sl No</th>
                            <th>Pathology-Category-Name</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(pathology_category, index) in pathology_categories" :key="pathology_category.id">
                            <td>{{ index + 1 }}</td>
                            <td>{{ pathology_category.name }}</td>
                            <td>
                                <span class="badge bg-success text-center"
                                    v-if="pathology_category.status === 1">Active</span>
                                <span class="badge bg-danger text-center" v-else>Inactive</span>
                            </td>
                            <td class="">
                                <router-link :to="{ name: 'CategoryEdit', params: { id: pathology_category.id } }"
                                    class="btn btn-outline-warning btn-sm me-2">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </router-link>
                                <button class="btn btn-outline-danger btn-sm"
                                    @click="deletePathologyCategory(pathology_category.id)">
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
import { onMounted, ref } from 'vue';
import Cookies from 'js-cookie';
export default {
    name: "Category",
    setup() {
        const access_token = ref('');
        const pathology_categories = ref([]);
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
        const deletePathologyCategory = async (id) => {
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
                        const response = await axios.post('/api/auth/pathology-category/delete', { id }, {
                            headers: {
                                'Authorization': `Bearer ${access_token.value}`
                            }
                        })
                        if (response.data && response.status === 201) {
                            fetchPathologyCategories()
                            Swal.fire({
                                title: response.data,
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
        onMounted(async () => {
            access_token.value = Cookies.get('access_token');
            await fetchPathologyCategories();
        })
        return {
            pathology_categories,
            deletePathologyCategory
        }
    }
}
</script>

<style></style>
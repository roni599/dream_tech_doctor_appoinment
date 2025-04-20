<template>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3 w-100">
            <div class="d-flex w-100 mb-2 mb-sm-0">
                <router-link to="/pathology-create" class="btn btn-primary ms-2">
                    + Create Pathology
                </router-link>
            </div>
        </div>
        <div class="allFeature">
            <div class="row mb-1">
                <div class="col-md-12 mb-3">
                    <label for="department" class="form-label mb-0">Pathology Name</label>
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
                            <th>Pathology Name</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(pathology, index) in pathologies" :key="pathology.id">
                            <td>{{ index + 1 }}</td>
                            <td>{{ pathology.name }}</td>
                            <td>{{ pathology.price }}</td>
                            <td>
                                <span class="badge bg-success text-center" v-if="pathology.status === 1">Active</span>
                                <span class="badge bg-danger text-center" v-else>Inactive</span>
                            </td>
                            <td class="">
                                <router-link :to="{ name: 'PathologyEdit', params: { id: pathology.id } }"
                                    class="btn btn-outline-warning btn-sm me-2">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </router-link>
                                <button class="btn btn-outline-danger btn-sm" @click="deletePathology(pathology.id)">
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
import { ref, onMounted } from 'vue';
import Cookies from 'js-cookie';
export default {
    name: "Pathology",
    setup() {
        const access_token = ref('');
        const pathologies = ref([]);
        const fetchPathology = async () => {
            try {
                const response = await axios.get('/api/auth/pathology', {
                    headers: {
                        'Authorization': `Bearer ${access_token.value}`
                    }
                });
                if (response.data && response.status === 200) {
                    pathologies.value = response.data;
                }
            } catch (error) {
                console.log(error)
            }
        }
        const deletePathology = async (id) => {
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
                        const response = await axios.post('/api/auth/pathology/delete', { id }, {
                            headers: {
                                'Authorization': `Bearer ${access_token.value}`
                            }
                        })
                        console.log(response)
                        if (response.data && response.status === 201) {
                            fetchPathology()
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
            await fetchPathology();
        })
        return {
            pathologies,
            deletePathology
        }
    }
}
</script>

<style scoped></style>
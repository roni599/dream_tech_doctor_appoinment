<template>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3 w-100">
            <div class="d-flex w-100 mb-2 mb-sm-0">
                <router-link to="/department-category-create" class="btn btn-primary ms-2">
                    + Create Department-Category
                </router-link>
            </div>
        </div>
        <div class="allFeature">
            <div class="row mb-1">
                <div class="col-md-12 mb-3">
                    <label for="department" class="form-label mb-0">Department-Category</label>
                    <select id="department-category" v-model="department_category" class="form-select">
                        <option value="" selected>Choose...</option>
                        <option v-for="department in departments" :key="department.id"
                            :value="department.department_category">{{ department.department_category }}</option>
                    </select>
                </div>
            </div>
            <div v-for="department in filteredDepartments" :key="department.id" class="list-group">
                <div class="doctor-card d-flex justify-content-between align-items-center p-3">
                    <span>
                        {{ department.department_category }}
                    </span>
                    <div class="d-flex ms-auto">
                        <router-link :to="{ name: 'DepartmentEdit', params: { id: department.id } }"
                            class="btn btn-outline-warning me-2">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </router-link>
                        <button class="btn btn-outline-danger" @click="deleteDepartment(department.id)">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { computed, onMounted, ref } from 'vue';
import Cookies from 'js-cookie';
import axios from 'axios';
export default {
    name: "Department",
    setup() {
        const access_token = ref('');
        const departments = ref([]);
        const department_category = ref('');


        const filteredDepartments = computed(() => {
            return departments.value.filter(department =>
                department.department_category.toLowerCase().includes(department_category.value.toLowerCase())
            );
        });


        const fetchDepartment = async () => {
            try {
                const response = await axios.get('/api/auth/department', {
                    headers: {
                        'Authorization': `Bearer ${access_token.value}`
                    }
                });
                if (response.data && response.status === 200) {
                    departments.value = response.data;
                }
            } catch (error) {
            }
        }
        const deleteDepartment = async (id) => {
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
                        const response = await axios.post('/api/auth/department/departmentdelete', { id }, {
                            headers: {
                                'Authorization': `Bearer ${access_token.value}`
                            }
                        })
                        if (response.data && response.status === 200) {
                            fetchDepartment();
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
            fetchDepartment();
        })
        return {
            departments,
            deleteDepartment,
            filteredDepartments,
            department_category
        }
    }
}
</script>

<style scoped>
.doctor-card {
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin-bottom: 10px;
    padding: 10px;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
}

.doctor-card {
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin-bottom: 10px;
    padding: 10px;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
}

.doctor-card ul li {
    text-decoration: none;
    list-style: none;
}

@media (max-width: 768px) {
    .doctor-card {
        flex-direction: column;
        align-items: flex-start;
        text-align: left;
    }

    .doctor-avatar {
        margin-bottom: 10px;
    }

    .d-flex.align-items-center {
        flex-direction: row;
        flex-wrap: wrap;
        width: 100%;
        gap: 5px;
    }
}
</style>
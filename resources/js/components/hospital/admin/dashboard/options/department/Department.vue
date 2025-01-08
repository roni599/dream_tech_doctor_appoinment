<template>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3 w-100">
            <div class="d-flex w-100 mb-2 mb-sm-0">
                <button @click="anotherLoad" class="btn btn-primary">
                    <i class="fa-solid fa-list"></i><span class="ms-2">Department-Category</span>
                </button>
                <button @click="componentLoad('DepartmentCreate')" class="btn btn-primary ms-2">
                    + Create Department-Category
                </button>
            </div>
        </div>
        <div v-show="!currentComponent" class="allFeature">
            <div class="row mb-1">
                <div class="col-md-12 mb-3">
                    <label for="department" class="form-label mb-0">Department-Category</label>
                    <select id="department" class="form-select">
                        <option value="" selected>Choose...</option>
                    </select>
                </div>
            </div>
            <div v-for="department in departments" :key="department.id" class="list-group">
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
    <component :is="currentComponent"></component>
</template>

<script>
import { markRaw, onMounted, ref, shallowRef } from 'vue';
import Cookies from 'js-cookie';
import DepartmentCreate from './DepartmentCreate.vue';
import axios from 'axios';
export default {
    name: "Department",
    setup() {
        const access_token = ref('');
        const currentComponent = shallowRef(null);
        const departments = ref([]);
        const componentLoad = (componentvalue) => {
            if (componentvalue === "DepartmentCreate") {
                currentComponent.value = markRaw(DepartmentCreate);
            }
        };
        const anotherLoad = () => {
            currentComponent.value = null;
            fetchDepartment();
        };
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
            currentComponent,
            componentLoad,
            anotherLoad,
            departments,
            deleteDepartment
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
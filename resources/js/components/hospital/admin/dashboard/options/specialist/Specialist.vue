<template>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3 w-100">
            <div class="d-flex w-100 mb-2 mb-sm-0">
                <router-link to="/specialist-create" class="btn btn-primary ms-2">
                    + Create Specialist
                </router-link>
            </div>
        </div>
        <div class="allFeature">
            <div class="row mb-1">
                <div class="col-md-12 mb-3">
                    <label for="department" class="form-label mb-0">Specialist</label>
                    <select id="specialist" v-model="specialist_search" class="form-select">
                        <option value="" selected>Choose...</option>
                        <option v-for="symtom in specialists" :key="symtom.id" :value="symtom.specialist">{{
                            symtom.specialist }}.</option>
                    </select>
                </div>
            </div>

            <div v-for="symtom in filteredSpecialist" :key="symtom.id" class="list-group">
                <div class="doctor-card d-flex justify-content-between align-items-center p-3">
                    <span>
                        {{ symtom.specialist }}
                    </span>
                    <div class="d-flex ms-auto">
                        <router-link :to="{ name: 'SpecialistEdit', params: { id: symtom.id } }"
                            class="btn btn-outline-warning me-2">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </router-link>
                        <button class="btn btn-outline-danger" @click="deleteSpecialist(symtom.id)">
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
import axios from 'axios';
import Cookies from 'js-cookie';
export default {
    name: "Specialist",
    setup() {
        const access_token = ref('');
        const specialists = ref([]);
        const specialist_search = ref('');

        const filteredSpecialist = computed(() => {
            return specialists.value.filter(specialist =>
            specialist.specialist.toLowerCase().includes(specialist_search.value.toLowerCase())
            );
        });



        const fetchSpecialist = async () => {
            try {
                const response = await axios.get('/api/auth/specialist', {
                    headers: {
                        'Authorization': `Bearer ${access_token.value}`
                    }
                });
                if (response.data && response.status === 200) {
                    specialists.value = response.data;
                }
            } catch (error) {
            }
        }

        const deleteSpecialist = async (id) => {
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
                        const response = await axios.post('/api/auth/specialist/specialistdelete', { id }, {
                            headers: {
                                'Authorization': `Bearer ${access_token.value}`
                            }
                        })
                        if (response.data && response.status === 200) {
                            fetchSpecialist();
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
            fetchSpecialist()
        })
        return {
            specialists,
            specialist_search,
            filteredSpecialist,
            deleteSpecialist
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
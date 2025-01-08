<template>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3 w-100">
            <div class="d-flex w-100 mb-2 mb-sm-0">
                <button @click="anotherLoad" class="btn btn-primary">
                    <i class="fa-solid fa-list"></i><span class="ms-2">Experience List</span>
                </button>
                <button @click="componentLoad('ExperienceCreate')" class="btn btn-primary ms-2">
                    + Create Experience
                </button>
            </div>
        </div>
        <div v-show="!currentComponent" class="allFeature">
            <div class="row mb-1">
                <div class="col-md-12 mb-3">
                    <label for="department" class="form-label mb-0">Experience</label>
                    <select id="department" class="form-select">
                        <option value="" selected>Choose...</option>
                    </select>
                </div>
            </div>
            <div v-for="symtom in experiences" :key="symtom.id" class="list-group">
                <div class="doctor-card d-flex justify-content-between align-items-center p-3">
                    <span>
                        {{ symtom.experience }}
                    </span>
                    <div class="d-flex ms-auto">
                        <router-link :to="{ name: 'ExperienceEdit', params: { id: symtom.id } }"
                            class="btn btn-outline-warning me-2">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </router-link>
                        <button class="btn btn-outline-danger" @click="deleteExperience(symtom.id)">
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
import ExperienceCreate from './ExperienceCreate.vue';
export default {
    name: "Experience",
    setup() {
        const access_token = ref('');
        const currentComponent = shallowRef(null);
        const experiences = ref([]);
        const componentLoad = (componentvalue) => {
            if (componentvalue === "ExperienceCreate") {
                currentComponent.value = markRaw(ExperienceCreate);
            }
        };
        const anotherLoad = () => {
            currentComponent.value = null;
            fetchExperience()
        };
        const fetchExperience = async () => {
            try {
                const response = await axios.get('/api/auth/experience', {
                    headers: {
                        'Authorization': `Bearer ${access_token.value}`
                    }
                });
                if (response.data && response.status === 200) {
                    experiences.value = response.data;
                }
            } catch (error) {
            }
        }
        const deleteExperience = async (id) => {
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
                        const response = await axios.post('/api/auth/experience/experiencedelete', { id }, {
                            headers: {
                                'Authorization': `Bearer ${access_token.value}`
                            }
                        })
                        if (response.data && response.status === 200) {
                            fetchExperience();
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
            fetchExperience()
        })
        return {
            currentComponent,
            componentLoad,
            anotherLoad,
            experiences,
            deleteExperience
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
<template>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3 w-100">
            <div class="d-flex w-100 mb-2 mb-sm-0">
                <button @click="anotherLoad" class="btn btn-primary">
                    <i class="fa-solid fa-list"></i><span class="ms-2">Symptom List</span>
                </button>
                <button @click="componentLoad('SymtomCreate')" class="btn btn-primary ms-2">
                    + Create Symptom
                </button>
            </div>
        </div>
        <div v-show="!currentComponent" class="allFeature">
            <div class="row mb-1">
                <div class="col-md-12 mb-3">
                    <label for="department" class="form-label mb-0">Symtom</label>
                    <select id="department" class="form-select">
                        <option value="" selected>Choose...</option>
                    </select>
                </div>
            </div>
            <div v-for="symtom in symtoms" :key="symtom.id" class="list-group">
                <div class="doctor-card d-flex justify-content-between align-items-center p-3">
                    <span>
                        {{ symtom.symptom }}
                    </span>
                    <div class="d-flex ms-auto">
                        <router-link :to="{ name: 'SymtomEdit', params: { id: symtom.id } }"
                            class="btn btn-outline-warning me-2">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </router-link>
                        <button class="btn btn-outline-danger" @click="deleteSymtom(symtom.id)">
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
import { markRaw, onBeforeMount, onMounted, ref, shallowRef } from 'vue';
import SymtomCreate from './SymtomCreate.vue';
import Cookies from 'js-cookie';
import axios from 'axios';
export default {
    name: "Symtom",
    setup() {
        const currentComponent = shallowRef(null);
        const access_token = ref('');
        const symtoms = ref([]);
        const componentLoad = (componentvalue) => {
            if (componentvalue === "SymtomCreate") {
                currentComponent.value = markRaw(SymtomCreate);
            }
        };
        const fetchSymtom = async () => {
            try {
                const response = await axios.get('/api/auth/symptoms', {
                    headers: {
                        'Authorization': `Bearer ${access_token.value}`
                    }
                });
                if (response.data && response.status === 200) {
                    symtoms.value = response.data;
                }
            } catch (error) {
                console.log(error.response)
            }
        }
        const anotherLoad = () => {
            currentComponent.value = null;
            fetchSymtom()
        };
        const deleteSymtom = async (id) => {
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
                        const response = await axios.post('/api/auth/symtom/symtomdelete', { id }, {
                            headers: {
                                'Authorization': `Bearer ${access_token.value}`
                            }
                        })
                        if (response.data && response.status === 200) {
                            fetchSymtom();
                            Swal.fire({
                                title: response.data.message,
                                icon: "success",
                                draggable: true
                            });
                        }
                    } catch (error) {
                        console.error(error.response.data.error);
                    }
                }
            });
        }
        onBeforeMount(() => {
            access_token.value = Cookies.get('access_token');
        })
        onMounted(() => {
            fetchSymtom();
        })
        return {
            currentComponent,
            componentLoad,
            anotherLoad,
            symtoms,
            deleteSymtom
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
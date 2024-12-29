<template>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3 w-100">
            <div class="d-flex w-100 mb-2 mb-sm-0">
                <button @click="anotherLoad" class="btn btn-primary">
                    <i class="fa-solid fa-list"></i><span class="ms-2">Doctor List</span>
                </button>
                <button @click="componentLoad('DoctorCreate')" class="btn btn-primary ms-2">
                    + Create Doctor
                </button>
            </div>
            <div class="d-flex w-100 justify-content-end">
                <button @click="componentLoad('DoctorActive')" class="btn btn-success me-2">
                    Active
                </button>
                <button @click="componentLoad('DoctorInactive')" class="btn btn-secondary">
                    Inactive
                </button>
            </div>
        </div>
        <div v-show="!currentComponent" class="allFeature">
            <div class="row mb-3">
                <div class="col-md-6 mb-3">
                    <label for="department" class="form-label">Department/Category</label>
                    <select id="department" class="form-select">
                        <option value="" selected>Choose...</option>
                        <option value="1">Cardiology</option>
                        <option value="2">Neurology</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="doctor" class="form-label">Doctor</label>
                    <select id="doctor" class="form-select">
                        <option value="" selected>Choose...</option>
                        <option value="1">Dr. Jasim</option>
                        <option value="2">Dr. Rahman</option>
                    </select>
                </div>
            </div>
            <div v-for="doctor in doctors" :key="doctor.id" class="list-group">
                <div class="doctor-card d-flex align-items-center">
                    <div class="doctor-avatar me-3">
                        <img :src="doctor.signature_image" alt="" width="60px" height="60px" />
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="mb-1">{{ doctor.doctorName }}</h5>
                        <p class="mb-0 text-muted">{{ doctor.deparment_category }}</p>
                    </div>
                    <div class="d-flex align-items-center">
                        <router-link to="/doctor_view" class="btn btn-outline-primary me-2">
                            <i class="fa-solid fa-eye"></i>
                        </router-link>
                        <button class="btn btn-outline-warning me-2">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <button class="btn btn-outline-danger me-2" @click="deleteDoctor(doctor.id)">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                        <div class="dropdown">
                            <select class="form-select border border-success text-success custom-select"
                                aria-label="Status select" v-model="doctor.status"
                                @change="updateStatus(doctor.id, doctor.status)">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <component :is="currentComponent"></component>
</template>

<script>
import { ref, reactive, shallowRef, markRaw, onMounted } from "vue";
import DoctorCreate from "./DoctorCreate.vue";
import DoctorActive from "./DoctorActive.vue";
import DoctorInactive from "./DoctorInactive.vue";
import axios from "axios";

export default {
    name: "Doctor-vue",
    setup() {
        const currentComponent = shallowRef(null);
        const doctors = ref([]);

        const componentLoad = (componentvalue) => {
            if (componentvalue === "DoctorCreate") {
                currentComponent.value = markRaw(DoctorCreate);
            } else if (componentvalue === "DoctorActive") {
                currentComponent.value = markRaw(DoctorActive);
            } else if (componentvalue === "DoctorInactive") {
                currentComponent.value = markRaw(DoctorInactive);
            }
        };
        const anotherLoad = () => {
            currentComponent.value = null;
            fetchDoctor()
        };

        const fetchDoctor = async () => {
            try {
                const response = await axios.get("/api/auth/hospital-doctor");
                if (response.data && response.status === 200) {
                    doctors.value = response.data;
                }
            } catch (error) {
                console.log(error)
            }
        };


        const updateStatus = async (doctorId, status) => {
            try {
                const response = await axios.post("/api/auth/hospital-doctor/change-status", {
                    doctorId,
                    status: status === "0" ? 0 : 1,
                });
                if (response.data && response.data.message && response.status === 201) {
                    fetchDoctor();
                    Swal.fire({
                        title: response.data.message,
                        icon: "success",
                        draggable: true
                    });
                }
            } catch (error) {
                console.error("Error updating status:", error);
            }
        };
        const deleteDoctor = async (doctorId) => {
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
                        const response = await axios.post('/api/auth/hospital-doctor/delete-doctor', {
                            doctorId
                        })
                        if (response.data && response.data.message && response.status === 200) {
                            fetchDoctor();
                            Swal.fire({
                                title: response.data.message,
                                icon: "success",
                                draggable: true
                            });
                        }
                    } catch (error) {
                        console.error("Error updating status:", error);
                    }
                }
            });
        }
        onMounted(async () => {
            await fetchDoctor();
        });
        return {
            currentComponent,
            componentLoad,
            anotherLoad,
            fetchDoctor,
            doctors,
            updateStatus,
            deleteDoctor
        };
    },
};
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

.doctor-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background-color: #e0e0e0;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 24px;
    color: #6c757d;
    overflow: hidden;
}

.doctor-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}

.status-dropdown {
    min-width: 120px;
}

.custom-select {
    font-size: 14px;
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

    .d-flex.align-items-center button,
    .d-flex.align-items-center .dropdown {
        flex: 1 0 auto;
        margin-bottom: 0;
    }
}
</style>
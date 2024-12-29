<template>
    <div class="container">
        <!-- Check if doctors array is empty -->
        <div v-if="doctors.length  === 0" class="alert alert-info text-center">
            All doctors are inactive.So Go doctor list and active doctor
        </div>

        <!-- Render doctors if the array is not empty -->
        <div v-else>
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
                        <button class="btn btn-outline-primary me-2">
                            <i class="fa-solid fa-eye"></i>
                        </button>
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

</template>

<script>
import { onMounted, ref } from 'vue';
export default {
    name: 'DoctorActive',
    setup() {
        const currentComponent = ref(false);
        const doctors = ref([]);
        const fetchDoctor = async () => {
            const response = await axios.get("/api/auth/hospital-doctor/active-doctor");
            if (response.data && response.status===200) {
                doctors.value = response.data;
            }
        };
        onMounted(async () => {
            await fetchDoctor();
        });
        return {
            currentComponent,
            doctors,
            fetchDoctor
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
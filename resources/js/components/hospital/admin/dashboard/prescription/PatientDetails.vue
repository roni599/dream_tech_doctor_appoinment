<template>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center text-muted">Patient Details</h3>
                <div class="addPrescriptionbutton  d-flex justify-content-end ">
                    <router-link class="btn btn-primary mb-2"
                        :to="{ path: '/prescription', query: { id: patientId } }">
                        Add Prescription
                    </router-link>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead class="table-primary">
                            <tr>
                                <th>S.L No</th>
                                <th>Patient Name</th>
                                <th>Gender</th>
                                <th>Age</th>
                                <th>Previous Prescription</th>
                                <th>Previous Report</th>
                                <th>New Report</th>
                                <th>Description</th>
                                <th>Clarence</th>
                                <th>Create Prescription</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-if="PatientPrescription.length > 0">
                                <tr v-for="(item, index) in PatientPrescription" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ item.appointment.patient_name }}</td>
                                    <td>{{ item.appointment.gender }}</td>
                                    <td>{{ item.appointment.age }}</td>
                                    <td><button class="btn btn-info"><i class="fa-solid fa-eye"></i></button></td>
                                    <td><button class="btn btn-info"><i class="fa-solid fa-eye"></i></button></td>
                                    <td><button class="btn btn-info"><i class="fa-solid fa-eye"></i></button></td>
                                    <td><button class="btn btn-info"><i class="fa-solid fa-eye"></i></button></td>
                                    <td class="bg-success text-white">Paid</td>
                                    <td>
                                        <button class="btn btn-info"><i class="fa-solid fa-eye"></i></button>
                                        <button class="btn btn-primary ms-2"><i class="fa-solid fa-edit"></i></button>
                                        
                                    </td>
                                </tr>
                            </template>
                            <template v-else>
                                <tr>
                                    <td colspan="10">No Previous Data For This Patient</td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { onMounted, ref } from "vue";
import { useRouter, useRoute } from "vue-router";
import axios from "axios";
import Cookies from "js-cookie";
import PatientPrescription from "./PatientPrescription.vue";
export default {
    name: 'PatientDetails',
    setup() {
        const router = useRouter();
        const route = useRoute();
        const access_token = ref('');
        const patientId = ref('');
        const patientPhone = ref('');
        const PatientPrescription = ref([]);

        const findPrescription = async () => {
            try {
                const response = await axios.get('/api/auth/doctor/patient/prescription/find', {
                    params: { phone: patientPhone.value },
                    headers: {
                        'Authorization': `Bearer ${access_token.value}`
                    }
                });
                if (response.data && response.status === 200) {
                    console.log(response.data)
                    PatientPrescription.value = response.data
                }
            } catch (error) {
                console.error(error);
            }
        }

        onMounted(async () => {
            patientId.value = route.query.id;
            patientPhone.value = route.query.patient_phone;
            access_token.value = Cookies.get('access_token');
            await findPrescription();
        })
        return {
            PatientPrescription,
            patientId
        }
    }
}
</script>

<style scoped>
.fixed-bottom-buttons {
    position: fixed;
    bottom: 10px;
    right: 10px;
    background: white;
    padding: 10px;
    z-index: 1000;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

@media (max-width: 576px) {
    .fixed-bottom-buttons {
        width: 100%;
        text-align: center;
        bottom: 0;
        right: 0;
        padding: 10px 0;
    }

    .fixed-bottom-buttons button {
        width: 45%;
    }
}
</style>
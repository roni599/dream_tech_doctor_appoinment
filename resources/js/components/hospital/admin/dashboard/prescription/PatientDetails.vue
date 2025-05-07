<template>
    <div class="container" v-show="!currentComponent">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center text-muted">Patient Details</h3>
                <div class="addPrescriptionbutton  d-flex justify-content-end ">
                    <!-- <router-link class="btn btn-primary mb-2" to="/patient-list">
                        Patient List
                    </router-link> -->
                    <router-link class="btn btn-primary mb-2" :to="{ path: '/prescription', query: { id: patientId } }">
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-if="PatientPrescription.length > 0">
                                <tr v-for="(item, index) in PatientPrescription" :key="index">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ item.appointment.patient_name }}</td>
                                    <td>{{ item.appointment.gender }}</td>
                                    <td>{{ item.appointment.age }}</td>
                                    <td><button class="btn btn-info" @click="previousPrescription(item.id)"><i
                                                class="fa-solid fa-eye"></i></button></td>
                                    <td><button class="btn btn-info" @click="previousReport(item.id)"><i
                                                class="fa-solid fa-eye"></i></button></td>
                                    <td><button class="btn btn-info" @click="newReport(item.id)"><i
                                                class="fa-solid fa-eye"></i></button></td>
                                    <td><button class="btn btn-info" @click="descriptionDetails(item.id)"><i
                                                class="fa-solid fa-eye"></i></button></td>
                                    <td class="bg-success text-white">Paid</td>
                                    <td>
                                        <router-link :to="{ path: '/prescription-edit', query: { id: item.id } }"
                                            class="btn btn-primary ms-2">
                                            <i class="fa-solid fa-edit"></i>
                                        </router-link>
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
    <component v-if="currentComponent && prescriptionData" :is="currentComponent" :prescriptionData="prescriptionData"
        @loadComponent="loadComponent"></component>
</template>

<script>
import { onMounted, ref, shallowRef, markRaw, nextTick, } from "vue";
import { useRouter, useRoute } from "vue-router";
import axios from "axios";
import Cookies from "js-cookie";
import PrintPrescription from "./PrintPrescription.vue";
export default {
    name: 'PatientDetails',
    setup() {
        const router = useRouter();
        const route = useRoute();
        const currentComponent = shallowRef(null);
        const access_token = ref('');
        const patientId = ref('');
        const patientPhone = ref('');
        const PatientPrescription = ref([]);
        const prescriptionData = ref({});

        const fethchPrescriptionPatient = async () => {
            try {
                const response = await axios.get('/api/auth/doctor/patient/prescription/find', {
                    params: { phone: patientPhone.value },
                    headers: {
                        'Authorization': `Bearer ${access_token.value}`
                    }
                });
                if (response.data && response.status === 200) {
                    PatientPrescription.value = response.data
                }
            } catch (error) {
                console.error(error);
            }
        }

        const previousPrescription = async (id) => {
            try {
                const response = await axios.get('/api/auth/doctor/patient/prescriptionpatient', {
                    params: { id: id },
                    headers: {
                        'Authorization': `Bearer ${access_token.value}`
                    }
                });
                console.log(response)
                if (response.data && response.status === 200) {
                    prescriptionData.value = response.data;
                    await nextTick();
                    currentComponent.value = markRaw(PrintPrescription);
                }
            } catch (error) {
                console.error(error);
            }
        }
        const previousReport = (id) => {
            Swal.fire({
                title: 'Under Development',
                icon: "success",
                draggable: true,
            });
        }
        const newReport = (id) => {
            Swal.fire({
                title: 'Under Development',
                icon: "success",
                draggable: true,
            });
        }
        const descriptionDetails = (id) => {
            Swal.fire({
                title: 'Under Development',
                icon: "success",
                draggable: true,
            });
        }
        const loadComponent = () => {
            router.push({ 
                name: 'PatientDetails',
                query: { 
                    id: patientId.value,
                    patient_phone: patientPhone.value 
                }
            });
            currentComponent.value = null;
        };

        onMounted(async () => {
            patientId.value = route.query.id;
            patientPhone.value = route.query.patient_phone;
            console.log(patientId.value)
            access_token.value = Cookies.get('access_token');
            await fethchPrescriptionPatient();
        })
        return {
            PatientPrescription,
            patientId,
            previousPrescription,
            previousReport,
            newReport,
            descriptionDetails,
            currentComponent,
            loadComponent,
            prescriptionData
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
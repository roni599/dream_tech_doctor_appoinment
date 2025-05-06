<template>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="text-center text-muted mb-2">Today Patient Appoinment List</h5>
                <h6 class="text-muted mb-2 text-center">Date : {{ today }}</h6>
                <div class="mb-3 d-flex justify-content-between gap-3 w-100">
                    <div class="w-100">
                        <input type="text" v-model="patient_search.email_phone" class="form-control w-100"
                            placeholder="Patient Email / Phone" @input="AppoinmentPatientFetch" />
                    </div>
                    <!-- <div class="w-100">
                        <input type="date" v-model="patient_search.date" class="form-control w-100"
                            placeholder="Select Date" @input="AppoinmentPatientFetch" />
                    </div> -->
                </div>


                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th rowspan="2" style="height: 30px; background-color: #1d93d2; color:white">S.L No</th>
                                <th rowspan="2" style="height: 30px; background-color: #1d93d2; color:white">Patient
                                    Name</th>
                                <th rowspan="2" style="height: 30px; background-color: #1d93d2; color:white">Patient
                                    Email / Phone</th>
                                <th rowspan="2" style="height: 30px; background-color: #1d93d2; color:white">Age</th>
                                <th rowspan="2" style="height: 30px; background-color: #1d93d2; color:white">Gender</th>
                                <th rowspan="2" style="height: 30px; background-color: #1d93d2; color:white">Visit Time
                                </th>
                                <th rowspan="2" style="height: 30px; background-color: #1d93d2; color:white">Visit Fee
                                </th>
                                <th rowspan="2" style="height: 30px; background-color: #1d93d2; color:white">Payment
                                    Status</th>
                                <th colspan="2"
                                    style="height: 30px; background-color: #1d93d2; color:white;text-align: center;">
                                    Narration</th>
                                <th rowspan="2" style="height: 30px; background-color: #1d93d2; color:white">Reference
                                </th>
                                <th rowspan="2" style="height: 30px; background-color: #1d93d2; color:white">Appoint By
                                </th>
                                <th rowspan="2" style="height: 30px; background-color: #1d93d2; color:white">Action</th>
                            </tr>
                            <tr>
                                <th style="height: 30px; background-color: #1d93d2; color:white">Discount</th>
                                <th style="height: 30px; background-color: #1d93d2; color:white;text-align: center;">
                                    Narration <br> ( Discount or Free )</th>
                            </tr>
                        </thead>

                        <tbody v-if="patientList.length === 0">
                            <tr>
                                <td colspan="13" class="text-center text-black">No data found</td>
                            </tr>
                        </tbody>

                        <tbody v-else>
                            <tr v-for="(patient, index) in patientList" :key="patient.id">
                                <td>{{ index + 1 }}</td>
                                <td>{{ patient.patient_name }}</td>
                                <td>{{ patient.patient_mobile }}</td>
                                <td>{{ patient.age }}</td>
                                <td>{{ patient.gender }}</td>
                                <td>{{ patient.visit_time }}</td>
                                <td>{{ patient.fee }}</td>
                                <td>{{ patient.payment_status }}</td>
                                <td>
                                    <template v-if="patient.payment_status === 'Discount'">
                                        {{ Math.floor(patient.amount) }}% (Discount)
                                    </template>
                                    <template v-else-if="patient.payment_status === 'Free'">
                                        {{ Math.floor(patient.amount) }}% (Free)
                                    </template>
                                    <template v-else-if="patient.payment_status === 'Paid'">
                                        -
                                    </template>
                                    <template v-else>
                                        {{ Math.floor(patient.amount) }} ({{ patient.payment_status }})
                                    </template>
                                </td>
                                <td>
                                    <table>
                                        <tr>
                                            <td>{{ patient.discount_narration || patient.free_narration || '-' }}</td>
                                        </tr>
                                    </table>
                                </td>
                                <td>{{ patient.reference?.name || '-' }}</td>
                                <td>{{ patient.appointby }}</td>
                                <td class="text-center text-info" style="cursor: pointer;">
                                    <router-link :to="{
                                        path: '/patient-details',
                                        query: { id: patient.id ,
                                            patient_phone:patient.patient_mobile 
                                        }
                                    }">
                                        <i class="fa-solid fa-eye"></i>
                                    </router-link>
                                </td>
                            </tr>
                        </tbody>

                    </table>

                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary me-2">Download PDF</button>
                    <button class="btn btn-primary">Print</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { onMounted, ref } from 'vue';
import axios from "axios";
import Cookies from "js-cookie";
export default {
    name: 'PatientPrescription',
    setup() {
        const access_token = ref('');
        const patientList = ref([]);
        const today = ref(new Date().toISOString().split('T')[0]);
        const patient_search = ref({
            email_phone: '',
            date: today.value,
        })

        const AppoinmentPatientFetch = async () => {
            try {
                const response = await axios.get('/api/auth/doctor-appoinment-prescription-patient', {
                    params: patient_search.value,
                    headers: {
                        'Authorization': `Bearer ${access_token.value}`
                    }
                });
                console.log(response);
                if (response.data && response.status === 200) {
                    patientList.value = response.data;
                }
            } catch (error) {
                console.error(error);
            }
        }

        onMounted(async () => {
            access_token.value = Cookies.get('access_token');
            AppoinmentPatientFetch();
        });

        return {
            today,
            patientList,
            patient_search,
            AppoinmentPatientFetch
        }
    }
}
</script>

<style scoped></style>
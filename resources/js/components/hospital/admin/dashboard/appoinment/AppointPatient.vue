<template>
    <div class="container">
        <div
            class="header-buttons d-flex flex-wrap justify-content-start justify-content-center justify-content-md-start mb-2">
            <!-- <router-link to="/appoinment-list" class="btn btn-info text-white mb-2">All Appoinment</router-link>
            <router-link to="/appoinment-details" class="btn btn-info text-white mb-2">New Appoinment</router-link>
            <router-link to="/appoinment-report" class="btn btn-info text-white mb-2">Appoinment Report</router-link>
            <router-link to="/doctor-visit" class="btn btn-info text-white mb-2">Doctor Visit</router-link> -->
            <router-link to="/appoinment-list" class="btn btn-info text-white mb-2">Appoinment
                List</router-link>
            <router-link to="/new-appoinment" class="btn btn-info text-white mb-2">New Appoinment</router-link>
            <router-link to="/appoinment-report" class="btn btn-info text-white mb-2">Appoinment
                Report</router-link>
            <router-link to="/doctor-appoinment-report" class="btn btn-info text-white mb-2">Doctor
                Appoinment
                Report</router-link>
            <router-link to="/doctor-visit" class="btn btn-info text-white mb-2">Doctor Visit</router-link>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="text-center">Doctorwise Booked Appoinment Report</h5>
                <!-- <div
                    class="filters d-flex flex-column flex-sm-row justify-content-center gap-3 align-items-center mb-4 my-3">
                    <div class="filter-item">
                        <label for="patientMobile" class="form-label mb-0">Visit date</label>
                        <input type="date" class="form-control" v-model="visitDate" @change="searchAppointments" />
                    </div>
                    <div class="filter-item">
                        <label for="patientMobile" class="form-label mb-0">Department/Category</label>
                        <select class="form-select" aria-label="Department/Category" v-model="selectedDepartment"
                            @change="searchAppointments">
                            <option selected value="all">All</option>
                            <option v-for="department in departments" :key="department.id" :value="department.id">{{
                                department.department_category }}</option>
                        </select>
                    </div>
                    <div class="filter-item">
                        <label for="patientMobile" class="form-label mb-0">Doctor</label>
                        <select class="form-select" aria-label="Doctor" v-model="selectedDoctor"
                            @change="searchAppointments">
                            <option selected value="all">All</option>
                            <option v-for="doctor in doctors" :key="doctor.id" :value="doctor.id">{{
                                doctor.doctorName }}</option>
                        </select>
                    </div>
                </div> -->
                <div id="appointment-table" class="table-responsive" ref="table">
                    <div class="doctor_details" v-show="formattedVisitDate">
                        <span>{{ formattedVisitDate }}</span><br>
                        <span>{{ formattedData.department_category }}</span><br>
                        <span>{{ formattedData.doctor_name }}</span>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="height: 30px; background-color: #1d93d2; color:white">SL.NO
                                </th>
                                <th style="height: 30px; background-color: #1d93d2; color:white">Appoint Date</th>
                                <th style="height: 30px; background-color: #1d93d2; color:white">Appoint ID</th>
                                <th style="height: 30px; background-color: #1d93d2; color:white">Patient Name</th>
                                <th style="height: 30px; background-color: #1d93d2; color:white">Mobile/Mail</th>
                                <th style="height: 30px; background-color: #1d93d2; color:white">Gender</th>
                                <th style="height: 30px; background-color: #1d93d2; color:white">Age</th>
                                <th style="height: 30px; background-color: #1d93d2; color:white">Appoint</th>
                                <th style="height: 30px; background-color: #1d93d2; color:white">Visit Time</th>
                                <th style="height: 30px; background-color: #1d93d2; color:white">Payment</th>
                                <th style="height: 30px; background-color: #1d93d2; color:white">Payment user</th>
                                <th style="height: 30px; background-color: #1d93d2; color:white">Reference</th>
                                <th style="height: 30px; background-color: #1d93d2; color:white">Discount/Free Reference
                                </th>
                                <th style="height: 30px; background-color: #1d93d2; color:white">Visit</th>
                                <th style="height: 30px; background-color: #1d93d2; color:white">Action</th>
                            </tr>
                        </thead>
                        <tbody v-if="appoinments.length < 0">
                            <tr>
                                <td colspan="8" class="text-center text-black">No data found</td>
                            </tr>
                        </tbody>
                        <tbody v-else>
                            <tr v-for="appoinment in appoinments" :key="appoinment.id">
                                <td>{{ appoinment.Sl_no }}</td>
                                <td>{{ appoinment.visit_date }}</td>
                                <td>{{ appoinment.appointby }}</td>
                                <td>{{ appoinment.patient_name }}</td>
                                <td>{{ appoinment.patient_mobile }}</td>
                                <td>{{ appoinment.gender }}</td>
                                <td>{{ appoinment.age }}</td>
                                <td>{{ appoinment.appointby }}</td>
                                <td>{{ appoinment.visit_time }}</td>
                                <td>{{ appoinment.payment_status }}</td>
                                <td>{{ appoinment.appointby }}</td>
                                <td>{{ appoinment.reference.name }}</td>
                                <td>
                                    <span
                                        v-if="appoinment.payment_status === 'Free' || appoinment.payment_status === 'Discount'">
                                        {{ appoinment.reference.name }}
                                    </span>

                                </td>
                                <td>{{ appoinment.status === 0 ? 'Yes' : 'No' }}</td>
                                <!-- <td class="text-end d-flex justify-content-around align-items-center">
                                    <span class="text-info d-block d-md-inline" style="cursor: pointer;" title="Show"><i
                                            class="fa-solid fa-eye"></i></span>
                                    <span class="text-info d-block d-md-inline ms-md-1" title="edit"
                                        style="cursor: pointer;"><i
                                            class="fa-solid fa-pen-to-square"></i></span>
                                </td> -->
                                <td class="text-end d-flex justify-content-around align-items-center">
                                    <span class="text-info d-block d-md-inline" style="cursor: pointer;" title="Show">
                                        <i class="fa-solid fa-eye"></i>
                                    </span>
                                    <span v-if="isTodayOrFuture(appoinment.visit_date)"
                                        class="text-info d-block d-md-inline ms-md-1" style="cursor: pointer;"
                                        title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div v-if="appoinments.length > 0"
                        class="button_group d-flex justify-content-end align-items-center gap-2">
                        <button class="btn btn-primary"
                            @click="downloadPDF(formattedData.hospitalName, formattedData.hospitalLogo)">Download
                            PDF</button>
                        <button class="btn btn-success"
                            @click="printDoctorWistReport(formattedData.hospitalName, formattedData.hospitalLogo, formattedVisitDate)">Print
                            Appointment Table</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { onMounted, ref, computed } from 'vue';
import axios from "axios";
import Cookies from "js-cookie";
import { useRouter, useRoute } from "vue-router";
export default {
    name: "AppointPatient",
    setup() {
        const router = useRouter();
        const route = useRoute();
        const access_token = ref('');
        const doctor_id = ref('');
        const visit_date = ref('');
        const department_id = ref('');
        const appoinments = ref([]);
        const formattedData = ref([]);
        const searchAppointments = async () => {
            try {
                const params = {
                    visit_date: visit_date.value,
                    selectedDepartment: department_id.value,
                    selectedDoctor: doctor_id.value
                };
                const response = await axios.post("/api/auth/appoinment/doctor/all-patient/search", params, {
                    headers: {
                        Authorization: `Bearer ${access_token.value}`,
                    },
                });
                console.log(response)
                if (response.data && response.status === 200) {
                    appoinments.value = response.data;
                    formattedData.value = response.data.reduce((acc, item) => {
                        acc.visit_date = item.visit_date;
                        acc.doctor_name = item.doctor.doctorName;
                        acc.hospitalName = item.user.hospital_name;
                        acc.hospitalLogo = item.user.logo;
                        acc.department_category = item.department_category.department_category;
                        return acc;
                    }, {});
                }
            } catch (error) {
                console.error("Error fetching appointments:", error);
            }
        };
        const formattedVisitDate = computed(() => {
            const date = new Date(formattedData.value.visit_date);
            if (isNaN(date)) {
                return '';
            }
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();
            return `${day}/${month}/${year}`;
        });
        onMounted(async () => {
            access_token.value = Cookies.get('access_token');
            doctor_id.value = route.params.doctor_id;
            visit_date.value = route.params.visit_date;
            department_id.value = route.params.department_id;
            await searchAppointments();
        })
        const isTodayOrFuture = (visitDate) => {
            const today = new Date();
            today.setHours(0, 0, 0, 0); 

            const date = new Date(visitDate); 
            date.setHours(0, 0, 0, 0);

            return date >= today;
        }
        return {
            isTodayOrFuture,
            doctor_id,
            appoinments,
            formattedData,
            formattedVisitDate
        }
    }
}
</script>

<style scoped></style>
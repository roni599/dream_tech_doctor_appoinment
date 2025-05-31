<template>
    <div class="container">
        <div
            class="header-buttons d-flex flex-wrap justify-content-start justify-content-center justify-content-md-start mb-2">
            <!-- <router-link to="/appoinment-list" class="btn btn-info text-white mb-2">All Appoinment</router-link>
            <router-link to="/appoinment-details" class="btn btn-info text-white mb-2">New Appoinment</router-link>
            <router-link to="/appoinment-doctor-report" class="btn btn-info text-white mb-2">Doctor Appoinment Report</router-link>
            <router-link to="/doctor-visit" class="btn btn-info text-white mb-2">Doctor Visit</router-link> -->
            <router-link to="/appoinment-list" class="btn btn-info text-white mb-2">Appoinment
                List</router-link>
            <router-link to="/new-appoinment" class="btn btn-info text-white mb-2">New Appoinment</router-link>
            <router-link to="/appoinment-report" class="btn btn-info text-white mb-2  bg-success">Appoinment
                Report</router-link>
            <router-link to="/doctor-appoinment-report" class="btn btn-info text-white mb-2">Doctor Appoinment
                Report</router-link>
            <router-link to="/doctor-visit" class="btn btn-info text-white mb-2">Doctor Visit</router-link>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="text-center">Hospital Booked Appoinment Report</h5>
                <div
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
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="appointment-table">
                        <thead>
                            <tr>
                                <th style="height: 30px; background-color: #1d93d2; color:white">Department/Category
                                </th>
                                <th style="height: 30px; background-color: #1d93d2; color:white">Doctor</th>
                                <th style="height: 30px; background-color: #1d93d2; color:white">Total Patient</th>
                                <th style="height: 30px; background-color: #1d93d2; color:white">Male</th>
                                <th style="height: 30px; background-color: #1d93d2; color:white">Female</th>
                                <th style="height: 30px; background-color: #1d93d2; color:white">First Time</th>
                                <th style="height: 30px; background-color: #1d93d2; color:white">Second Time</th>
                                <th style="height: 30px; background-color: #1d93d2; color:white">Thired Time</th>
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
                                <td>{{ appoinment.department_name }}</td>
                                <td>{{ appoinment.doctor_name }}</td>
                                <td>{{ appoinment.total_appointments }}</td>
                                <td>{{ appoinment.total_male }}</td>
                                <td>{{ appoinment.total_female }}</td>
                                <td>{{ appoinment.first_time_visits }}</td>
                                <td>{{ appoinment.second_time_visits }}</td>
                                <td>{{ appoinment.third_time_visits }}</td>
                                <td>{{ appoinment.visited }}</td>
                                <td>
                                    <router-link
                                        :to="`/appoinment-patient/${appoinment.doctor_id}/${visitDate}/${appoinment.department_id}`"
                                        class="text-info d-block d-md-inline" style="cursor: pointer;" title="Show">
                                        <i class="fa-solid fa-eye"></i>
                                    </router-link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div v-if="appoinments.length > 0"
                        class="button_group d-flex justify-content-end align-items-center gap-2">
                        <button class="btn btn-primary"
                            @click="downloadPdf(hospitals.hospital_name, hospitals.logo)">Download
                            PDF</button>
                        <button class="btn btn-success"
                            @click="printAppointmentTable(hospitals.hospital_name, hospitals.logo)">Print Appointment
                            Table</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { onMounted, ref } from 'vue';
import Cookies from "js-cookie";
import html2pdf from 'html2pdf.js';
import PrintHelper from '../../../../Helpers/PrintHelper';
import doctorAppointmentPdf from '../../../../Helpers/doctorAppointmentPdf';
export default {
    name: 'AppointReport',
    setup() {
        const access_token = ref('');
        const selectedDepartment = ref("all");
        const selectedDoctor = ref("all");
        const today = new Date();
        const formattedDate = today.toISOString().split("T")[0];
        const visitDate = ref(formattedDate);

        const doctors = ref([]);
        const departments = ref([]);
        const appoinments = ref([]);
        const hospitals = ref({});


        const searchAppointments = async () => {
            try {
                const params = {
                    visit_date: visitDate.value,
                    selectedDepartment: selectedDepartment.value,
                    selectedDoctor: selectedDoctor.value
                };
                const response = await axios.post("/api/auth/appoinment/apoint/search", params, {
                    headers: {
                        Authorization: `Bearer ${access_token.value}`,
                    },
                });
                console.log(response)
                if (response.data && response.status === 200) {
                    appoinments.value = response.data;
                }
            } catch (error) {
                console.error("Error fetching appointments:", error);
            }
        };


        const fetchAppoinment = async () => {
            try {
                const response = await axios.get("/api/auth/appoinment/report", {
                    headers: {
                        Authorization: `Bearer ${access_token.value}`,
                    },
                });
                console.log(response)
                if (response.data && response.status === 200) {
                    appoinments.value = response.data;
                }
            } catch (error) {
                console.log(error)
            }
        }

        const fetchDoctor = async () => {
            try {
                const response = await axios.get("/api/auth/hospital-doctor", {
                    headers: {
                        Authorization: `Bearer ${access_token.value}`,
                    },
                });
                if (response.data && response.status === 200) {
                    doctors.value = response.data;
                }
            } catch (error) {
            }
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

        const downloadPdf = (hospitalName, hospitalLogo) => {
            const pdfGenerator = new doctorAppointmentPdf(hospitalName, hospitalLogo);
            pdfGenerator.generatePDF();
        };
        const printAppointmentTable = (hospitalName, hospitalLog) => {
            console.log(hospitalLog)
            PrintHelper.printTable(hospitalName, hospitalLog, appoinments.value);
        };

        const hospital = async () => {
            try {
                const response = await axios.get('/api/auth/me', {
                    headers: {
                        'Authorization': `Bearer ${access_token.value}`
                    }
                });
                if (response.data) {
                    hospitals.value = response.data;
                }
            } catch (error) {
                console.error('Error fetching hospital data:', error.response ? error.response.data : error.message);
            }
        };

        onMounted(async () => {
            access_token.value = Cookies.get('access_token');
            await fetchDoctor();
            await fetchDepartment();
            await fetchAppoinment();
            await hospital();
        });

        return {
            searchAppointments,
            selectedDepartment,
            visitDate,
            selectedDoctor,
            appoinments,
            doctors,
            departments,
            downloadPdf,
            hospitals,
            printAppointmentTable
        }
    }
}
</script>

<style scoped>
.header-buttons .btn {
    margin-right: 10px;
}

.filters {
    margin-bottom: 20px;
}

.filters select {
    max-width: 200px;
}

.appoint-number {
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    font-weight: bold;
    color: white;
    background-color: #0056b3;
    border-radius: 8px;
    width: 80px;
    height: 40px;
}

.table th {
    background-color: #007bff;
    color: white;
}


@media (max-width: 768px) {
    .filters {
        flex-direction: column;
    }

    .header-buttons {
        flex-direction: row;
        align-items: center;
    }

    .filters .filter-item {
        width: 100%;
        margin-bottom: 5px;
    }

    .appoint-number {
        width: auto;
        font-size: 18px;
    }

    .table-responsive {
        margin-top: 15px;
    }
}
</style>
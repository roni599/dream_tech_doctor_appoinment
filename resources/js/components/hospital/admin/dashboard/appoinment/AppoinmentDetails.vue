<template>
    <div class="container">
        <div class="maindiv" v-show="!currentComponent">
            <div
                class="header-buttons d-flex flex-wrap justify-content-start justify-content-center justify-content-md-start mb-2">
                <!-- <router-link to="/appoinment-list" class="btn btn-info text-white mb-2">All Appoinment</router-link>
                <router-link to="/appoinment-report" class="btn btn-info text-white mb-2">Appoint Report</router-link>
                <router-link to="/appoinment-doctor-report" class="btn btn-info text-white mb-2">Doctor Appoinment Report</router-link>
                <router-link to="/doctor-visit" class="btn btn-info text-white mb-2">Doctor Visit</router-link> -->
                <router-link to="/appoinment-list" class="btn btn-info text-white mb-2">Appoinment
                    List</router-link>
                <router-link to="/new-appoinment" class="btn btn-info text-white mb-2 bg-success">New
                    Appoinment</router-link>
                <router-link to="/appoinment-report" class="btn btn-info text-white mb-2">Appoinment
                    Report</router-link>
                <router-link to="/doctor-appoinment-report" class="btn btn-info text-white mb-2">Doctor Appoinment
                    Report</router-link>
                <router-link to="/doctor-visit" class="btn btn-info text-white mb-2">Doctor Visit</router-link>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="text-center">Booked New Appoinment</h5>
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
                                <option selected value="" disabled>Choose an option</option>
                                <option v-for="department in departments" :key="department.id" :value="department.id">{{
                                    department.department_category }}</option>
                            </select>
                        </div>
                        <div class="filter-item">
                            <label for="patientMobile" class="form-label mb-0">Doctor</label>
                            <select class="form-select" aria-label="Doctor" v-model="selectedDoctor"
                                @change="searchAppointments">
                                <option selected value="" disabled>Choose an option</option>
                                <option v-for="doctor in doctors" :key="doctor.id" :value="doctor.id">{{
                                    doctor.doctorName }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="height: 30px; background-color: #1d93d2; color:white">S.L No</th>
                                    <th style="height: 30px; background-color: #1d93d2; color:white">Appoint Date</th>
                                    <th style="height: 30px; background-color: #1d93d2; color:white">User ID</th>
                                    <th style="height: 30px; background-color: #1d93d2; color:white">Patient Name</th>
                                    <th style="height: 30px; background-color: #1d93d2; color:white">Mobile</th>
                                    <th style="height: 30px; background-color: #1d93d2; color:white">Gender</th>
                                    <th style="height: 30px; background-color: #1d93d2; color:white">Age</th>
                                    <th style="height: 30px; background-color: #1d93d2; color:white">Appoint</th>
                                    <th style="height: 30px; background-color: #1d93d2; color:white">Visit Time</th>
                                    <th style="height: 30px; background-color: #1d93d2; color:white">Payment</th>
                                    <th style="height: 30px; background-color: #1d93d2; color:white">Amount</th>
                                    <th style="height: 30px; background-color: #1d93d2; color:white">Action</th>
                                </tr>
                            </thead>
                            <tbody v-if="appoinments.length === 0">
                                <tr>
                                    <td colspan="10" class="text-center text-black">No selectd data found.plese select
                                        vist
                                        Date,Department,Doctor</td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr v-for="appoinment in appoinments" :key="appoinment.id">
                                    <td>{{ appoinment.Sl_no }}</td>
                                    <td>{{ formatDate(appoinment.created_at) }}</td>
                                    <td>{{ appoinment.id }}</td>
                                    <td>{{ appoinment.patient_name }}</td>
                                    <td>{{ appoinment.patient_mobile }}</td>
                                    <td>{{ appoinment.gender }}</td>
                                    <td>{{ appoinment.age }}</td>
                                    <td>Hospital</td>
                                    <td>{{ appoinment.visit_time }}</td>
                                    <td>{{ appoinment.payment_status }}</td>
                                    <td>
                                        <span v-if="appoinment.taka === null">Free</span>
                                        <span v-else>{{ appoinment.taka }}</span>
                                    </td>
                                    <td>
                                        <span class="text-info d-block d-md-inline" style="cursor: pointer;"
                                            @click="showAppoint(appoinment.id)"><i class="fa-solid fa-eye"></i></span>
                                        <span class="text-info d-block d-md-inline ms-md-1" style="cursor: pointer;"
                                            @click="editAppoint(appoinment.id)"><i
                                                class="fa-solid fa-pen-to-square"></i></span>
                                        <span class="text-danger d-block d-md-inline ms-md-1"><i
                                                class="fa-solid fa-trash"></i></span>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div v-if="selectedDoctor && selectedDepartment && visitDate" class="d-flex justify-content-end">
                        <router-link :to="{
                            path: '/appoinment-create',
                            query: computedQueryParams
                        }" class="btn btn-primary fw-bold">
                            Add <span class="fw-bold"><i class="fa-solid fa-plus"></i></span>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <component v-if="currentComponent"  :is="currentComponent" :appointmentId="appointmentId" @loadComponent="loadComponent"></component> -->
    <component v-if="currentComponent && appointmentId" :is="currentComponent" :appointmentId="appointmentId"
        @loadComponent="loadComponent"></component>

</template>

<script>
import { onMounted, ref, computed, shallowRef, markRaw, nextTick } from 'vue';
import axios from "axios";
import Cookies from "js-cookie";
import AppoinmentShow from './AppoinmentShow.vue';
import AppoinmentEdit from './AppoinmentEdit.vue';
export default {
    name: "AppoinmentDetails",
    components: {
        AppoinmentShow,
        AppoinmentEdit
    },
    setup() {
        const currentComponent = shallowRef(null);
        const access_token = ref('');
        const doctors = ref([]);
        const departments = ref([]);
        const appoinments = ref([]);
        const appointmentId = ref(null);

        const selectedDoctor = ref("");
        const selectedDepartment = ref("");
        const visitDate = ref('');

        const showAppoint = async (id) => {
            appointmentId.value = id
            await nextTick();
            currentComponent.value = markRaw(AppoinmentShow)
        }

        const editAppoint = async (id) => {
            appointmentId.value = id
            await nextTick();
            currentComponent.value = markRaw(AppoinmentEdit)
        }


        const nextSlNo = computed(() => {
            const lastAppoinment = appoinments.value[appoinments.value.length - 1];
            if (!lastAppoinment) {
                return 1;
            }
            return parseInt(lastAppoinment.Sl_no) + 1;
        });
        const computedQueryParams = computed(() => {
            const lastAppoinment = appoinments.value[appoinments.value.length - 1];
            if (!lastAppoinment) {
                const doctor = doctors.value.find(doc => doc.id === selectedDoctor.value);
                const department = departments.value.find(dept => dept.id === selectedDepartment.value);
                return {
                    Sl_no: '1',
                    doctor_id: selectedDoctor.value,
                    doctorName: doctor?.doctorName,
                    departmentCategory: department?.department_category,
                    departmentId: selectedDepartment.value,
                    visitDate: visitDate.value,
                    visit_fee: doctor?.visitfee,
                    second_day: doctor?.second_day,
                    second_dayFee: doctor?.second_dayFee,
                    thired_day: doctor?.thired_day,
                    thired_dayFee: doctor?.thired_dayFee,
                };
            }
            return {
                Sl_no: nextSlNo.value.toString(),
                doctor_id: lastAppoinment.doctor.id,
                doctorName: lastAppoinment.doctor.doctorName,
                departmentCategory: lastAppoinment.department_category.department_category,
                departmentId: lastAppoinment.department_category.id,
                visitDate: visitDate.value,
                visit_fee: lastAppoinment.doctor.visitfee,
                // second_day:lastAppoinment.second_day,
                // second_dayFee:lastAppoinment.second_dayFee,
                // thired_day:lastAppoinment.thired_day,
                // thired_dayFee:lastAppoinment.thired_dayFee,
            };
        });

        const searchAppointments = async () => {
            try {
                const params = {
                    visit_date: visitDate.value,
                    selectedDepartment: selectedDepartment.value,
                    selectedDoctor: selectedDoctor.value
                };
                const response = await axios.post("/api/auth/appoinment/search", params, {
                    headers: {
                        Authorization: `Bearer ${access_token.value}`,
                    },
                });
                if (response.data && response.status === 200) {
                    appoinments.value = response.data;
                }
            } catch (error) {
                console.error("Error fetching appointments:", error);
            }
        };


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

        onMounted(async () => {
            access_token.value = Cookies.get('access_token');
            await fetchDoctor();
            await fetchDepartment();
        });
        const loadComponent = () => {
            searchAppointments();
            currentComponent.value = null;
        };
        const formatDate = (datetime) => {
            if (!datetime) return ''
            const date = new Date(datetime)
            const day = String(date.getDate()).padStart(2, '0')
            const month = String(date.getMonth() + 1).padStart(2, '0') // Months are 0-indexed
            const year = date.getFullYear()
            return `${day}-${month}-${year}`
        }
        return {
            doctors,
            departments,
            appoinments,
            searchAppointments,
            selectedDepartment,
            visitDate,
            selectedDoctor,
            nextSlNo,
            computedQueryParams,
            showAppoint,
            editAppoint,
            currentComponent,
            loadComponent,
            appointmentId,
            formatDate
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
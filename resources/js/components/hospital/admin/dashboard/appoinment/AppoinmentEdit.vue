<template>
    <div class="container">
        <div class="main-div" v-show="!currentComponent">
            <div class="p-2 rounded" style="background-color: #FFFFFF; height: 103vh;">
                <div class="buttonhide d-flex justify-content-end mb-2">
                    <span><i class="fa-solid fa-xmark text-white bg-danger text-end p-1 rounded-circle"
                            style="cursor: pointer" @click="closeAppointment"></i></span>
                </div>
                <div class="row">
                    <div class="container">
                        <form @submit.prevent="submitForm">
                            <div class="row justify-content-center">
                                <div :class="{
                                    'col-lg-8':
                                        form.payment === 'Discount' || form.payment === 'Free',
                                    'col-lg-12': !(
                                        form.payment === 'Discount' || form.payment === 'Free'
                                    ),
                                }">
                                    <div class="card w-100">
                                        <div class="card-header d-flex justify-content-between">
                                            <h6 class="text-center mt-2" style="color: #1d93d2">
                                                Appointment Edit
                                            </h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-1 text-center">
                                                <span class="fw-bold">Appoinment ID: <span class="text-info">{{
                                                    form.appointby }}</span></span>
                                            </div>
                                            <div class="mb-1 text-center">
                                                <span class="section-title">S.L No: </span>
                                                <span class="badge badge-custom ms-2">{{ SlNo }}</span>
                                                <input type="hidden" name="slNo" v-model="form.slNo" />
                                            </div>
                                            <div class="mb-2 text-center">
                                                <p class="mb-0">
                                                    <strong>Visit Date: </strong>{{ visitDate }}
                                                </p>
                                                <input type="hidden" name="visit_date" v-model="form.visit_date" />
                                                <p class="mb-0">
                                                    <strong>Department/Category: </strong>{{ departmentCategory }}
                                                </p>
                                                <input type="hidden" name="department_categoy"
                                                    v-model="form.department_category_id" />
                                                <p class="mb-0"><strong>Doctor: </strong>{{ DoctorName }}</p>
                                                <input type="hidden" name="doctor_id" v-model="form.doctor_id" />
                                            </div>
                                            <div
                                                class="filters d-flex flex-column flex-sm-row justify-content-center gap-3 align-items-center mb-4 my-3">
                                                <div class="filter-item">
                                                    <label for="patientMobile" class="form-label mb-0">Visit
                                                        date</label>
                                                    <input type="date" @change="handleVisitDateChange($event)"
                                                        class="form-control" />
                                                </div>
                                                <div class="filter-item">
                                                    <label for="patientMobile"
                                                        class="form-label mb-0">Department/Category</label>
                                                    <!-- <select class="form-select" aria-label="Department/Category" v-model="form.department_category_id"  @change="departmentDoctorMethod($event)">
                                                    <option value="" selected disabled>Choose an option</option>
                                                    <option v-for="department in departments" :key="department.id" :value="department.id">{{ department.department_category }}</option>
                                                </select> -->
                                                    <select class="form-select"
                                                        @change="departmentDoctorMethod($event)">
                                                        <option disabled selected>Choose an option</option>
                                                        <option v-for="dept in departments" :key="dept.id"
                                                            :value="JSON.stringify(dept)">
                                                            {{ dept.department_category }}
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="filter-item">
                                                    <label for="patientMobile" class="form-label mb-0">Doctor</label>
                                                    <!-- <select class="form-select" aria-label="Doctor"
                                                    @change="selectDoctorMethod($event)">
                                                    <option selected value="" disabled>Choose an option</option>
                                                    <option v-for="departmentDoctor in departmentDoctors"
                                                        :key="departmentDoctor.id" :value="departmentDoctor.id">{{
                                                            departmentDoctor.doctorName }}</option>
                                                </select> -->
                                                    <select class="form-select" @change="selectDoctorMethod($event)">
                                                        <option disabled selected>Choose an option</option>
                                                        <option v-for="doctor in departmentDoctors" :key="doctor.id"
                                                            :value="JSON.stringify(doctor)">
                                                            {{ doctor.doctorName }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-2">
                                                <label for="patientMobile" class="form-label mb-0">Patient
                                                    Mobile/Mail</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="patientMobile"
                                                        v-model="form.patient_mobile" />
                                                    <button class="btn btn-danger" type="button">✔</button>
                                                </div>
                                                <span v-if="errors.patient_mobile" class="text-danger">
                                                    {{ errors.patient_mobile[0] }}
                                                </span>
                                            </div>
                                            <div class="mb-2">
                                                <label for="patientName" class="form-label mb-0">Patient Name</label>
                                                <input type="text" class="form-control" id="patientName"
                                                    v-model="form.patient_name" />
                                            </div>
                                            <span v-if="errors.patient_name" class="text-danger">
                                                {{ errors.patient_name[0] }}
                                            </span>
                                            <div class="row mb-0 g-2">
                                                <div class="col-md-6">
                                                    <label for="gender" class="form-label mb-0">Gender</label>
                                                    <select class="form-select" id="gender"
                                                        v-model="form.patient_gender">
                                                        <option selected value="" disabled>
                                                            Select an option
                                                        </option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                        <option value="Others">Others</option>
                                                    </select>
                                                    <span v-if="errors.patient_gender" class="text-danger">
                                                        {{ errors.patient_gender[0] }}
                                                    </span>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="age" class="form-label mb-0">Age</label>
                                                    <input type="text" class="form-control" id="age"
                                                        v-model="form.patient_age" />
                                                    <span v-if="errors.patient_age" class="text-danger">
                                                        {{ errors.patient_age[0] }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="row g-2 mt-1">
                                                <div class="col-md-6">
                                                    <label for="visitTime" class="form-label mb-0">Visit Time</label>
                                                    <select class="form-select" id="visitTime"
                                                        v-model="form.visit_time">
                                                        <option selected value="" disabled>
                                                            Select an option
                                                        </option>
                                                        <option value="1st">1st Time</option>
                                                        <option value="2nd">2nd Time</option>
                                                        <option value="3rd">3rd Time</option>
                                                    </select>
                                                </div>
                                                <span v-if="errors.visit_time" class="text-danger">
                                                    {{ errors.visit_time[0] }}
                                                </span>
                                                <div class="col-md-6">
                                                    <label for="payment" class="form-label mb-0">Payment</label>
                                                    <select v-model="form.payment" class="form-select" id="payment">
                                                        <option selected value="" disabled>
                                                            Select an option
                                                        </option>
                                                        <option value="paid">Paid</option>
                                                        <option value="unpaid">Unpaid</option>
                                                        <option value="Discount">Discount</option>
                                                        <option value="Free">Free</option>
                                                    </select>
                                                </div>
                                                <span v-if="errors.payment" class="text-danger">
                                                    {{ errors.payment[0] }}
                                                </span>
                                            </div>
                                            <div class="mb-2 mt-3">
                                                <label for="remenance" class="form-label mb-0">Reference</label>
                                                <select id="reference" class="form-select"
                                                    v-model="form.visit_reference_id">
                                                    <option value="" selected>Choose...</option>
                                                    <option v-for="reference in references" :key="reference.id"
                                                        :value="reference.id">
                                                        {{ reference.name }}
                                                    </option>
                                                </select>
                                            </div>
                                            <span v-if="errors.visit_reference_id" class="text-danger">
                                                {{ errors.visit_reference_id[0] }}
                                            </span>
                                            <div class="mb-3">
                                                <label for="description" class="form-label mb-0">Description</label>
                                                <textarea class="form-control" id="description" rows="3"
                                                    v-model="form.visit_description"></textarea>
                                            </div>
                                            <span v-if="errors.visit_description" class="text-danger">
                                                {{ errors.visit_description[0] }}
                                            </span>
                                            <button class="btn w-100" style="background-color: #0d6efd; color: #fff">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4" v-if="form.payment === 'Discount' || form.payment === 'Free'">
                                    <div class="form-section bg-white" v-if="form.payment === 'Discount'">
                                        <div class="d-flex justify-content-between mb-3">
                                            <h6 class="text-center">Discount</h6>
                                            <span><i class="fa-solid fa-xmark text-white bg-danger p-1 rounded-circle"
                                                    style="cursor: pointer" @click="hideContent"></i></span>
                                        </div>
                                        <div class="mb-3">
                                            <div class="mb-3">
                                                <label for="fee" class="form-label mb-0">Fee</label>
                                                <div class="input-group">
                                                    <input type="text" v-model="form.fee" class="form-control" id="fee"
                                                        placeholder="Fee" @input="calculateValues" />
                                                    <input type="text" v-model="form.amount" class="form-control"
                                                        placeholder="%" @input="calculateFromFeeAndAmount" />
                                                    <input type="text" v-model="form.percentage" class="form-control"
                                                        placeholder="TK" @input="calculateFromFeeAndPercentage" />
                                                </div>
                                                <span v-if="firstError" class="text-danger">
                                                    {{ firstError }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="reference" class="form-label mb-0">Reference</label>
                                            <select id="reference2" class="form-select"
                                                v-model="form.discount_reference_id">
                                                <option value="" selected>Choose...</option>
                                                <option v-for="reference in references" :key="reference.id"
                                                    :value="reference.id">
                                                    {{ reference.name }}
                                                </option>
                                            </select>
                                        </div>
                                        <span v-if="errors.discount_reference_id" class="text-danger">
                                            {{ errors.discount_reference_id[0] }}
                                        </span>
                                        <div class="mb-3">
                                            <label for="narration" class="form-label mb-0">Narration</label>
                                            <textarea class="form-control" id="narration" rows="3"
                                                placeholder="narration" v-model="form.discount_narration"></textarea>
                                        </div>
                                        <span v-if="errors.discount_narration" class="text-danger">
                                            {{ errors.discount_narration[0] }}
                                        </span>
                                    </div>

                                    <div class="form-section mt-3 bg-white" v-if="form.payment === 'Free'">
                                        <div class="d-flex justify-content-between mb-3">
                                            <h6 class="text-center">Free</h6>
                                            <span><i class="fa-solid fa-xmark text-white bg-danger p-1 rounded-circle"
                                                    @click="hideContent" style="cursor: pointer"></i></span>
                                        </div>
                                        <div class="mb-3">
                                            <label for="referenceFree" class="form-label mb-0">Reference</label>
                                            <select id="reference" class="form-select" v-model="form.free_reference_id">
                                                <option value="" selected>Choose...</option>
                                                <option v-for="reference in references" :key="reference.id"
                                                    :value="reference.id">
                                                    {{ reference.name }}
                                                </option>
                                            </select>
                                            <span v-if="errors.free_reference_id" class="text-danger">
                                                {{ errors.free_reference_id[0] }}
                                            </span>
                                        </div>
                                        <div class="mb-3">
                                            <label for="narrationFree" class="form-label mb-0">Narration</label>
                                            <textarea class="form-control" id="narrationFree" rows="3"
                                                placeholder="narration" v-model="form.free_narration"></textarea>
                                            <span v-if="errors.free_narration" class="text-danger">
                                                {{ errors.free_narration[0] }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <component v-if="currentComponent" :is="currentComponent" :appointmentId="app_id"
        @loadComponent="loadComponent"></component>
</template>

<script>
import { ref, computed, onMounted, watch, shallowRef, markRaw, nextTick } from "vue";
import Cookies from "js-cookie";
import axios from "axios";
import { useRouter, useRoute } from "vue-router";
import AppoinmentShow from './AppoinmentShow.vue';
export default {
    name: "AppoinmentEdit",
    components: {
        AppoinmentShow,
    },
    emits: ['loadComponent'],
    props: {
        appointmentId: {
            type: [String, Number],
            required: true,
        },
    },
    setup(props, { emit }) {
        const { appointmentId } = props;
        const currentComponent = shallowRef(null);
        const router = useRouter();
        const route = useRoute();
        const departments = ref([]);
        const app_id = ref('');
        const form = ref({
            appoin_id: '',
            slNo: "",
            visit_date: "",
            department_category_id: '',
            doctor_id: "",
            patient_name: "",
            patient_address: "",
            patient_mobile: "",
            patient_gender: "",
            patient_age: "",
            visit_time: "",
            payment: "",
            visit_reference_id: "",
            visit_description: "",
            fee: "",
            amount: "",
            percentage: "",
            discount_reference_id: "",
            discount_narration: "",
            free_reference_id: "",
            free_narration: "",
            appointby: ''
        });
        const departmentDoctors = ref([]);
        const SlNo = ref("");
        const visitDate = ref("");
        const departmentCategory = ref("");
        const DoctorName = ref("");

        const references = ref([]);
        const access_token = ref("");
        const errors = ref({});

        const departmentDoctorMethod = async (event) => {
            const selected = JSON.parse(event.target.value);
            form.value.department_category_id = selected.id;
            departmentCategory.value = selected.department_category;
            try {
                const response = await axios.get("/api/auth/department/doctor", {
                    params: {
                        department_id: departmentCategory.value,
                    },
                    headers: {
                        Authorization: `Bearer ${access_token.value}`,
                    },
                });
                if (response.data && response.status === 200) {
                    departmentDoctors.value = response.data;
                }
            } catch (error) {
                console.error('Error fetching doctors by department:', error);
            }
        };

        const handleVisitDateChange = (event) => {
            visitDate.value = event.target.value;
            form.value.visit_date = event.target.value;
        };

        const selectDoctorMethod = (event) => {
            const selectedDoctor = JSON.parse(event.target.value);
            form.value.doctor_id = selectedDoctor.id;
            DoctorName.value = selectedDoctor.doctorName;
        };

        const closeAppointment = () => {
            emit('loadComponent');
        };

        const firstError = computed(() => {
            return errors.value.fee?.[0] || errors.value.amount?.[0] || errors.value.percentage?.[0] || "";
        });

        const cleanAndConvert = (value) => {
            if (typeof value === "string") {
                return parseFloat(value.replace(/[%Tk]/g, "").trim());
            } else if (typeof value === "number") {
                return value;
            } else {
                console.warn("The value is not a valid type for conversion:", value);
                return 0;
            }
        };

        const submitForm = async () => {
            try {
                form.value.fee = cleanAndConvert(form.value.fee);
                form.value.amount = cleanAndConvert(form.value.amount);
                form.value.percentage = cleanAndConvert(form.value.percentage);
                const response = await axios.post(
                    "/api/auth/appoinment/update",
                    form.value,
                    {
                        headers: {
                            Authorization: `Bearer ${access_token.value}`,
                        },
                    }
                );
                console.log(response.data)
                if (response.data && response.status === 200) {
                    resetForm();
                    app_id.value = response.data.appointment.id;
                    await nextTick();
                    currentComponent.value = markRaw(AppoinmentShow)
                    Swal.fire({
                        title: response.data.message,
                        icon: "success",
                        draggable: true
                    });
                    // emit('loadComponent');
                }
            } catch (error) {
                if (error.response && error.response.data.errors) {
                    errors.value = error.response.data.errors;
                }
                if (error.response && error.response.data.error) {
                    const { status, data } = error.response;
                    if (status === 401) {
                        Swal.fire({
                            title: 'Unauthorized access. Please log in.',
                            icon: "success",
                            draggable: true
                        });
                        emit('loadComponent');
                    }
                }
            }
        };
        const loadComponent = () => { 
            router.push({ name: 'Appoinment' });
        };
        const fetchReference = async () => {
            try {
                const response = await axios.get("/api/auth/reference", {
                    headers: {
                        Authorization: `Bearer ${access_token.value}`,
                    },
                });
                if (response.data && response.status === 200) {
                    references.value = response.data;
                }
            } catch (error) { }
        };
        const calculateFromFeeAndAmount = () => {
            if (form.value.fee && form.value.amount) {
                const discount =
                    (parseFloat(form.value.fee) * parseFloat(form.value.amount)) / 100;
                form.value.percentage =
                    !isNaN(parseFloat(form.value.fee)) && !isNaN(discount)
                        ? (parseFloat(form.value.fee) - discount).toFixed(2) + " Tk"
                        : "0 Tk";
            }
        };
        const calculateFromFeeAndPercentage = () => {
            if (form.value.fee && form.value.percentage) {
                const percentageValue = parseFloat(form.value.percentage);
                if (!isNaN(percentageValue)) {
                    form.value.amount =
                        !isNaN(parseFloat(form.value.fee)) && !isNaN(percentageValue)
                            ? (
                                ((parseFloat(form.value.fee) - percentageValue) /
                                    parseFloat(form.value.fee)) *
                                100
                            ).toFixed(0) + " %"
                            : "0 %";
                }
            }
        };

        watch(
            () => form.value.fee,
            (newValue) => {
                if (newValue) {
                    calculateValues();
                } else {
                    form.value.amount = "";
                    form.value.percentage = "";
                }
            }
        );

        const calculateValues = () => {
            if (form.value.fee) {
                if (form.value.amount) {
                    calculateFromFeeAndAmount();
                } else if (form.value.percentage) {
                    calculateFromFeeAndPercentage();
                }
            } else {
                form.value.amount = "";
                form.value.percentage = "";
            }
        };
        const findAppointment = async (appointmentId) => {
            try {
                const response = await axios.get(`/api/auth/appointment/editdata/${appointmentId}`, {
                    headers: {
                        'Authorization': `Bearer ${access_token.value}`,
                    },
                });
                if (response.data && response.status === 200) {
                    form.value.appoin_id = response.data.id,
                        form.value.slNo = response.data.Sl_no || '',
                        form.value.visit_date = response.data.visit_date || '',
                        form.value.department_category_id = route.query.departmentId || '',
                        form.value.doctor_id = response.data.doctor.id || '',
                        form.value.patient_name = response.data.patient_name;
                    form.value.patient_address = response.data.patient_address || '',
                        form.value.patient_mobile = response.data.patient_mobile,
                        form.value.patient_gender = response.data.gender,
                        form.value.patient_age = response.data.age,
                        form.value.visit_time = response.data.visit_time,
                        form.value.payment = response.data.payment_status,
                        form.value.visit_reference_id = response.data.reference.id,
                        form.value.visit_description = response.data.description,
                        form.value.department_category_id = response.data.department_category.id,
                        form.value.fee = response.data.fee,
                        form.value.amount = response.data.amount,
                        form.value.percentage = response.data.taka,
                        form.value.discount_reference_id = response.data.discount_free_reference.id,
                        form.value.discount_narration = response.data.discount_narration,
                        form.value.free_reference_id = response.data.discount_free_reference.id,
                        form.value.free_narration = response.data.free_narration,
                        form.value.appointby = response.data.appointby,
                        SlNo.value = response.data.Sl_no || '',
                        visitDate.value = response.data.visit_date || '',
                        departmentCategory.value = response.data.department_category.department_category || ''
                    DoctorName.value = response.data.doctor.doctorName
                }
            } catch (error) {
                console.error("Error fetching appointment data:", error);
            }
        };

        onMounted(() => {
            access_token.value = Cookies.get("access_token");
            fetchReference();
            fetchDepartment();
            findAppointment(appointmentId);
        });
        const hideContent = () => {
            if (form.value.payment === "Discount") {
                form.value.payment = "";
                form.value.fee = "";
                form.value.amount = "";
                form.value.percentage = "";
            } else if (form.value.payment === "Free") {
                form.value.payment = "";
                form.value.fee = "";
                form.value.amount = "";
                form.value.percentage = "";
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
        const resetForm = () => {
            form.value = {
                slNo: "",
                visit_date: "",
                department_category_id: "",
                doctor_id: "",
                patient_name: "",
                patient_address: "",
                patient_mobile: "",
                patient_gender: "",
                patient_age: "",
                visit_time: "",
                payment: "",
                visit_reference_id: "",
                visit_description: "",
                fee: "",
                amount: "",
                percentage: "",
                discount_reference_id: "",
                discount_narration: "",
                free_reference_id: "",
                free_narration: "",
            };
        };
        return {
            currentComponent,
            app_id,
            handleVisitDateChange,
            departmentDoctorMethod,
            selectDoctorMethod,
            departmentDoctors,
            departments,
            form,
            SlNo,
            visitDate,
            departmentCategory,
            DoctorName,
            submitForm,
            errors,
            firstError,
            hideContent,
            access_token,
            references,
            calculateFromFeeAndAmount,
            calculateFromFeeAndPercentage,
            calculateValues,
            closeAppointment,
            appointmentId,
            loadComponent
        };
    },
}
</script>

<!-- <script>
import { ref, computed, onMounted, watch, shallowRef, nextTick, markRaw } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import Cookies from 'js-cookie';
import axios from 'axios';
import Swal from 'sweetalert2';
import AppoinmentShow from './AppoinmentShow.vue';

export default {
    name: "AppoinmentEdit",
    components: {
        AppoinmentShow,
    },
    emits: ['loadComponent'], // ✅ Fix: Declare emitted event
    props: {
        appointmentId: {
            type: [String, Number],
            required: true,
        },
    },
    setup(props, { emit }) {
        const { appointmentId } = props;
        const currentComponent = shallowRef(null);
        const router = useRouter();
        const route = useRoute();
        const departments = ref([]);
        const appoinmentId = ref('');
        const form = ref({
            appoin_id: '',
            slNo: "",
            visit_date: "",
            department_category_id: '',
            doctor_id: "",
            patient_name: "",
            patient_address: "",
            patient_mobile: "",
            patient_gender: "",
            patient_age: "",
            visit_time: "",
            payment: "",
            visit_reference_id: "",
            visit_description: "",
            fee: "",
            amount: "",
            percentage: "",
            discount_reference_id: "",
            discount_narration: "",
            free_reference_id: "",
            free_narration: "",
            appointby: ''
        });
        const departmentDoctors = ref([]);
        const SlNo = ref("");
        const visitDate = ref("");
        const departmentCategory = ref("");
        const DoctorName = ref("");
        const references = ref([]);
        const access_token = ref("");
        const errors = ref({});

        const departmentDoctorMethod = async (event) => {
            const selected = JSON.parse(event.target.value);
            form.value.department_category_id = selected.id;
            departmentCategory.value = selected.department_category;
            try {
                const response = await axios.get("/api/auth/department/doctor", {
                    params: {
                        department_id: departmentCategory.value,
                    },
                    headers: {
                        Authorization: `Bearer ${access_token.value}`,
                    },
                });
                if (response.data && response.status === 200) {
                    departmentDoctors.value = response.data;
                }
            } catch (error) {
                console.error('Error fetching doctors by department:', error);
            }
        };

        const handleVisitDateChange = (event) => {
            visitDate.value = event.target.value;
            form.value.visit_date = event.target.value;
        };

        const selectDoctorMethod = (event) => {
            const selectedDoctor = JSON.parse(event.target.value);
            form.value.doctor_id = selectedDoctor.id;
            DoctorName.value = selectedDoctor.doctorName;
        };

        const closeAppointment = () => {
            emit('loadComponent');
        };

        const firstError = computed(() => {
            return errors.value.fee?.[0] || errors.value.amount?.[0] || errors.value.percentage?.[0] || "";
        });

        const cleanAndConvert = (value) => {
            if (typeof value === "string") {
                return parseFloat(value.replace(/[%Tk]/g, "").trim());
            } else if (typeof value === "number") {
                return value;
            } else {
                console.warn("The value is not a valid type for conversion:", value);
                return 0;
            }
        };

        const submitForm = async () => {
            try {
                form.value.fee = cleanAndConvert(form.value.fee);
                form.value.amount = cleanAndConvert(form.value.amount);
                form.value.percentage = cleanAndConvert(form.value.percentage);
                const response = await axios.post(
                    "/api/auth/appoinment/update",
                    form.value,
                    {
                        headers: {
                            Authorization: `Bearer ${access_token.value}`,
                        },
                    }
                );
                if (response.data && response.status === 200) {
                    resetForm();
                    appoinmentId.value = response.data.appointment.id;
                    await nextTick();
                    currentComponent.value = markRaw(AppoinmentShow);
                    Swal.fire({
                        title: response.data.message,
                        icon: "success",
                        draggable: true
                    });
                    emit('loadComponent');
                }
            } catch (error) {
                if (error.response && error.response.data.errors) {
                    errors.value = error.response.data.errors;
                }
                if (error.response && error.response.data.error) {
                    const { status } = error.response;
                    if (status === 401) {
                        Swal.fire({
                            title: 'Unauthorized access. Please log in.',
                            icon: "warning",
                            draggable: true
                        });
                        emit('loadComponent');
                    }
                }
            }
        };

        const loadComponent = () => {
            router.push({ name: 'Appoinment' });
            currentComponent.value = null;
        };

        const fetchReference = async () => {
            try {
                const response = await axios.get("/api/auth/reference", {
                    headers: {
                        Authorization: `Bearer ${access_token.value}`,
                    },
                });
                if (response.data && response.status === 200) {
                    references.value = response.data;
                }
            } catch (error) {
                console.error("Error fetching references:", error);
            }
        };

        const calculateFromFeeAndAmount = () => {
            if (form.value.fee && form.value.amount) {
                const discount = (parseFloat(form.value.fee) * parseFloat(form.value.amount)) / 100;
                form.value.percentage =
                    !isNaN(parseFloat(form.value.fee)) && !isNaN(discount)
                        ? (parseFloat(form.value.fee) - discount).toFixed(2) + " Tk"
                        : "0 Tk";
            }
        };

        const calculateFromFeeAndPercentage = () => {
            if (form.value.fee && form.value.percentage) {
                const percentageValue = parseFloat(form.value.percentage);
                if (!isNaN(percentageValue)) {
                    form.value.amount =
                        !isNaN(parseFloat(form.value.fee)) && !isNaN(percentageValue)
                            ? (
                                ((parseFloat(form.value.fee) - percentageValue) / parseFloat(form.value.fee)) * 100
                            ).toFixed(0) + " %"
                            : "0 %";
                }
            }
        };

        watch(
            () => form.value.fee,
            (newValue) => {
                if (newValue) {
                    calculateValues();
                } else {
                    form.value.amount = "";
                    form.value.percentage = "";
                }
            }
        );

        const calculateValues = () => {
            if (form.value.fee) {
                if (form.value.amount) {
                    calculateFromFeeAndAmount();
                } else if (form.value.percentage) {
                    calculateFromFeeAndPercentage();
                }
            } else {
                form.value.amount = "";
                form.value.percentage = "";
            }
        };

        const findAppointment = async (appointmentId) => {
            try {
                const response = await axios.get(`/api/auth/appointment/editdata/${appointmentId}`, {
                    headers: {
                        'Authorization': `Bearer ${access_token.value}`,
                    },
                });
                if (response.data && response.status === 200) {
                    const data = response.data;
                    form.value.appoin_id = data.id;
                    form.value.slNo = data.Sl_no || '';
                    form.value.visit_date = data.visit_date || '';
                    form.value.department_category_id = route.query.departmentId || data.department_category.id || '';
                    form.value.doctor_id = data.doctor.id || '';
                    form.value.patient_name = data.patient_name;
                    form.value.patient_address = data.patient_address || '';
                    form.value.patient_mobile = data.patient_mobile;
                    form.value.patient_gender = data.gender;
                    form.value.patient_age = data.age;
                    form.value.visit_time = data.visit_time;
                    form.value.payment = data.payment_status;
                    form.value.visit_reference_id = data.reference.id;
                    form.value.visit_description = data.description;
                    form.value.fee = data.fee;
                    form.value.amount = data.amount;
                    form.value.percentage = data.taka;
                    form.value.discount_reference_id = data.discount_free_reference.id;
                    form.value.discount_narration = data.discount_narration;
                    form.value.free_reference_id = data.discount_free_reference.id;
                    form.value.free_narration = data.free_narration;
                    form.value.appointby = data.appointby;

                    SlNo.value = data.Sl_no || '';
                    visitDate.value = data.visit_date || '';
                    departmentCategory.value = data.department_category.department_category || '';
                    DoctorName.value = data.doctor.doctorName;
                }
            } catch (error) {
                console.error("Error fetching appointment data:", error);
            }
        };

        const hideContent = () => {
            if (form.value.payment === "Discount" || form.value.payment === "Free") {
                form.value.payment = "";
                form.value.fee = "";
                form.value.amount = "";
                form.value.percentage = "";
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
                console.error("Error fetching departments:", error);
            }
        };

        const resetForm = () => {
            form.value = {
                slNo: "",
                visit_date: "",
                department_category_id: "",
                doctor_id: "",
                patient_name: "",
                patient_address: "",
                patient_mobile: "",
                patient_gender: "",
                patient_age: "",
                visit_time: "",
                payment: "",
                visit_reference_id: "",
                visit_description: "",
                fee: "",
                amount: "",
                percentage: "",
                discount_reference_id: "",
                discount_narration: "",
                free_reference_id: "",
                free_narration: "",
                appointby: ''
            };
        };

        onMounted(() => {
            access_token.value = Cookies.get("access_token");
            fetchReference();
            fetchDepartment();
            findAppointment(appointmentId);
        });

        return {
            currentComponent,
            appoinmentId,
            handleVisitDateChange,
            departmentDoctorMethod,
            selectDoctorMethod,
            departmentDoctors,
            departments,
            form,
            SlNo,
            visitDate,
            departmentCategory,
            DoctorName,
            submitForm,
            errors,
            firstError,
            hideContent,
            access_token,
            references,
            calculateFromFeeAndAmount,
            calculateFromFeeAndPercentage,
            calculateValues,
            closeAppointment,
            appointmentId,
            loadComponent
        };
    },
};
</script> -->

<style scoped>
.hh {
    background-color: #155724;
    color: #fff;
    font-weight: bold;
}

.close-btn {
    color: #fff;
    float: right;
    cursor: pointer;
}

.btn-custom {
    background-color: #0d6efd;
    color: #fff;
}

.form-section {
    border: 1px solid #ced4da;
    border-radius: 0.5rem;
    padding: 1rem;
    margin-bottom: 1rem;
}

.badge-custom {
    background-color: orange;
    color: #fff;
    font-size: 0.9rem;
    padding: 0.3rem 0.5rem;
}

.section-title {
    font-size: 1.2rem;
    font-weight: bold;
}

.Appointment-text {
    color: #8c8794;
    font-weight: bold;
}

.card {
    transition: width 0.3s ease-in-out;
}
</style>
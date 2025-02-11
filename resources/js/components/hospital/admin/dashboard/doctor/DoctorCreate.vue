<template>
    <div class="d-flex justify-content-center align-items-center">
        <div class="card" style="width: 1300px;">
            <div class="card-header">
                <h5 class="card-title">Doctor Create</h5>
            </div>
            <div class="card-body">
                <form @submit.prevent="submitForm">
                    <div class="row form-section mb-2">
                        <div class="col-md-6">
                            <label for="department" class="form-label mb-0">Department/Category</label>
                            <select v-model="form.deparment_category" class="form-select">
                                <option value="" disabled selected>Select Department</option>
                                <option value="Medicine">Medicine</option>
                                <option value="Cardiology">Cardiology</option>
                                <option value="Hypertension">Hypertension</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="department" class="form-label mb-0">Reg Number</label>
                            <input v-model="form.regnum" type="text" class="form-control" id="reg-number" placeholder="Reg number">
                        </div>
                    </div>
                    <div class="row form-section mb-2">
                        <div class="col-md-6">
                            <label for="department" class="form-label mb-0">Doctor Name</label>
                            <input v-model="form.doctorName" type="text" class="form-control" id="reg-number" placeholder="Dr. name">
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label mb-0">E-Mail</label>
                            <input v-model="form.email" type="email" class="form-control" id="email" placeholder="@gmail.com">
                        </div>
                    </div>

                    <div class="row form-section mb-2">
                        <div class="col-md-6">
                            <label for="age" class="form-label mb-0">Age</label>
                            <input v-model="form.age" type="text" class="form-control" id="age" placeholder="Age">
                        </div>
                        <div class="col-md-6">
                            <label for="gender" class="form-label mb-0">Gender</label>
                            <select v-model="form.gender" class="form-select form-control"
                                aria-label="Default select example">
                                <option selected value="">Open this select menu</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Others</option>
                            </select>
                        </div>

                    </div>
                    <div class="row form-section mb-2">
                        <div class="col-md-6">
                            <label for="details" class="form-label mb-0">Details</label>
                            <input v-model="form.details" class="form-control" id="details" placeholder="Details" />
                        </div>
                        <!-- <div class="col-md-6">
                            <label for="experience" class="form-label mb-0">Experience</label>
                            <input v-model="form.experience" type="text" class="form-control" id="experience">
                        </div> -->
                        <div class="col-md-6">
                            <label for="gender" class="form-label mb-0">Experience</label>
                            <select v-model="form.experience" class="form-select form-control"
                                aria-label="Default select example">
                                <option selected value="">Open this select menu</option>
                                <option v-for="experience in experiences" :key="experience.id"
                                    :value="experience.experience">{{ experience.experience }}</option>
                            </select>
                        </div>

                    </div>
                    <div class="row form-section mb-2">
                        <div class="col-md-12">
                            <label for="specialist" class="form-label mb-0">Specialist</label>
                            <div v-for="(item, index) in selects" :key="index" class="d-flex align-items-center mt-2">
                                <select class="form-select flex-grow-1 me-2" v-model="item.value"
                                    aria-label="Default select example">
                                    <option selected disabled value="">Open this select menu</option>
                                    <option v-for="specialist in specialists" :key="specialist.id"
                                        :value="specialist.specialist">{{ specialist.specialist }}</option>
                                </select>
                                <div class="d-flex">
                                    <button type="button" class="btn btn-success me-1"
                                        v-if="index === selects.length - 1" @click="addSelect">+
                                    </button>
                                    <button type="button" class="btn btn-danger" v-if="selects.length > 1"
                                        @click="removeSelect(index)"> -
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-section mb-2">
                        <div class="col-md-12">
                            <label for="symptom" class="form-label mb-0">Symptom</label>
                            <div v-for="(item, index) in symptom" :key="index" class="d-flex align-items-center mt-2">
                                <select class="form-select flex-grow-1 me-2" v-model="item.value"
                                    aria-label="Default select example">
                                    <option value="" disabled selected>Open this select menu</option>
                                    <option v-for="symptom in symtoms" :key="symptom.id" :value="symptom.symptom">{{
                                        symptom.symptom }}</option>
                                </select>
                                <div class="d-flex">
                                    <button type="button" class="btn btn-success me-1"
                                        v-if="index === symptom.length - 1" @click="addSymtom">+
                                    </button>
                                    <button type="button" class="btn btn-danger" v-if="symptom.length > 1"
                                        @click="removeSymptom(index)"> -
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-section mb-2">
                        <div class="col-md-6">
                            <label for="mobile" class="form-label mb-0">Mobile</label>
                            <input v-model="form.mobile" type="text" class="form-control" id="mobile" placeholder="+880">
                        </div>
                        <div class="col-md-6">
                            <label for="mobile" class="form-label mb-0">Optional Mobile</label>
                            <input v-model="form.mobile_optional" type="text" class="form-control" id="mobile" placeholder="+880">
                        </div>
                    </div>
                    <div class="row form-section mb-2">
                        <div class="col-md-12">
                            <label for="mobile" class="form-label mb-0">Shedule</label>
                            <div class="table_size">
                                <table class="table table-bordered  table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th style="height: 30px;">Days</th>
                                            <th style="height: 30px;">Start</th>
                                            <th style="height: 30px;">End</th>
                                            <th style="height: 30px;">Visit Limit</th>
                                            <th style="height: 30px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(row, index) in rows" :key="index">
                                            <td style="min-width: 150px;">
                                                <select v-model="row.day" class="form-select form-control"
                                                    aria-label="Default select example">
                                                    <option value="Saturday">Saturday</option>
                                                    <option value="Sunday">Sunday</option>
                                                    <option value="Monday">Monday</option>
                                                    <option value="Tuesday">Tuesday</option>
                                                </select>
                                            </td>
                                            <td style="min-width: 150px;">
                                                <input v-model="row.start" type="time" class="fw-6 form-control"
                                                    placeholder="Start Time">
                                            </td>
                                            <td style="min-width: 150px;">
                                                <input v-model="row.end" type="time" class="form-control"
                                                    placeholder="End Time">
                                            </td>
                                            <td style="min-width: 150px;">
                                                <input v-model="row.visitLimit" type="text" class="form-control"
                                                    placeholder="Visit Limit">
                                            </td>
                                            <td class="text-center">
                                                <button @click.prevent="addRow"
                                                    class="btn btn-sm btn-success me-1">+</button>
                                                <button @click.prevent="removeRow(index)" class="btn btn-sm btn-danger"
                                                    :disabled="rows.length === 1">-</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row form-section mb-2">
                        <div class="col-md-12">
                            <label for="mobile" class="form-label mb-0">Payment Detals</label>
                            <div class="table_size">
                                <table class="table table-bordered  table-hover table-striped ">
                                    <thead>
                                        <tr>
                                            <th style="height: 30px;">Visit Fee</th>
                                            <th style="height: 30px;">2nd Time</th>
                                            <th style="height: 30px;">3rd Time</th>
                                            <th style="height: 30px;">Payment Type</th>
                                            <th style="height: 30px;">Room Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="min-width: 150px;">
                                                <input type="text" class="form-control" v-model="form.visitfee">
                                            </td>
                                            <td style="min-width: 150px;">
                                                <div class="d-flex">
                                                    <input v-model="form.second_day" type="text" class="form-control"
                                                        style="min-width: 100px;" placeholder="Day">
                                                    <input type="text" v-model="form.second_dayFee"
                                                        class="form-control ms-2" style="min-width: 100px;"
                                                        placeholder="Fee">
                                                </div>
                                            </td>
                                            <td style="min-width: 150px;">
                                                <div class="d-flex" style="min-width: 150px;">
                                                    <input v-model="form.thired_day" type="text" class="form-control"
                                                        style="min-width: 100px;" placeholder="Day">
                                                    <input v-model="form.thired_dayFee" type="text"
                                                        class="form-control ms-2" style="min-width: 100px;"
                                                        placeholder="Fee">
                                                </div>
                                            </td>
                                            <td style="min-width: 150px;">
                                                <select v-model="form.payment_type" class="form-select "
                                                    style="min-width: 150px;">
                                                    <option value="" disabled selected>Select</option>
                                                    <option value="online">Online</option>
                                                    <option value="offline">Offline</option>
                                                    <option value="both">Offline/Online</option>
                                                </select>
                                            </td>
                                            <td style="min-width: 150px;">
                                                <div class="d-flex">
                                                    <input v-model="form.room_number" type="text"
                                                        class="form-control me-2" style="min-width: 100px;"
                                                        placeholder="Rom number">
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row form-section mb-2">
                        <div class="col-md-6">
                            <label for="mobile" class="form-label mb-0"> For Appoint Mobile</label>
                            <input v-model="form.appoinment_mobile" type="text" class="form-control" id="mobile" placeholder="+880">
                        </div>
                        <div class="col-md-6">
                            <label for="mobile" class="form-label mb-0"> For Appoint Mobile (Optional)</label>
                            <input v-model="form.appoinment_mobileOptional" type="text" class="form-control"
                                id="mobile" placeholder="+880">
                        </div>
                    </div>
                    <div class="row form-section mb-2">
                        <div class="col-md-5 mb-2 mb-md-0">
                            <label for="inputFile">Doctor Picture</label>
                            <div class="form-floating mb-3 mb-md-0">
                                <input class="form-control p-3 px-4" type="file" @change="onFileSelect" />
                            </div>
                        </div>
                        <div class="col-md-1 mt-1 mt-md-4">
                            <div class="form-floating mb-3 mb-md-0">
                                <img width="55" height="55" :src="form.doctor_image" />
                            </div>
                        </div>
                        <div class="col-md-5 mb-0 mb-md-2">
                            <label for="inputFile">Signature </label>
                            <div class="form-floating mb-3 mb-md-0">
                                <input class="form-control p-3 px-4" type="file" @change="onFileSelect1" />
                            </div>
                        </div>
                        <div class="col-md-1 mt-1 mt-md-4">
                            <div class="form-floating mb-3 mb-md-0">
                                <img width="55" height="55" :src="form.signature_image" />
                            </div>
                        </div>
                    </div>
                    <div class="row form-section mb-3">
                        <div class="col-md-12">
                            <label for="details" class="form-label">Prescription Signature Style</label>
                            <textarea v-model="form.prescription_signature_style" class="form-control" id="details"
                                style="white-space: pre-wrap; height: 150px; color: gray;"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-end">
                            <button class="btn btn-primary me-3">Save</button>
                            <button class="btn btn-success">Save & View</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Cookies from 'js-cookie';
import { onMounted, reactive, ref } from 'vue';
export default {
    name: "DoctorCreate",
    setup() {
        const currentComponent = ref(false);
        const accessToken = ref('');
        const experiences = ref([]);
        const specialists = ref([]);
        const symtoms = ref([]);
        const form = ref({
            deparment_category: '',
            regnum: '',
            doctorName: '',
            email: '',
            age: '',
            gender: '',
            details: '',
            experience: '',
            symptom: '',
            mobile: '',
            mobile_optional: '',
            visitfee: '600',
            second_day: '',
            second_dayFee: '',
            thired_day: '',
            thired_dayFee: '',
            payment_type: '',
            room_number: '',
            appoinment_mobile: '',
            appoinment_mobileOptional: '',
            doctor_image: 'https://png.pngtree.com/png-vector/20230928/ourmid/pngtree-young-afro-professional-doctor-png-image_10148632.png',
            signature_image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcShe6vu2Hqp4CatuNS5UbOhr6tUGRhU_WZ0sA&s',
            prescription_signature_style: `Dr. Md: Jasim Uddin Nizami
MBBS (BCS)
Dhaka Medical College`
        })
        const rows = ref([
            {
                day: 'Saturday',
                start: '',
                end: '',
                visitLimit: ''
            },
        ]);
        const selects = ref([
            { value: "" },
        ]);
        const symptom = ref([
            { value: "" },
        ]);


        const onFileSelect = (event) => {
            const file = event.target.files[0];
            if (file.size > 1048576) {
                Toast.fire({
                    icon: "warning",
                    title: "Image must be less than 1 MB!",
                });
            } else {
                const reader = new FileReader();
                reader.onload = (e) => {
                    form.value.doctor_image = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        };

        const onFileSelect1 = (event) => {
            const file = event.target.files[0];
            if (file.size > 1048576) {
                Toast.fire({
                    icon: "warning",
                    title: "Image must be less than 1 MB!",
                });
            } else {
                const reader = new FileReader();
                reader.onload = (e) => {
                    form.value.signature_image = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        };
        const submitForm = async () => {
            const payload = new FormData();
            Object.keys(form.value).forEach((key) => {
                payload.append(key, form.value[key]);
            });
            rows.value.forEach((row, index) => {
                Object.keys(row).forEach((key) => {
                    payload.append(`rows[${index}][${key}]`, row[key]);
                });
            });
            selects.value.forEach((select, index) => {
                payload.append(`selects[${index}]`, select.value);
            });

            symptom.value.forEach((symptom, index) => {
                payload.append(`symptom[${index}]`, symptom.value);
            });

            try {
                const response = await axios.post('/api/auth/hospital-doctor/store', payload, {
                    headers: {
                        'Authorization': `Bearer ${accessToken.value}`
                    }
                });

                console.log(response)
                if (response.data && response.data.message && response.status === 201) {
                    Swal.fire({
                        title: response.data.message,
                        icon: "success",
                        draggable: true
                    });
                }
            } catch (error) {
            }
        }

        const addRow = () => {
            rows.value.push({ day: 'Saturday', start: '', end: '', visitLimit: '' });
        };
        const removeRow = (index) => {
            if (rows.length > 1) {
                rows.splice(index, 1);
            }
        };

        const addSelect = () => {
            selects.value.push({ value: "" });
        };

        const removeSelect = (index) => {
            selects.value.splice(index, 1);
        };

        const addSymtom = () => {
            symptom.value.push({ value: "" });
        };

        const removeSymptom = (index) => {
            symptom.value.splice(index, 1);
        };

        const fetchExperience = async () => {
            try {
                const response = await axios.get(`/api/auth/experience`, {
                    headers: {
                        Authorization: `Bearer ${accessToken.value}`,
                    },
                })
                if (response.data && response.status === 200) {
                    experiences.value = response.data;
                }
            } catch (error) {

            }
        }

        const fetchSpecialist = async () => {
            try {
                const response = await axios.get('/api/auth/specialist', {
                    headers: {
                        'Authorization': `Bearer ${accessToken.value}`
                    }
                });
                if (response.data && response.status === 200) {
                    specialists.value = response.data;
                }
            } catch (error) {

            }
        }

        const fetchSymtom = async () => {
            try {
                const response = await axios.get('/api/auth/symptoms', {
                    headers: {
                        'Authorization': `Bearer ${accessToken.value}`
                    }
                });
                if (response.data && response.status === 200) {
                    symtoms.value = response.data;
                }
            } catch (error) {
            }
        }
        onMounted(async () => {
            accessToken.value = Cookies.get('access_token');
            await fetchExperience();
            await fetchSpecialist();
            await fetchSymtom();
        })
        return {
            currentComponent,
            selects,
            symptom,
            addSymtom,
            removeSymptom,
            addSelect,
            removeSelect,
            rows,
            addRow,
            removeRow,
            form,
            submitForm,
            onFileSelect,
            onFileSelect1,
            accessToken,
            experiences,
            specialists,
            symtoms
        }
    }
}
</script>

<style scoped>
.picture-box,
.signature-box {
    border: 1px solid #ddd;
    height: 100px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.signature-box {
    height: 80px;
}

.table-custom th,
.table-custom td {
    text-align: center;
    vertical-align: middle;
}

textarea {
    overflow: hidden;
    resize: none;
    font-family: "Arial", sans-serif;
    font-size: 1px;
    line-height: 1;
    white-space: pre-wrap;
    padding: 10px;
    text-align: start;
}

.table_size {
    width: 100%;
    overflow: auto;
}
</style>

<template>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3 w-100">
            <div class="d-flex w-100 mb-2 mb-sm-0">
                <router-link to="/doctor"  class="btn btn-primary ms-2">
                    + Doctor List
                </router-link>
                <router-link to="/doctor-create"  class="btn btn-primary ms-2">
                    + Doctor Create
                </router-link>
            </div>
            <div class="d-flex w-100 justify-content-end">
                <router-link to="/doctor-active" class="btn btn-success me-2">
                    Active Doctor
                </router-link>
                <router-link to="/doctor-inactive" class="btn btn-secondary">
                    Inactive Doctor
                </router-link>
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <div class="card" style="width: 1300px;">
                <div class="card-header">
                    <h5 class="card-title">Doctor Create</h5>
                </div>
                <div class="card-body">
                    <form @submit.prevent="submitForm">
                        <div class="row form-section mb-2">
                            <div class="col-md-6">
                                <label for="department" class="form-label mb-0 fw-bold">Department/Category</label>
                                <select v-model="form.deparment_category" class="form-select">
                                    <option :value="form.deparment_category" selected>{{ form.deparment_category }}
                                    </option>
                                    <option v-for="department in departments" :key="department.id"
                                        :value="department.department_category">{{ department.department_category }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="department" class="form-label mb-0 fw-bold">Reg Number</label>
                                <input v-model="form.regnum" type="text" class="form-control" id="reg-number">
                            </div>
                        </div>
                        <div class="row form-section mb-2">
                            <div class="col-md-6">
                                <label for="department" class="form-label mb-0 fw-bold">Doctor Name</label>
                                <input v-model="form.doctorName" type="text" class="form-control" id="reg-number">
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label mb-0 fw-bold">E-Mail</label>
                                <input v-model="form.email" type="email" class="form-control" id="email">
                            </div>
                        </div>

                        <div class="row form-section mb-2">
                            <div class="col-md-6">
                                <label for="age" class="form-label mb-0 fw-bold">Age</label>
                                <input v-model="form.age" type="text" class="form-control" id="age">
                            </div>
                            <div class="col-md-6">
                                <label for="gender" class="form-label mb-0 fw-bold">Gender</label>
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
                                <label for="details" class="form-label mb-0 fw-bold">Details</label>
                                <input v-model="form.details" class="form-control" id="details" />
                            </div>
                            <div class="col-md-6">
                                <label for="experience" class="form-label mb-0 fw-bold">Experience</label>
                                <input v-model="form.experience" type="text" class="form-control" id="experience">
                            </div>
                        </div>
                        <div class="row form-section mb-2">
                            <div class="col-md-12">
                                <label for="specialist" class="form-label mb-0 fw-bold">Specialist</label>
                                <div v-for="(item, index) in selects" :key="item.id"
                                    class="d-flex align-items-center mb-2">
                                    <select class="form-select flex-grow-1 me-2" v-model="item.value"
                                        aria-label="Default select example">
                                        <option selected disabled value="">Open this select menu</option>
                                        <option v-for="opt in selects" :key="opt.id" :value="opt.value">{{ opt.value }}
                                        </option>
                                    </select>
                                    <div class="d-flex">
                                        <button type="button" class="btn btn-success me-1" v-if="index === 0"
                                            @click="addSelect">+</button>
                                        <button type="button" class="btn btn-danger" v-if="index !== 0"
                                            @click="removeSelect(index)">-</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-section mb-2">
                            <div class="col-md-12">
                                <label for="symptom" class="form-label mb-0 fw-bold">Symptom</label>
                                <div v-for="(item, index) in symptom" :key="index"
                                    class="d-flex align-items-center mb-2">
                                    <select class="form-select flex-grow-1 me-2" v-model="item.value"
                                        aria-label="Default select example">
                                        <option value="" disabled selected>Open this select menu</option>
                                        <option :value="item.value">{{ item.value }}</option>
                                    </select>

                                    <div class="d-flex">
                                        <button type="button" class="btn btn-success me-1" v-if="index === 0"
                                            @click="addSymtom">+</button>
                                        <button type="button" class="btn btn-danger" v-if="index !== 0"
                                            @click="removeSymptom(index)">-</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row form-section mb-2">
                            <div class="col-md-6">
                                <label for="mobile" class="form-label mb-0 fw-bold">Mobile</label>
                                <input v-model="form.mobile" type="text" class="form-control" id="mobile">
                            </div>
                            <div class="col-md-6">
                                <label for="mobile" class="form-label mb-0 fw-bold">Optional Mobile</label>
                                <input v-model="form.mobile_optional" type="text" class="form-control" id="mobile">
                            </div>
                        </div>
                        <div class="row form-section mb-2">
                            <div class="col-md-12">
                                <label for="mobile" class="form-label mb-0 fw-bold">Schedule</label>
                                <div class="table_size">
                                    <table class="table table-bordered table-hover table-striped">
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
                                                        <option :value="row.day">{{ row.day }}</option>
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
                                                    <button @click.prevent="addRow" class="btn btn-success me-1"
                                                        v-if="index === 0">+</button>
                                                    <button @click.prevent="removeRow(index)" class="btn btn-danger"
                                                        v-if="index !== 0">-</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="row form-section mb-2">
                            <div class="col-md-12">
                                <label for="mobile" class="form-label mb-0 fw-bold">Payment Detals</label>
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
                                                        <input v-model="form.second_day" type="text"
                                                            class="form-control" style="min-width: 100px;"
                                                            placeholder="Day">
                                                        <input type="text" v-model="form.second_dayFee"
                                                            class="form-control ms-2" style="min-width: 100px;"
                                                            placeholder="Fee">
                                                    </div>
                                                </td>
                                                <td style="min-width: 150px;">
                                                    <div class="d-flex" style="min-width: 150px;">
                                                        <input v-model="form.thired_day" type="text"
                                                            class="form-control" style="min-width: 100px;"
                                                            placeholder="Day">
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
                                <label for="mobile" class="form-label mb-0 fw-bold"> For Appoint Mobile</label>
                                <input v-model="form.appoinment_mobile" type="text" class="form-control" id="mobile">
                            </div>
                            <div class="col-md-6">
                                <label for="mobile" class="form-label mb-0 fw-bold"> For Appoint Mobile
                                    (Optional)</label>
                                <input v-model="form.appoinment_mobileOptional" type="text" class="form-control"
                                    id="mobile">
                            </div>
                        </div>
                        <div class="row form-section mb-2">
                            <div class="col-md-5 mb-2 mb-md-0">
                                <label for="inputFile" class="fw-bold">Doctor Picture</label>
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
                                <label for="inputFile" class="fw-bold">Signature </label>
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
                                <label for="details" class="form-label mb-0 fw-bold">Prescription Signature
                                    Style</label>
                                <input v-model="form.prescription_signature_style" class="form-control" id="details"
                                    style="height: 60px;" />
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
    </div>
</template>

<script>
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';
import Cookies from 'js-cookie';
export default {
    name: 'DoctorEdit',
    setup() {
        const access_token = ref('');
        const route = useRoute();
        const doctor_id = ref('');
        const departments = ref([]);
        const doctor = ref({});
        const currentComponent = ref(false);
        const accessToken = ref('');
        const doctor_shedules = ref([]);
        const form = ref({
            doctor_id: '',
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
            prescription_signature_style: "",
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

            symptom.value.forEach((select, index) => {
                payload.append(`symptom[${index}]`, select.value);
            });

            try {
                const response = await axios.post('/api/auth/hospital-doctor/update', payload, {
                    headers: {
                        'Authorization': `Bearer ${access_token.value}`
                    }
                });

                console.log(response)
                if (response.data && response.data.message && response.status === 200) {
                    Swal.fire({
                        title: response.data.message,
                        icon: "success",
                        draggable: true
                    });
                }
            } catch (error) {
                console.error('Error:', error.response?.data || error.message);
            }
        }
        const addRow = () => {
            rows.value.push({ day: 'Saturday', start: '', end: '', visitLimit: '' });
        };
        const removeRow = (index) => {
            if (rows.value.length > 1) {
                rows.value.splice(index, 1);
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


        const doctorView = async () => {
            const response = await axios.get(`/api/auth/hospital-doctor/doctor-view/${doctor_id.value}`, {
                headers: {
                    'Authorization': `Bearer ${access_token.value}`,
                },
            });

            if (response.data && response.data.message && response.status == 200) {
                console.log(response)
                doctor.value = response.data.doctor;
                form.value.doctor_id = doctor.value.id;
                form.value.deparment_category = doctor.value.deparment_category;
                form.value.regnum = doctor.value.regnum
                form.value.doctorName = doctor.value.doctorName
                form.value.email = doctor.value.email
                form.value.age = doctor.value.age
                form.value.gender = doctor.value.gender
                form.value.details = doctor.value.details
                form.value.experience = doctor.value.experience

                selects.value = doctor.value.Specialist.map(specialist => ({ value: specialist }));
                symptom.value = doctor.value.symptom.map(symptom => ({ value: symptom }));

                form.value.mobile = doctor.value.mobile
                form.value.mobile_optional = doctor.value.mobile_optional
                form.value.visitfee = doctor.value.visitfee
                form.value.second_day = doctor.value.second_day
                form.value.second_dayFee = doctor.value.second_dayFee
                form.value.thired_day = doctor.value.thired_day
                form.value.thired_dayFee = doctor.value.thired_dayFee
                form.value.payment_type = doctor.value.payment_type
                form.value.room_number = doctor.value.room_number
                form.value.appoinment_mobile = doctor.value.appoinment_mobile
                form.value.appoinment_mobileOptional = doctor.value.appoinment_mobileOptional
                form.value.prescription_signature_style = doctor.value.prescription_signature_style
                form.value.doctor_image = doctor.value.doctor_image
                form.value.signature_image = doctor.value.signature_image

                let jsonString = doctor.value.Shedule
                doctor_shedules.value = JSON.parse(jsonString);
                rows.value = doctor_shedules.value

                const doctorPicturePath = doctor.value.doctor_image
                const doctoreImage = await fetch(doctorPicturePath);
                if (doctoreImage.ok) {
                    const imageBlob = await doctoreImage.blob();
                    const reader = new FileReader();
                    reader.onloadend = () => {
                        form.value.doctor_image = reader.result;
                    };
                    reader.readAsDataURL(imageBlob);
                } else {
                    console.error("Image fetch failed:", doctoreImage.statusText);
                }

                const signaturePicturePath = doctor.value.signature_image;
                const signatureImage = await fetch(signaturePicturePath);
                if (signatureImage.ok) {
                    const imageBlob = await signatureImage.blob();
                    const reader = new FileReader();
                    reader.onloadend = () => {
                        form.value.signature_image = reader.result;
                    };
                    reader.readAsDataURL(imageBlob);
                } else {
                    console.error("Image fetch failed:", signatureImage.statusText);
                }
            }
        }



        onMounted(async () => {
            access_token.value = Cookies.get('access_token');
            doctor_id.value = route.params.id;
            await doctorView();
            await fetchDepartment();
        });
        return {
            doctor_id,
            currentComponent,
            selects,
            symptom,
            addSelect,
            removeSelect,
            addSymtom,
            removeSymptom,
            rows,
            addRow,
            removeRow,
            form,
            submitForm,
            onFileSelect,
            onFileSelect1,
            accessToken,
            doctorView,
            doctor,
            doctor_shedules,
            departments
        }
    }
}
</script>

<style scoped>
.table_size {
    width: 100%;
    overflow: auto;
}
</style>
<template>
    <div class="container d-flex align-items-center justify-content-center py-4"
        style="min-height: 100vh; overflow: hidden">

        <div class="row justify-content-center" style="width: 100%; height: 100%">
            <div class="col-lg-10 col-md-12" style="max-width: 1300px; width: 100%; height: 100%">
                <div class="card dd card-primary" style="height: 100%; width: 100%; overflow: hidden">
                    <h3 class="text-center mt-4">{{ heading }}</h3>
                    <div class="card-body dd d-flex flex-column flex-lg-row align-items-center p-lg-5 p-3"
                        style="overflow-y: auto; height: 100%; max-height: calc(100vh - 90px);">
                        <div class="hospital_image w-100 w-lg-50 mb-4 mb-lg-0 text-center">
                            <img src="../../../../../../public/hospital/backend/app/assets/img/heartboard-1.png"
                                class="img-fluid" style="max-width: 550px; height: auto" alt="Hospital Image" />
                        </div>
                        <div
                            class="login-container w-100 w-lg-50 d-flex flex-column justify-content-center align-items-center">
                            <form enctype="multipart/form-data" v-show="currentStep === 'initialForm'"
                                @submit.prevent="storeData('otpCheck')" class="w-100 px-3 p-3">
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <input type="text" class="form-control" placeholder="Hospital Name" required
                                            v-model="hospitalRegForm.hospital_name" />
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <input type="text" class="form-control" placeholder="Reg. Number" required
                                            v-model="hospitalRegForm.reg_number" />
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <input type="text" class="form-control" placeholder="Establish" required
                                            v-model="hospitalRegForm.establish" />
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <select class="form-control form-select" aria-label="Default select example"
                                            v-model="hospitalRegForm.country">
                                            <option value="" selected>select country</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Pakisthan">Pakisthan</option>
                                            <option value="India">India</option>
                                            <option value="Nepal">Nepal</option>
                                            <option value="Vhutan">Vhutan</option>
                                            <option value="Srilankha">Srilankha</option>
                                            <option value="Maldhip">Maldhip</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <select v-model="hospitalRegForm.division" @change="onDivisionChange"
                                            class="form-control form-select" aria-label="Division select">
                                            <option value="" disabled selected>Select Division</option>
                                            <option v-for="division in divisions" :key="division.id"
                                                :value="division.name">
                                                {{ division.name }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <select v-model="hospitalRegForm.district" @change="onDistrictChange"
                                            class="form-control form-select" aria-label="District select">
                                            <option value="" disabled selected>Select District</option>
                                            <option v-for="district in filteredDistricts" :key="district.name"
                                                :value="district.name">
                                                {{ district.name }}
                                            </option>
                                        </select>


                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <select v-model="hospitalRegForm.sub_district" class="form-control form-select"
                                            aria-label="Sub-District select">
                                            <option value="" disabled selected>Select Sub-District</option>
                                            <option v-for="subDistrict in filteredSubDistricts" :key="subDistrict"
                                                :value="subDistrict">
                                                {{ subDistrict }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <input type="text" class="form-control" placeholder="Location Details" required
                                            v-model="hospitalRegForm.location_details" />
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <input type="tel" class="form-control" placeholder="Hospital Mobile Number"
                                            required v-model="hospitalRegForm.mobile_number_1" />
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <input type="tel" class="form-control" placeholder="Admin Mobile Number"
                                            required v-model="hospitalRegForm.mobile_number_2" />
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <input type="email" class="form-control" placeholder="Hospital E-Mail" required
                                            v-model="hospitalRegForm.email" />
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <input type="text" class="form-control" placeholder="Admin Name" required
                                            v-model="hospitalRegForm.admin_name" />
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <input type="tel" class="form-control" placeholder="Admin Mobile" required
                                            v-model="hospitalRegForm.admin_mobile" />
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <input type="email" class="form-control" placeholder="Admin E-Mail" required
                                            v-model="hospitalRegForm.admin_email" />
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <input type="password" class="form-control" placeholder="Password" required
                                            v-model="hospitalRegForm.password" />
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <input type="password" class="form-control" placeholder="Re-Password" required
                                            v-model="hospitalRegForm.re_password" />
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="form-label">Logo</label>
                                        <input type="file" class="form-control" @change="onFileSelect" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Hospital/Medical Front Picture</label>
                                        <input type="file" class="form-control" @change="onFileSelect2" />
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary w-100">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div v-if="currentStep === 'otpCheck'" class="text-center mb-1">
                                <p v-if="timer > 0" class="text-success fw-bold mb-0">OTP send to : {{
                                    hospitalRegForm.admin_email }}</p>
                                <p v-if="timer > 0" class="text-danger fw-bold mb-0">OTP expired on: {{ formattedTimer
                                    }}</p>
                                <p v-else class="text-danger fw-bold mb-0">Time is up! Please restart the process or
                                    resend OTP.</p>
                                <p v-if="timer > 0" class="text-danger fw-bold mb-0">{{ otpText }}</p>
                                <button v-if="timer === 0" class="btn btn-primary w-100 mb-2"
                                    @click="storeData('otpCheck')">Resend
                                    Otp?</button>
                            </div>
                            <form enctype="multipart/form-data" v-if="timer > 0" v-show="currentStep === 'otpCheck'"
                                @submit.prevent="storeData('storeHospital')" class="w-100 px-3">
                                <div class="mb-3">
                                    <input type="text" class="form-control w-100" placeholder="Enter your OTP" required
                                        v-model="hospitalRegForm.otp" />
                                </div>
                                <button class="btn btn-primary w-100">Check Otp</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { ref, computed } from "vue";
import { useRouter } from 'vue-router';
import divisions from '../../../Helpers/Address';
export default {
    name: "Register",
    setup() {
        const router = useRouter();
        const currentStep = ref("initialForm");
        const heading = ref('Welcome To Sign Up');
        const timer = ref(0);
        const buttonDesable = ref(false);
        let timerInterval = null;
        const otpText = ref('');
        const errors = ref({});
        const hospitalRegForm = ref({
            hospital_name: '',
            reg_number: '',
            establish: '',
            country: '',
            division: '',
            district: '',
            sub_district: '',
            location_details: '',
            mobile_number_1: '',
            mobile_number_2: '',
            email: '',
            admin_name: '',
            admin_mobile: '',
            admin_email: '',
            password: '',
            re_password: '',
            logo: null,
            front_picture: null,
            otp: ''
        })

        const filteredDistricts = ref([]);
        const filteredSubDistricts = ref([]);

        const onDivisionChange = () => {
            const selectedDivisionName = hospitalRegForm.value.division;
            const division = divisions.value.find((div) => div.name === selectedDivisionName);
            filteredDistricts.value = division ? division.districts : [];
            hospitalRegForm.value.district = "";
            filteredSubDistricts.value = [];
        };

        // Handle District Change
        const onDistrictChange = () => {
            const selectedDistrictName = hospitalRegForm.value.district;
            const district = filteredDistricts.value.find((dist) => dist.name === selectedDistrictName);
            filteredSubDistricts.value = district ? district.subDistricts : [];
            hospitalRegForm.value.sub_district = ""; 
        };


        const onFileSelect = (event) => {
            const file = event.target.files[0];
            if (file.size > 2048576) {
                Toast.fire({
                    icon: "warning",
                    title: "Image must be less than 2 MB!",
                });
            } else {
                const reader = new FileReader();
                reader.onload = (e) => {
                    hospitalRegForm.value.logo = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        };
        const onFileSelect2 = (event) => {
            const file = event.target.files[0];
            if (file.size > 2048576) {
                Toast.fire({
                    icon: "warning",
                    title: "Image must be less than 2 MB!",
                });
            } else {
                const reader = new FileReader();
                reader.onload = (e) => {
                    hospitalRegForm.value.front_picture = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        };

        const storeData = async (nextStep) => {
            if (nextStep === 'otpCheck') {
                hospitalRegForm.value.otp = '';
                otpText.value = '';
                try {
                    const response = await axios.post('/api/auth/send_otp', {
                        admin_email: hospitalRegForm.value.admin_email,
                    });
                    console.log(response)
                    if (response.data) {
                        heading.value = "Check Your Email For Otp"
                        startTimer();
                        currentStep.value = nextStep;
                    }
                } catch (error) {
                    console.log(error)
                }
            }
            if (nextStep === 'storeHospital') {
                try {
                    const response = await axios.post('/api/auth/signup', hospitalRegForm.value);
                    if (response.data) {
                        router.push({ name: 'Login' });
                    }
                } catch (error) {
                    otpText.value = error.response.data.otpMessage;
                }
            }
        };
        const startTimer = () => {
            timer.value = 120;
            timerInterval = setInterval(() => {
                if (timer.value > 0) {
                    timer.value -= 1
                }
                else {
                    stopTimer();
                    otpText.value = '';
                }
            }, 1000)
        }
        const stopTimer = () => {
            timer.value = 0;
            otpText.value = '';
            if (timerInterval) {
                clearInterval(timerInterval);
                timerInterval = null
            }
        }

        const formattedTimer = computed(() => {
            const minutes = Math.floor(timer.value / 60);
            const seconds = timer.value % 60;
            return `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
        });

        const resetForm = () => {
            hospitalRegForm.value = {
                hospital_name: '',
                reg_number: '',
                establish: '',
                country: '',
                division: '',
                district: '',
                sub_district: '',
                location_details: '',
                mobile_number_1: '',
                mobile_number_2: '',
                email: '',
                admin_name: '',
                admin_mobile: '',
                admin_email: '',
                password: '',
                re_password: '',
                logo: null,
                front_picture: null,
                otp: ''
            };
        };
        return {
            heading,
            currentStep,
            storeData,
            timer,
            buttonDesable,
            formattedTimer,
            hospitalRegForm,
            onFileSelect,
            onFileSelect2,
            otpText,
            resetForm,
            errors,
            divisions,
            filteredDistricts,
            filteredSubDistricts,
            onDivisionChange,
            onDistrictChange,
        };
    },
};
</script>

<style scoped>
.custom-input {
    color: black;
    /* Input text color */
}

.custom-input::placeholder {
    color: rgb(209, 204, 204);
    /* Placeholder text color */
}
</style>
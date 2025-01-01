<template>
    <div>
        <header>
            <nav class="navbar navbar-expand-lg custom-navbar">
                <div class="container-fluid">
                    <a class="navbar-brand bg-white d-flex align-items-center" href="#">
                        <img src="../../../../../public/hospital/backend/app/assets/images/doctor_appoinment_logo.png"
                            alt="Logo">
                    </a>
                    <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item"><a class="nav-link" href="#">Hospital</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Doctor</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Symptoms</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Pathology</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Medicine</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Primacy</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Ambulance</a></li>
                        </ul>
                        <ul class="navbar-nav">
                            <li class="nav-item"><a class="nav-link" href="#">Login</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Sign Up</a></li>
                            <li class="nav-item"><a class="nav-link fw-bold" href="#">Hospital</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <main>
            <section>
                <div class="row align-items-center py-3 mx-5">
                    <div class="col-md-3 text-center text-md-start">
                        <h5>সহেজই প্রোফাইল তৈরি করুন</h5>
                        <div class="list_free_image d-flex justify-content-center justify-content-md-start">
                            <div class="list">
                                <ul>
                                    <li>হসিপটাল</li>
                                    <li>ডাক্তার</li>
                                    <li>নার্স</li>
                                    <li>রোগী/জনােরল</li>
                                </ul>
                            </div>
                            <div class="free">
                                <img src="../../../../../public/hospital/backend/app/assets/images/free.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 text-center  mb-2 mb-md-0">
                        <div class="card hospitalist custom-width" style="height: 5rem;">
                            <div class="card-body">
                                <div class="plus_log_quantity d-flex justify-content-center align-items-center">
                                    <div class="plus_logo">
                                        <img src="../../../../../public/hospital/backend/app/assets/images/plus-Photoroom.png"
                                            alt="">
                                    </div>
                                    <div class="quantity text-white ms-3">
                                        <p class="text-center">Hospitalist <br> 412</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 text-center  mb-2 mb-md-0">
                        <div class="card hospitalist custom-width" style="height: 5rem;">
                            <div class="card-body">
                                <div class="plus_log_quantity d-flex justify-content-center align-items-center">
                                    <div class="plus_logo">
                                        <img src="../../../../../public/hospital/backend/app/assets/images/microcifs-Photoroom.png"
                                            alt="">
                                    </div>
                                    <div class="quantity text-white ms-3">
                                        <p class="text-center">Doctor<br>4875</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 text-center  mb-2 mb-md-0">
                        <div class="card hospitalist custom-width" style="height: 5rem;">
                            <div class="card-body">
                                <div class="plus_log_quantity d-flex justify-content-center align-items-center">
                                    <div class="plus_logo">
                                        <img src="../../../../../public/hospital/backend/app/assets/images/heart-removebg-preview.png"
                                            alt="">
                                    </div>
                                    <div class="quantity text-white ms-3">
                                        <p class="text-center">Patient<br>12545</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 text-center text-md-end">
                        <h2 class="doctor_text_color_header fw-bold">ডাক্তার খুঁজছেন?</h2>
                        <h5 class="here_have_text_color">এখানে আছ...</h5>
                    </div>
                </div>
            </section>
            <section>
                <div class="row  py-1 mx-5">
                    <div class="col-md-3 search_doctor mb-3">
                        <div class="row mb-3">
                            <p class="doctor_text_color text-center p-1">Doctor</p>
                            <div class="seler_tag mb-2">
                                <label for="symptoms">Symptoms</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="specialist mb-2">
                                <label for="specialist">Specialist</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="gender_experiance mb-2">
                                <div class="row">
                                    <div class="col-md-6">
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Male">Female</option>
                                            <option value="Male">Others</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Experience</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="divison_district mb-2">
                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- <select class="form-select" aria-label="Default select example">
                                            <option selected>Division</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select> -->
                                        <select v-model="hospitalRegForm.division" @change="onDivisionChange"
                                            class="form-select" aria-label="Default select example">
                                            <option value="" disabled selected>Select Division</option>
                                            <option v-for="division in divisions" :key="division.id"
                                                :value="division.name">
                                                {{ division.name }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- <select class="form-select" aria-label="Default select example">
                                            <option selected>District</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select> -->
                                        <select v-model="hospitalRegForm.district" @change="onDistrictChange"
                                            class="form-select" aria-label="Default select example">
                                            <option value="" disabled selected>Select District</option>
                                            <option v-for="district in filteredDistricts" :key="district.name"
                                                :value="district.name">
                                                {{ district.name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="specialist mb-2">
                                <!-- <select class="form-select" aria-label="Default select example">
                                    <option selected>Sub District</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select> -->
                                <select v-model="hospitalRegForm.sub_district" class="form-select"
                                    aria-label="Default select example">
                                    <option value="" disabled selected>Select Sub-District</option>
                                    <option v-for="subDistrict in filteredSubDistricts" :key="subDistrict"
                                        :value="subDistrict">
                                        {{ subDistrict }}
                                    </option>
                                </select>
                            </div>

                            <div class="specialist mb-3">
                                <label for="specialist">Hospital</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="searchbutton text-center mb-3">
                                <button
                                    class="btn btn-sm text-white fw-bold w-25 search_button_background_color">Search...</button>
                            </div>
                        </div>
                        <div class="row">
                            <p class="doctor_text_color text-center p-1">Pathology</p>
                            <div class="seler_tag mb-2">
                                <label for="symptoms">Symptoms</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="divison_district mb-2">
                                <div class="row">
                                    <div class="col-md-6">
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Division</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>District</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="specialist mb-2">
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Sub District</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>

                            <div class="specialist mb-3">
                                <label for="specialist">Hospital</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="searchbutton text-center mb-3">
                                <button
                                    class="btn btn-sm text-white fw-bold w-25 search_button_background_color">Search...</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <template v-for="(doctor, index) in doctors" :key="doctor.id">
                                <div class="col-12 col-md-4 mb-3">
                                    <div class="card" style="width: 100%;">
                                        <div class="card-body doctore_search_row">
                                            <div
                                                class="doctor_details d-flex flex-column flex-md-row justify-content-between align-items-center">
                                                <div class="doctor_image_andothers text-center mb-3 mb-md-0">
                                                    <img :src="doctor.doctor_image" class="rounded-circle mb-2"
                                                        width="150px" height="150px" alt="">
                                                    <p class="text-center mb-0">{{ doctor.regnum }}</p>
                                                </div>
                                                <div class="doctor_profile text-center text-md-start text-justify">
                                                    <h5 class="mb-0">{{ doctor.doctorName }}</h5>
                                                    <div>
                                                        <p v-for="(exp, i) in splitExperience(doctor.experience)"
                                                            :key="i" class="mb-0">
                                                            {{ exp }}
                                                        </p>
                                                    </div>
                                                    <p class="fw-bold mb-0">Specialist</p>
                                                    <span v-for="(specialist, index) in doctor.Specialist" :key="index">
                                                        {{ specialist }}<span
                                                            v-if="index !== doctor.Specialist.length - 1">, </span>
                                                    </span>
                                                    <p class="fw-bold mb-0">Proposer</p>
                                                    <p class="mb-0">Department of {{ doctor.deparment_category }}</p>
                                                    <p class="mb-0">{{ doctor.details }}</p>
                                                    <p class="mb-0">{{ doctor.mobile }}</p>
                                                </div>
                                            </div>
                                            <div
                                                class="doctorview_appoinment d-flex flex-column flex-md-row justify-content-between align-items-center mt-3">
                                                <div class="doctor_view mb-2 mb-md-0 ms-md-3">
                                                    <router-link
                                                        :to="{ name: 'DoctorviewOffline', params: { id: doctor.id } }"
                                                        class="btn btn-sm btn-info text-white rounded-pill">Doctor
                                                        View</router-link>
                                                </div>
                                                <div class="appoinment">
                                                    <button
                                                        class="btn btn-sm btn-info text-white button_background_color rounded-pill">Appointment</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div v-if="(index + 1) % 6 === 0"
                                    class="row py-3 mx-0 free_campain text-center align-items-center mb-3">
                                    <div class="col-md-3">
                                        <h1 class="text-white">ফ্রি</h1>
                                    </div>
                                    <div class="col-md-3">
                                        <h5 class="mb-0 text-white">বুকিং চলেছ</h5>
                                        <p class="text-white">Noya polton Dhaka</p>
                                    </div>
                                    <div class="col-md-3">
                                        <h5 class="mb-0">Date Time</h5>
                                        <p class="text-white mb-0">12/12/2024</p>
                                        <p class="mb-2 text-white">10:30am - 05:30pm</p>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="ibnsinapicture text-center mb-0">
                                            <img src="../../../../../public/hospital/backend/app/assets/images/ibnsina.png"
                                                width="40px" height="40px" alt="">
                                        </div>
                                        <h4 class="text-center">Ibn Sina Hospital</h4>
                                    </div>
                                </div>
                            </template>
                        </div>

                    </div>
                </div>
            </section>
        </main>

        <footer>
            <div class="text-center py-0">
                <!-- Download Links -->
                <div class="d-flex flex-column flex-md-row justify-content-center align-items-center mb-3">
                    <a href="#" class="mb-2 mb-md-0 me-md-2">
                        <img src="../../../../../public/hospital/backend/app/assets/images/windows_download.png"
                            alt="Download for Windows" width="100px">
                    </a>
                    <a href="#" class="mb-2 mb-md-0 me-md-2">
                        <img src="../../../../../public/hospital/backend/app/assets/images/googleplay.png"
                            alt="Google Play" width="100px">
                    </a>
                    <a href="#">
                        <img src="../../../../../public/hospital/backend/app/assets/images/app_store.png"
                            alt="App Store" width="100px">
                    </a>
                </div>
                <!-- Social Media Icons -->
                <div class="social-icons mb-3">
                    <a href="#"><i class="fab fa-facebook facebook"></i></a>
                    <a href="#"><i class="fab fa-telegram telegram"></i></a>
                    <a href="#"><i class="fab fa-whatsapp whatsapp"></i></a>
                    <a href="#"><i class="fab fa-youtube youtube"></i></a>
                </div>
                <!-- Footer Link -->
                <div class="footer">
                    <span>www.healingbd.com</span>
                </div>
            </div>
        </footer>

    </div>
</template>

<script>
import axios from 'axios';
import { onMounted, ref, computed } from 'vue';
import divisions from '../../Helpers/Address';
import Cookies from 'js-cookie';
export default {
    name: "Home",
    setup() {
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
        const doctors = ref([]);
        const filteredDistricts = ref([]);
        const filteredSubDistricts = ref([]);
        const access_token = ref('');

        const onDivisionChange = () => {
            const selectedDivisionName = hospitalRegForm.value.division;
            const division = divisions.value.find((div) => div.name === selectedDivisionName);
            filteredDistricts.value = division ? division.districts : [];
            hospitalRegForm.value.district = "";
            filteredSubDistricts.value = [];
        };

        const onDistrictChange = () => {
            const selectedDistrictName = hospitalRegForm.value.district;
            const district = filteredDistricts.value.find((dist) => dist.name === selectedDistrictName);
            filteredSubDistricts.value = district ? district.subDistricts : [];
            hospitalRegForm.value.sub_district = "";
        };

        const fetchDoctor = async () => {
            const response = await axios.get('/api/auth/hospital-doctor');
            console.log(response.data);
            doctors.value = response.data;
        }

        const fetchHospital = async () => {
            const response = await axios.get('/api/auth/me', {
                headers: {
                    'Authorization': `Bearer ${access_token}`
                }
            })
            console.log(response)
        }
        const splitExperience = (experience) => {
            return (experience || "")
                .split(".")
                .map((item) => item.trim())
                .filter((item) => item.length > 0);
        };
        onMounted(async () => {
            await fetchDoctor();
            fetchHospital();
            access_token.value = Cookies.get('access_token');
        })
        return {
            access_token,
            fetchHospital,
            doctors,
            divisions,
            splitExperience,
            filteredDistricts,
            filteredSubDistricts,
            onDivisionChange,
            onDistrictChange,
            hospitalRegForm
        }
    }
}
</script>

<style scoped>
body {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.custom-navbar {
    background-color: #8b52ff;
    color: white;
    padding: 0px 100px;
}

.custom-navbar .nav-link {
    color: white;
}

.custom-navbar .nav-link:hover {
    text-decoration: underline;
}

.navbar-brand img {
    height: auto;
    width: 50px;
}

.custom-toggler {
    border: none;
    background: none;
    outline: none;
    box-shadow: none;
}

.custom-toggler:focus {
    outline: none;
    box-shadow: none;
}

.custom-toggler .navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='white' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
}

.list_free_image {
    margin-top: 1rem;
}

.hospitalist {
    background-color: #f51b98;
    border-radius: 25px;
}

.plus_logo {
    margin-top: -15px;
}

.doctor_text_color_header {
    color: #02be63;
}

.here_have_text_color {
    color: #084fae
}

.button_background_color {
    background-color: #02be63;
}

.text-justify {
    text-align: justify;
}

.free_campain {
    background-image: linear-gradient(to right, #8b5cf6, #3bc6e9);
    width: 100%;
    border-radius: 5px;
}

.search_doctor {
    background-color: #e6e6e6;
}

.footer {
    background-color: #f50992;
    color: white;
    text-align: center;
    padding: 10px 0;
}

.social-icons a {
    margin: 0 10px;
    font-size: 1.5rem;
    color: #555;
}

.social-icons a .youtube {
    color: #ff4848;
}

.social-icons a .whatsapp {
    color: #7db445;
}

.social-icons a .telegram {
    color: #3bacde;
}

.social-icons a .facebook {
    color: #214c8b;
}

@media (max-width: 768px) {
    .navbar-nav {
        text-align: center;
    }

    .navbar-nav .nav-item {
        margin: 5px 0;
    }

    .custom-navbar .nav-link {
        font-size: 0.9rem;
    }

    .custom-navbar {
        padding: 0px 0px;
    }

    .navbar-nav .nav-item {
        margin: 5px 0;
    }
}

.custom-width {
    width: 13rem;
}

.doctor_text_color {
    background-color: #b4cff4;
    color: black
}

.search_button_background_color {
    background-color: #5f68b4;
}

.doctore_search_row {
    background-color: #f6f6f7;
}

.doctor_profile {
    font-size: 12px;
}

@media (max-width: 576px) {
    .navbar-brand img {
        width: 40px;
    }
}

@media (max-width: 768px) {
    .custom-width {
        width: 18rem;
    }
}
</style>
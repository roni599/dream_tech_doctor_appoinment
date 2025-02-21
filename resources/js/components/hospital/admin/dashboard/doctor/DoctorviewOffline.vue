<template>
    <div class="profile-card mt-3">
        <div
            class="hospital-title d-flex justify-content-center align-items-center hospitalnamebackground mb-4 p-2 text-white">
            <div class="hospital_image">
                <img src="https://ibnsinasylhet.reviewyoursite.co.uk/wp-content/uploads/2020/06/logo.png" width="100px"
                    height="100px" alt="">
            </div>
            <div class="hospital_details">
                <h2 class="mb-0">Ibna Sina Hospitalet </h2>
                <p class="mb-0 font_size_address">House# 68, Road # 15/A, Dhanmondi, Dhaka-1206</p>
                <p class="mb-0 font_size_address">01984-994406, 0178344090</p>
            </div>
        </div>
        <div class="profile">
            <div class="doctor-symtop">
                <div class="row d-flex justify-between align-items-center">
                    <div class="col-md-4 text-center mb-3">
                        <img v-if="doctor.doctor_image" :src="doctor.doctor_image" alt="Doctor" class="doctor-image">
                    </div>
                    <div class="col-md-8 doctor-details">
                        <h4 class="fw-bold">{{ doctor.doctorName }}</h4>
                        <div class="mb-2">
                            <p v-for="(line) in splitExperience(doctor.details)" :key="line.id" class="mb-0">
                                {{ line }}
                            </p>
                        </div>
                        <p class="mb-1"><strong>Specialist: </strong><br>
                            <span v-for="(specialist, index) in doctor.Specialist" :key="index">
                                {{ specialist }}<span v-if="index !== doctor.Specialist.length - 1">, </span>
                            </span>
                        </p>
                        <p class="mb-2"><strong>Proposer:</strong><br> Department of {{ doctor.deparment_category }}</p>
                        <p class="mb-1">Reg. No: <strong>{{ doctor.regnum }}</strong></p>
                        <p><strong>Contact:</strong> {{ doctor.mobile }}</p>
                    </div>
                </div>
                <hr>
                <h5>Symptom</h5>
                <ul class="symptom-list">
                    <li v-for="symtom in symptoms" :key="symtom.id">{{ symtom }}</li>
                </ul>
            </div>
            <table class="table table-bordered mt-4">
                <thead class="table-primary">
                    <tr>
                        <th style="height: 30px; background-color: #0cbfde; color: white;">Days</th>
                        <th style="height: 30px; background-color: #0cbfde; color: white;">Start Time</th>
                        <th style="height: 30px; background-color: #0cbfde; color: white;">End Time</th>
                        <!-- <th style="height: 30px; background-color: #0cbfde; color: white;">Visit Limit</th> -->
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="doctorshedule in doctor_shedules" :key="doctorshedule.id">
                        <td>{{ doctorshedule.day }}</td>
                        <td>{{ doctorshedule.start }}</td>
                        <td>{{ doctorshedule.end }}</td>
                        <!-- <td>{{ doctorshedule.visitLimit }}</td> -->
                    </tr>
                </tbody>
            </table>
            <div class="text-end mt-3">
                <a href="#" class="btn appointment-btn">Appointment</a>
            </div>
            <div class="text-center mt-2 contact-info">
                <p><i class="fa-solid fa-phone phone-colore p-2 text-white rounded-circle"></i> {{ doctor.mobile }}</p>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { computed, onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';
export default {
    name: "DoctorviewOffline",
    setup() {
        const route = useRoute();
        const doctor_id = ref('');
        const doctor = ref({});
        const doctor_shedules = ref([]);
        const symptoms = ref([]);
        const doctorView = async () => {
            const response = await axios.get(`/api/auth/hospital-doctor/doctor-viewoffline/${doctor_id.value}`)
            console.log(response.data.doctor);
            if (response.data && response.data.message && response.status == 200) {
                doctor.value = response.data.doctor;
                symptoms.value = response.data.doctor.symptom;
                let jsonString = response.data.doctor.Shedule
                doctor_shedules.value = JSON.parse(jsonString);
            }
        }

        const splitExperience = (experience) => {
            const formattedExperience = (experience || "")
                .split(",")
                .map((item) => item.trim())
                .filter((item) => item.length > 0);

            const groupedLines = [];
            let firstLine = [];
            let currentLine = [];

            for (let i = 0; i < formattedExperience.length; i++) {
                const item = formattedExperience[i];

                if (firstLine.length < 3) {
                    if (item.length > 4) {
                        if (firstLine.length > 0) {
                            groupedLines.push(firstLine.join(", "));
                        }
                        groupedLines.push(item);
                        firstLine = [];
                        currentLine = formattedExperience.slice(i + 1);
                        break;
                    } else {
                        firstLine.push(item);
                    }
                }

                if (firstLine.length === 3 || i === formattedExperience.length - 1) {
                    groupedLines.push(firstLine.join(", "));
                    currentLine = formattedExperience.slice(i + 1);
                    break;
                }
            }
            let tempLine = [];
            currentLine.forEach((item) => {
                if (item.length > 11) {
                    if (tempLine.length > 0) {
                        groupedLines.push(tempLine.join(", "));
                        tempLine = [];
                    }
                    groupedLines.push(item);
                } else {
                    tempLine.push(item);
                    if (tempLine.length === 3) {
                        groupedLines.push(tempLine.join(", "));
                        tempLine = [];
                    }
                }
            });
            if (tempLine.length > 0) {
                groupedLines.push(tempLine.join(", "));
            }

            return groupedLines;
        };

        onMounted(() => {
            doctor_id.value = route.params.id;
            doctorView();

        });
        return {
            doctorView,
            doctor,
            splitExperience,
            doctor_shedules,
            symptoms
        }
    }
}
</script>

<style scoped>
.profile-card {
    border: 1px solid #ddd;
    border-radius: 10px;
    background-color: #f4f5ff;
    max-width: 1300px;
    margin: auto;
}

.profile {
    padding: 20px;
}

.doctor-image {
    border-radius: 50%;
    width: 320px;
    height: 320px;
    object-fit: cover;
}

.symptom-list li {
    margin-bottom: 5px;
}

.appointment-btn {
    background-color: #28a745;
    color: white;
    font-weight: bold;
    border-radius: 25px;
    padding: 10px 20px;
}

.appointment-btn:hover {
    background-color: #218838;
}

.contact-info {
    color: #017783;
    font-weight: bold;
}

.doctor-details p {
    line-height: normal;
}

@media (max-width: 768px) {
    .doctor-details p {
        line-height: normal;
    }
}

table th,
table td {
    text-align: center;
    vertical-align: middle;
}

.phone-colore {
    background-color: #15664d;
}

.hospitalnamebackground {
    background-color: #057cd0;
}

.section-title {
    background-color: #d9d9d9;
    padding: 6px 12px;
    font-weight: bold;
}
</style>
<template>
    <div class="profile-card mt-4">
        <div class="doctor-symtop">
            <div class="row d-flex justify-between align-items-center">
                <div class="col-md-4 text-center">
                    <img v-if="doctor.doctor_image" :src="doctor.doctor_image" alt="Doctor" class="doctor-image">
                </div>
                <div class="col-md-8 doctor-details">
                    <h4 class="fw-bold">{{ doctor.doctorName }}</h4>
                    <div>
                        <template v-for="(item, index) in splitExperience" :key="index">
                            <p>{{ item }}</p>
                        </template>
                    </div>
                    <p><strong>Specialist: </strong>
                        <span v-for="(specialist, index) in doctor.Specialist" :key="index">
                            {{ specialist }}<span v-if="index !== doctor.Specialist.length - 1">, </span>
                        </span>
                    </p>
                    <p><strong>Proposer:</strong> Department of {{ doctor.deparment_category }}</p>
                    <p>{{ doctor.details }}</p>
                    <p>Reg. No: <strong>{{ doctor.regnum }}</strong></p>
                    <p><strong>Contact:</strong> {{ doctor.mobile }}</p>
                </div>
            </div>
            <hr>
            <h5>Symptom</h5>
            <ul class="symptom-list">
                <li v-for="symtom in spliteSymtoms" :key="symtom.id">{{ symtom }}</li>
            </ul>
        </div>
        <table class="table table-bordered mt-4">
            <thead class="table-primary">
                <tr>
                    <th style="height: 30px; background-color: #0cbfde; color: white;">Days</th>
                    <th style="height: 30px; background-color: #0cbfde; color: white;">Start Time</th>
                    <th style="height: 30px; background-color: #0cbfde; color: white;">End Time</th>
                    <th style="height: 30px; background-color: #0cbfde; color: white;">Visit Fee</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="doctorshedule in doctor_shedules" :key="doctorshedule.id">
                    <td>{{ doctorshedule.day }}</td>
                    <td>{{ doctorshedule.start }}</td>
                    <td>{{ doctorshedule.end }}</td>
                    <td>{{ doctorshedule.visitLimit }}</td>
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
</template>

<script>
import axios from 'axios';
import { computed, onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';
export default {
    name: 'DoctorView',
    setup() {
        const route = useRoute();
        const doctor_id = ref('');
        const doctor = ref({});
        const doctor_shedules = ref([]);

        const doctorView = async () => {
            const response = await axios.get(`/api/auth/hospital-doctor/doctor-view/${doctor_id.value}`)
            console.log(response.data.doctor);
            if (response.data && response.data.message && response.status == 200) {
                doctor.value = response.data.doctor;
                let jsonString = response.data.doctor.Shedule
                doctor_shedules.value = JSON.parse(jsonString);
            }
        }

        const splitExperience = computed(() => {
            const experience = doctor.value.experience || '';
            return experience
                .split('.')
                .map(item => item.trim())
                .filter(item => item.length > 0);
        });

        const spliteSymtoms = computed(() => {
            const symtoms = doctor.value.symptom || '';
            return symtoms.split('.').map(item => item.trim()).filter(item => item.length > 0)
        })
        onMounted(() => {
            doctor_id.value = route.params.id;
            doctorView();
        });
        return {
            doctorView,
            doctor,
            splitExperience,
            spliteSymtoms,
            doctor_shedules
        }
    }
}
</script>

<style scoped>
.profile-card {
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 20px;
    background-color: #f9f9f9;
    max-width: 1300px;
    margin: auto;
}

.doctor-image {
    border-radius: 50%;
    width: 300px;
    height: 300px;
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
</style>
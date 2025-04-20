<template>
    <div class="container main py-2 mb-2">
        <div class="">
            <div class="design">

            </div>
        </div>
        <div class="doctor-card d-flex flex-column flex-md-row justify-content-center  align-items-center p-4 gap-md-5">
            <div class="text-center">
                <img class="mb-2 img-fluid" :src="doctor.doctor_image" alt="Doctor Image">
                <p>Reg. No: {{ doctor.regnum }}</p>
            </div>
            <div class="mx-4 text-md-start">
                <h5>{{ doctor.doctorName }}</h5>
                <div>
                    <p v-for="(line, i) in splitExperience(doctor.details)" :key="i" class="mb-0">
                        {{ line }}
                    </p>
                </div>
                <p class="fw-bold mb-0">Specialist : </p>
                <span v-for="(specialist, index) in doctor.Specialist" :key="index">
                    {{ specialist }}<span v-if="index !== doctor.Specialist.length - 1">, </span>
                </span>
                <p class="mb-0">{{ doctor.appoinment_mobile }}</p>
            </div>
        </div>
        <div class="mb-3" v-for="regnum in RegnumDoctors" :key="regnum.id">
            <div class="hospital-title d-flex justify-content-center align-items-center mb-3">
                <div class="hospital_image">
                    <img :src="`/hospital/backend/img/users/logo/${regnum.user.logo}`" width="70px" height="70px" alt=""
                        class="rounded">
                </div>
                <div class="ms-3 hospital_details">
                    <h2 class="mb-0">{{ regnum.user.hospital_name }} </h2>
                    <p class="mb-0 font_size_address">{{ regnum.user.location_details }}</p>
                    <p class="mb-0 font_size_address">{{ regnum.user.mobile_number_1 }},{{ regnum.user.mobile_number_2
                        }}</p>
                </div>
            </div>
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th class="bg-info text-white">Days</th>
                        <th class="bg-info text-white">Start Time</th>
                        <th class="bg-info text-white">End Time</th>
                        <!-- <th class="bg-info text-white">Visit Lmit</th> -->
                        <th class="bg-info text-white">Appointment</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="doctorshedule in regnum.Shedule" :key="doctorshedule.id">
                        <td>{{ doctorshedule.day }}</td>
                        <td>{{ convertTo12HourFormat(doctorshedule.start) }}</td>
                        <td>{{ convertTo12HourFormat(doctorshedule.end) }}</td>
                        <!-- <td>{{ doctorshedule.visitLimit }}</td> -->
                        <td><a href="#" class="appointment-btn">Appointment</a></td>
                    </tr>
                </tbody>

            </table>
        </div>
        <div class="text-center">
            <div class="design">

            </div>
        </div>
    </div>

</template>

<script>
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";

export default {
    name: "DoctorappoinmentView",
    setup() {
        const route = useRoute();
        const doctor_id = ref("");
        const doctor = ref({});
        const doctor_shedules = ref([]);
        const RegnumDoctors = ref([]);

        const doctorView = async () => {
            const response = await axios.get(`/api/home/hospital-doctor/doctor-view/${doctor_id.value}`)
            if (response.data && response.data.message && response.status == 200) {
                console.log(response.data.regnum)
                doctor.value = response.data.doctor;
                let jsonString = response.data.doctor.Shedule
                doctor_shedules.value = JSON.parse(jsonString);

                RegnumDoctors.value = response.data.regnum.map(doctor => ({
                    ...doctor,
                    Shedule: doctor.Shedule ? JSON.parse(doctor.Shedule) : []
                }));
                console.log(RegnumDoctors.value)
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
        const convertTo12HourFormat = (time) => {
            let [hours, minutes] = time.split(':');
            hours = parseInt(hours);
            const period = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12 || 12;
            return `${hours}:${minutes} ${period}`;
        };
        onMounted(() => {
            doctor_id.value = route.params.id;
            doctorView();
        });

        return {
            doctor_id,
            doctor,
            splitExperience,
            doctor_shedules,
            RegnumDoctors,
            convertTo12HourFormat
        };
    },
};
</script>

<style scoped>
.main {
    background-color: #e3e6f0;
}

.doctor-card img {
    border-radius: 50%;
    width: 250px;
    height: 250px;
}

.font_size_address {
    font-size: 12px;
}

.table th,
.table td {
    text-align: center;
    vertical-align: middle;
}

.appointment-btn {
    display: inline-block;
    padding: 5px 15px;
    color: white;
    background-color: #28a745;
    border-radius: 20px;
    text-decoration: none;
}

.footer {
    background-color: #f50992;
    color: white;
    text-align: center;
    padding: 10px 0;
}

.design {
    width: 100%;
    height: 2vh;
    background-color: #004aac;
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
</style>
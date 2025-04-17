<template>
  <div class="container container_main">
    <div class="rounded" style="background-color: #FFFFFF;">
      <div class="buttonhide d-flex justify-content-end mb-2">
        <span><i class="fa-solid fa-xmark text-white bg-danger text-end p-1 rounded-circle" style="cursor: pointer"
            @click="closeAppointment"></i></span>
      </div>
      <div class="container img_header d-flex justify-content-start align-items-center gap-4 mb-3">
        <div class="hospital_img">
          <img v-if="appointmentUser.logo" :src="`/hospital/backend/img/users/logo/${appointmentUser.logo}`" width="110"
            height="auto" alt="">
        </div>
        <div>
          <p class="mb-0"> {{ appointmentUser.hospital_name }}</p>
          <p class="">{{ appointmentUser.location_details }}<br>{{ appointmentUser.admin_mobile }}</p>
        </div>
      </div>
      <div class="button_pay d-flex justify-content-end align-items-center">
        <button class="btn btn-danger">Pay Now</button>
      </div>
      <div class="container mb-3">
        <div class="section-title mt-3 text-white">Appointment Doctor</div>
        <div class="doctor_details ms-2">
          <p class="mb-1"><strong>{{ appointmentDoctorData.doctorName }}</strong></p>
          <p v-for="(line) in splitExperience(appointmentDoctorData.details)" :key="line.id" class="mb-0">
            {{ line }}
          </p>
          <p class="mb-1"><strong>Specialist: </strong><span
              v-for="(specialist, index) in appointmentDoctorData.Specialist" :key="index">
              {{ specialist }}<span v-if="index !== appointmentDoctorData.Specialist.length - 1">, </span>
            </span></p>
          <p class="mb-1"><strong></strong> Department of {{ appointmentDoctorData.deparment_category }}</p>
          <p class="mb-1">{{ appointmentDoctorData.mobile }}</p>
        </div>
      </div>

      <div class="container">
        <div class="section-title text-white">Patient</div>
        <div class="patient_details">
          <table class="info-table">
            <tbody>
              <tr>
                <td><b class="text-warning">Doctore Serial Numbr:</b></td>
                <td class="fw-bold">: {{ appointmentData.Sl_no }}</td>
              </tr>
              <tr>
                <td><b>Mobile Number</b></td>
                <td>: {{ appointmentData.patient_mobile }}</td>
              </tr>
              <tr>
                <td><b>Name</b></td>
                <td>: {{ appointmentData.patient_name }}</td>
              </tr>
              <tr>
                <td><b>Gender</b></td>
                <td>: {{ appointmentData.gender }}</td>
              </tr>
              <tr>
                <td><b>Age</b></td>
                <td>: {{ appointmentData.age }}</td>
              </tr>
              <tr>
                <td><b>Marital Status</b></td>
                <td>: Married</td>
              </tr>
              <tr>
                <td><b>Blood Group</b></td>
                <td>: O+</td>
              </tr>
              <tr>
                <td><b>Height</b></td>
                <td>: 5.4"</td>
              </tr>
              <tr>
                <td><b>Weight</b></td>
                <td>: 70kg</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="container">
        <div class="section-title text-white bg-dark p-2">Appointment Details</div>
        <div class="table-responsive">
          <table class="table table-bordered table-hover mt-3">
            <thead class="table-dark text-center">
              <tr>
                <th>Date</th>
                <th>Days</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Room No.</th>
                <th>Visit Time</th>
                <th>Fee</th>
                <th>P. Type</th>
              </tr>
            </thead>
            <tbody>
              <tr class="text-center align-middle">
                <td>{{ appointmentData?.visit_date || 'N/A' }}</td>
                <td>Sun</td>
                <td>10:00 AM</td>
                <td>05:00 PM</td>
                <td>{{ appointmentDoctorData?.room_number || 'N/A' }}</td>
                <td>{{ appointmentData?.visit_time || 'N/A' }}</td>
                <td>
                  <span v-if="appointmentDoctorData">
                    {{
                      appointmentData.visit_time === '1st' ? appointmentData.fee + ' / ' + appointmentData.payment_status
                        :
                        appointmentData.visit_time === '2nd' ?  appointmentData.fee + ' / ' + appointmentData.payment_status
                          :
                          appointmentData.visit_time === '3rd' ? appointmentData.fee + ' / ' + appointmentData.payment_status
                          :
                    'N/A'
                    }}
                  </span>
                </td>
                <td><span class="badge-online">{{ appointmentDoctorData?.payment_type || 'N/A' }}</span></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- <div class="container mb-3">
        <div class="mb-0">Symptom</div>
        <p>........................................................................................</p>
      </div> -->
      <div class="container mb-3">
        <div class="mb-0">Description</div>
        {{ appointmentData.description }}
      </div>
      <!-- <button class="btn btn-primary apply-btn mt-3">Apply</button> -->
    </div>
  </div>
</template>

<script>
import { computed, onBeforeMount, onMounted, ref } from 'vue';
import Cookies from "js-cookie";
import axios from 'axios';
export default {
  name: "AppoinmentShow",
  props: {
    appointmentId: {
      type: [String, Number],
      required: true,
    },
  },
  setup(props, { emit }) {
    const appointmentData = ref({});
    const access_token = ref("");

    const closeAppointment = () => {
      emit("loadComponent");
    };

    const findAppointmentDoctor = async (appointmentId) => {
      try {
        const response = await axios.get(
          `/api/auth/appointment/showdata/${appointmentId}`,
          {
            headers: {
              Authorization: `Bearer ${access_token.value}`,
            }
          }
        );

        console.log(response.data);

        if (response.status === 200) {
          appointmentData.value = response.data;
        }
      } catch (error) {
        console.error("Error fetching appointment data:", error);
      }
    };
    const appointmentUser = computed(() => appointmentData.value?.user || {});
    const appointmentDoctorData = computed(() => appointmentData.value?.doctor || {});

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
      access_token.value = Cookies.get("access_token");
      findAppointmentDoctor(props.appointmentId);
    });

    return {
      closeAppointment,
      appointmentData,
      findAppointmentDoctor,
      splitExperience,
      appointmentId: props.appointmentId,
      access_token,
      appointmentDoctorData,
      appointmentUser
    };
  },
};

</script>

<style scoped>
body {
  background-color: #f8f9fa;
  font-family: Arial, sans-serif;
}

.container_main {
  max-width: 1000px;
  background: white;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

.section-title {
  background-color: #4b4b4b;
  color: white;
  padding: 5px 10px;
  font-size: 16px;
  border-radius: 5px;
  margin-bottom: 10px;
  max-width: 190px;
}

.info-table td {
  padding: 3px 10px;
}

.table th,
.table td {
  text-align: center;
  font-size: 14px;
}

.apply-btn {
  width: 100%;
  font-size: 18px;
}

.badge-online {
  background-color: green;
  color: white;
  padding: 5px 10px;
  border-radius: 5px;
}

@media (max-width: 768px) {
  .container_main {
    max-width: 100%;
    padding: 15px;
  }

  .info-table td {
    display: block;
    text-align: left;
    padding: 5px 0;
  }

  .table-responsive {
    overflow-x: auto;
  }

  .apply-btn {
    font-size: 16px;
  }
}
</style>
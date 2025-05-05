<template>
    <div class="container container_main">
        <div class="rounded" style="background-color: #FFFFFF;">
            <div class="buttonhide d-flex justify-content-end mb-2">
                <span><i class="fa-solid fa-xmark text-white bg-danger text-end p-1 rounded-circle"
                        style="cursor: pointer" @click="closeAppointment"></i></span>
            </div>
            <div class="container-fluid content-wrapper">
                <div class="row flex-grow-1">
                    <main class="col-md-9 pt-2 d-flex flex-column content">
                        <div
                            class="doctor_details_hospital d-flex flex-column-reverse flex-md-row justify-content-between align-items-center w-100 p-1 mb-md-2">
                            <div class="doctorName_details w-100 w-md-50 mb-2 mb-md-0">
                                <h6 class="mb-0">
                                    {{ prescriptionData.doctor?.doctorName || 'Dr. Mr.XYZ' }}
                                </h6>
                                <div class="doctor_details">
                                    <p v-for="(line) in splitExperience(prescriptionData.doctor?.details)"
                                        :key="line.id" class="mb-0 line-tight">
                                        {{ line }}
                                    </p>
                                    <p class="mb-0 line-tight"><strong>Specialist: </strong> <br>
                                        <span v-for="(specialist, index) in prescriptionData.doctor?.Specialist"
                                            :key="index">
                                            {{ specialist }}<span
                                                v-if="index !== prescriptionData.doctor?.Specialist.length - 1">,
                                            </span>
                                        </span>
                                    </p>
                                    <p class="fw-bold mb-0 line-tight">Proposer</p>
                                    <p class="mb-0 line-tight">Department of Child Surgery</p>
                                    <p class="mb-1 line-tight">Sohid Sorowerdy Medical Collge</p>
                                    <p class="fw-bold mb-0 line-tight">Reg No: </p>
                                    <p class="mb-1 line-tight">{{ prescriptionData.doctor?.regnum }}</p>
                                    <p class="fw-bold mb-0 line-tight">Contact: </p>
                                    <p class="mb-0 line-tight">{{ prescriptionData.doctor?.mobile }}</p>
                                </div>
                            </div>
                            <div class="hospital_address_logo w-100 w-md-50 mb-3">
                                <div class="address_logo d-flex justify-content-start align-items-center">
                                    <div class="hospital_logo">
                                        <img :src="prescriptionData.doctor?.user?.logo
                                            ? `/hospital/backend/img/users/logo/${prescriptionData.doctor.user.logo}`
                                            : '/hospital/backend/img/no_pic.png'" alt="User Logo" width="80"
                                            style="height: auto;" />
                                    </div>
                                    <div class="hospital_address">
                                        <h3 class="mb-0">{{ prescriptionData.doctor?.user?.hospital_name || 'N/A' }}
                                        </h3>
                                        <p class="mb-0">{{ prescriptionData.doctor?.user?.location_details || 'N/A' }}
                                        </p>
                                        <p class="mb-0">
                                            {{ prescriptionData.doctor?.user?.mobile_number_1 }}, {{
                                                prescriptionData.doctor?.user?.mobile_number_2 }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="patient_details mb-0">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th class="custom-height">Name</th>
                                            <td class="custom-height">{{ prescriptionData.appointment?.patient_name }}
                                            </td>
                                            <th class="custom-height">Gender</th>
                                            <td class="custom-height">{{ prescriptionData.appointment?.gender }}</td>
                                            <th class="custom-height">Age</th>
                                            <td class="custom-height">{{ prescriptionData.appointment?.age }}</td>
                                            <th class="custom-height">Date</th>
                                            <td class="custom-height">{{ prescriptionData.visit_date }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="prescription d-flex flex-column h-100">
                            <div class="prescription_details w-100 d-flex flex-column flex-md-row flex-grow-1">
                                <div class="pathology_test w-lg-25 w-md-100"
                                    style="background-color: #eae7f1; height: 63vh; position: relative;">
                                    <p class="text-center mt-2 mb-0">Blood Pressure</p>
                                    <div
                                        class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-lg-3 px-lg-5">
                                        <p class="mb-0">UP: {{ prescriptionData.blood_pressure_up }} (mmHg)</p>
                                        <p class="mb-0">Down: {{ prescriptionData.blood_pressure_down }} (mmHg)</p>
                                    </div>
                                    <div class="pathology mx-3">
                                        <p class="text-center text-decoration-underline mb-0 mt-2">Pathology Test</p>
                                        <ul>
                                            <li v-for="(patholoy, index) in prescriptionData.pathologies" :key="index">
                                                {{ patholoy }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="prescription_text pt-2 w-100  w-md-100" style="background-color: white;">
                                    <div class="row mb-3">
                                        <div class="col-md-1 ms-md-5">
                                            <h1>R<sub>X</sub></h1>
                                        </div>
                                    </div>
                                    <div v-for="(medicine, index) in prescriptionData.medicine" :key="index"
                                        class="row mb-3 d-flex ms-md-1 justify-content-center align-items-center w-100">
                                        <div class="col-md-12">
                                            <p class="mb-1 mx-5">{{ medicine.medicine_name }}</p>
                                            <div class="medicine d-flex justify-content-around w-100 ms-md-5 fw-bold">
                                                <div class="m1 w-50">
                                                    <p> {{ medicine.capsul }} ...({{ medicine.indicate }})</p>
                                                </div>
                                                <div class="m2 w-75">
                                                    <p>{{ medicine.narration }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="signature-footer">
                                        <img :src="prescriptionData.doctor?.user?.logo
                                            ? `${prescriptionData.doctor.signature_image}`
                                            : '/hospital/backend/img/no_pic.png'" alt="User Logo" width="80"
                                            style="height: auto;" />
                                        <div class="signature-line"></div>
                                        <p class="fw-bold mb-0" style="white-space: pre-line; line-height: 1.2;">
                                            {{ prescriptionData.doctor?.prescription_signature_style ||
                                                'Dr.Mr.XYZ\nMBBS(BCS)' }}
                                        </p>
                                        <p>{{ prescriptionData.visit_date }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
        <button class="btn btn-success" style="margin-left: 10px; width: 250px;" @click="Print">
            Save & Show
        </button>
    </div>
</template>

<script>
import PrescriptionPrintHelper from '../../../../Helpers/PrescriptionPrintHelper';
export default {
    name: "PrintPrescription",
    props: {
        prescriptionData: {
            type: Object,
            required: true
        }
    },
    setup(props, { emit }) {
        const closeAppointment = () => {
            emit("loadComponent");
        };

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
        const Print = () => {
            PrescriptionPrintHelper.printPrescription(props.prescriptionData)
        }
        return {
            splitExperience,
            closeAppointment,
            Print
        }
    }
}
</script>

<style scoped>
body {
    background-color: #f8f9fa;
    font-family: Arial, sans-serif;
}

.line-tight {
    line-height: 1.5;
}


.container_main {
    max-width: 1000px;
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

.content-wrapper {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

.content {
    flex: 1;
}

@media (min-width: 768px) {
    .pathology_test {
        height: 100%;
    }

    .prescription_text {
        height: 100%;
    }
}

@media (max-width: 767px) {

    .pathology_test,
    .prescription_text {
        height: auto;
    }

    .prescription_details {
        flex-direction: column;
    }

    .pathology_test {
        order: 1;
        width: 100%;
    }

    .prescription_text {
        order: 2;
        width: 100%;
    }

    .input_group {
        gap: 0.5rem;
    }

    .row {
        flex-direction: column;
    }
}

.custom-height {
    height: 30px;
    background-color: #1d93d2;
    color: white;
}

@media (max-width: 768px) {
    .custom-height {
        height: 25px;
    }
}

.signature-footer {
    position: absolute;
    bottom: 0px;
    right: 120px;
    text-align: right;
}

.signature-footer img {
    height: 70px;
}

.signature-line {
    border-top: 1px solid black;
    width: 200px;
    margin-bottom: 5px;
}

@media (max-width: 768px) {
    .signature-footer {
        text-align: right;
        position: relative;
        bottom: 10px;
        right: auto;
        left: auto;
        width: 100%;
    }

    .signature-line {
        margin-left: auto;
        margin-right: 0;
    }
}

@media (max-width: 768px) {
    .container_main {
        max-width: 100%;
        padding: 15px;
    }
}
</style>
export default class PrescriptionPrintHelper {
    static printPrescription(prescriptionData) {
        const qualifications = prescriptionData.doctor.details;

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

        const formattedQualifications = splitExperience(qualifications);
        let formattedDetails = '';
        formattedQualifications.forEach((item) => {
            formattedDetails += `<p class="mb-0 line-tight">${item}</p>`;
        });

        const printArea = document.createElement('div');
        printArea.id = 'print-area';
        document.body.appendChild(printArea);

        const content = `
            <style>
                @media print {
                    body * {
                        visibility: hidden;
                    }
                    #print-area, #print-area * {
                        visibility: visible;
                    }
                    #print-area {
                        position: absolute;
                        left: 0;
                        top: 0;
                        width: 100%;
                        padding: 20px;
                        background: white;
                        page-break-inside: avoid;
                    }
                }
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                }
                .container_main {
                    max-width: 100%;
                    margin: 0 auto;
                    padding: 15px;
                }
                .doctor-info, .patient-info, .prescription-content {
                    margin-bottom: 10px;
                }
                .doctorName_details, .hospital_address_logo {
                    width: 48%;
                    display: inline-block;
                    vertical-align: top;
                }
                .header img {
                    width: 80px;
                }
                h3, h6 {
                    margin: 0;
                }
                .line-tight {
                    line-height: 1.2;
                }
                .prescription-table {
                    width: 100%;
                    border-collapse: collapse;
                }
                .prescription-table th, .prescription-table td {
                    border: 1px solid #ddd;
                    padding: 8px;
                    text-align: left;
                }
                .prescription {
                    display: flex;
                    flex-direction: row;
                    gap: 10px;
                }
                .pathology_test {
                    width: 30%;
                    background-color: #eae7f1;
                    padding: 10px;
                }
                .prescription_text {
                    width: 68%;
                    background-color: white;
                    padding: 10px;
                }
                .signature-footer {
                    margin-top: 30px;
                    text-align: right;
                }
                .signature-footer img {
                    height: 70px;
                }
                .signature-line {
                    border-top: 1px solid black;
                    width: 150px;
                    margin-left:290px;
                    margin-top:2px;
                }
                .custom-height {
                height: 30px;
                background-color: #1d93d2;
                color: white;
                }
            </style>

            <div class="container_main">
                <!-- Doctor and Hospital Info -->
                <div class="doctor_details_hospital mb-3">
                    <div class="doctorName_details">
                        <h6>${prescriptionData.doctor?.doctorName || 'Dr. Mr.XYZ'}</h6>
                        ${formattedDetails}
                        <p class="mb-0 line-tight"><strong>Specialist:</strong><br>
                            ${prescriptionData.doctor?.Specialist?.join(', ') || ''}
                        </p>
                        <p class="fw-bold mb-0 line-tight">Proposer</p>
                        <p class="mb-0 line-tight">Department of Child Surgery</p>
                        <p class="mb-1 line-tight">Sohid Sorowerdy Medical Collge</p>
                        <p class="fw-bold mb-0 line-tight">Reg No:</p>
                        <p class="mb-1 line-tight">${prescriptionData.doctor?.regnum || ''}</p>
                        <p class="fw-bold mb-0 line-tight">Contact:</p>
                        <p class="mb-0 line-tight">${prescriptionData.doctor?.mobile || ''}</p>
                    </div>
                    <div class="hospital_address_logo">
                        <img src="${prescriptionData.doctor?.user?.logo ? `/hospital/backend/img/users/logo/${prescriptionData.doctor.user.logo}` : '/hospital/backend/img/no_pic.png'}" alt="Logo" width="80" />
                        <h3>${prescriptionData.doctor?.user?.hospital_name || 'N/A'}</h3>
                        <p class='mb-0'>${prescriptionData.doctor?.user?.location_details || 'N/A'}</p>
                        <p >${prescriptionData.doctor?.user?.mobile_number_1 || ''}, ${prescriptionData.doctor?.user?.mobile_number_2 || ''}</p>
                    </div>
                </div>

                <!-- Patient Info -->
                <div class="patient_info mb-1">
                    <table class="prescription-table">
                        <tbody>
                            <tr>
                                <th style="border:1px solid black">Name</th>
                                <td style="border:1px solid black">${prescriptionData.appointment?.patient_name}</td>
                                <th style="border:1px solid black">Gender</th>
                                <td style="border:1px solid black">${prescriptionData.appointment?.gender}</td>
                                <th style="border:1px solid black">Age</th>
                                <td style="border:1px solid black">${prescriptionData.appointment?.age}</td>
                                <th style="border:1px solid black">Date</th>
                                <td style="border:1px solid black">${prescriptionData.visit_date}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Prescription Content -->
                <div class="prescription">
                    <div class="pathology_test">
                        <p class='mb-0 '><strong>Blood Pressure</strong></p>
                        <p class="mb-0">UP: ${prescriptionData.blood_pressure_up} mmHg</p>
                        <p class="mb-0">Down: ${prescriptionData.blood_pressure_down} mmHg</p>
                        <p  class="text-decoration-underline mb-1">Pathology Test</p>
                        <ul class='mb-0' style="padding-left: 15px;" >
                            ${prescriptionData.pathologies?.map(item => `<li style="margin-top:-10px">${item}</li>`).join('') || ''}
                        </ul>
                    </div>

                    <div class="prescription_text">
                        <h1 style="margin-left: 20px;">R<sub>X</sub></h1>
                        ${prescriptionData.medicine.map(medicine => `
                            <div class="rowd-flex ms-md-1 justify-content-center align-items-center w-100">
                                <div class="col-md-12" style="margin-left:60px">
                                    <p class="mb-0">${medicine.medicine_name}</p>
                                    <div class="medicine d-flex justify-content-around w-100 ms-md-5 fw-bold">
                                        <div class="w-50">
                                            <p> ${medicine.capsul} ...(${medicine.indicate})</p>
                                        </div>
                                        <div class="w-75">
                                            <p>${medicine.narration}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `).join('')}
                        <div class="signature-footer">
                            <img src="${prescriptionData.doctor?.signature_image || '/hospital/backend/img/no_pic.png'}" alt="Signature" />
                            <div class="signature-line"></div>
                            <p class='mb-0' style="white-space: pre-line;line-height: 1.2;" >${prescriptionData.doctor?.prescription_signature_style || 'Dr.Mr.XYZ\nMBBS(BCS)'}</p>
                            <p class='mb-0' style="line-height: 1.2;">${prescriptionData.visit_date}</p>
                        </div>
                    </div>
                </div>
            </div>
        `;

        printArea.innerHTML = content;
        window.print();
        document.body.removeChild(printArea);
    }
}

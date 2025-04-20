class DoctorWiseReportPrintHelper {
    static printDoctorWistReport(hospitalName, hospitalLogo, formattedData, formattedVisitDate, appointments) {
        const printArea = document.createElement('div');
        printArea.id = 'print-area';

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
                    }
                }
                body {
                    font-family: Arial, sans-serif;
                    margin: 20px;
                }
                .header {
                    text-align: center;
                    margin-bottom: 20px;
                }
                .header img {
                    width: 100px;
                    height: auto;
                }
                .header h1 {
                    margin-top: 10px;
                    color: #1d93d2;
                }
                .doctor_details {
                    text-align: center;
                    font-size: 16px;
                    margin-bottom: 20px;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 20px;
                }
                th, td {
                    border: 1px solid #ddd;
                    padding: 8px;
                    text-align: center;
                }
                th {
                    background-color: #1d93d2 !important;
                    color: white !important;
                    -webkit-print-color-adjust: exact !important;
                    print-color-adjust: exact !important;
                }
            </style>
            <div class="header">
                <img src="/hospital/backend/img/users/logo/${hospitalLogo}" alt="Hospital Logo">
                <h1>${hospitalName}</h1>
            </div>
            <div class="doctor_details">
                <span>${formattedVisitDate}</span><br>
                <span>${formattedData.department_category}</span><br>
                <span>${formattedData.doctor_name}</span>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>SL.NO</th>
                        <th>Patient Name</th>
                        <th>Mobile/Mail</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Appoint</th>
                        <th>Visit Time</th>
                        <th>Payment</th>
                        <th>Appoint Time</th>
                        <th>Reference</th>
                        <th>Discount/Free Reference</th>
                        <th>Visit</th>
                    </tr>
                </thead>
                <tbody>
                    ${appointments.length > 0
                        ? appointments.map((appointment, index) => `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${appointment.patient_name}</td>
                                <td>${appointment.patient_mobile}</td>
                                <td>${appointment.gender}</td>
                                <td>${appointment.age}</td>
                                <td>Hospital</td>
                                <td>${appointment.visit_time}</td>
                                <td>${appointment.payment_status}</td>
                                <td>0</td>
                                <td>${appointment.reference ? appointment.reference.name : '-'}</td>
                                <td>${appointment.payment_status === 'Free' || appointment.payment_status === 'Discount' ? (appointment.reference ? appointment.reference.name : '-') : '-'}</td>
                                <td>0</td>
                            </tr>
                        `).join('')
                        : `<tr><td colspan="12" class="text-center text-black">No data found</td></tr>`
                    }
                </tbody>
            </table>
        `;

        printArea.innerHTML = content;
        document.body.appendChild(printArea);

        window.print();

        setTimeout(() => {
            document.body.removeChild(printArea);
        }, 500);
    }
}

export default DoctorWiseReportPrintHelper;

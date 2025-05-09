class PatientPrescriptionPrint {
    static printPrescription(patientList) {
        const printArea = document.createElement('div');
        printArea.id = 'print-area';
        const defaultImage = '/hospital/backend/img/no_pic.png';
        const img = patientList[0]?.user?.logo || defaultImage;
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
                    top: 40px; 
                    width: 100%;
                    background: white;
                    overflow: hidden;
                }
                html, body {
                    height: 100%;
                    margin: 0;
                    padding: 0;
                    overflow: hidden;
                }
                .table-responsive {
                    width: 100%;
                    overflow-x: hidden;
                }
                .prescription-table {
                    border-collapse: collapse;
                    width: 100%;
                }
                .prescription-table th, .prescription-table td {
                    border: 1px solid black; /* Apply black border */
                    padding: 5px;
                    font-size: 10px;
                    word-wrap: break-word;
                }

                table, th, tr ,td{
                    background-color: #1d93d2 !important;
                    color: white !important;
                    height: 30px !important;
                    border:1px solid black !important;
                    color:black !important;
                }
                .more{
                  border:1px solid white !important;
                }
                .hospital_address_logo {
                    display: flex !important;
                    justify-content: center !important;
                    align-items: center !important;
                }
                .hospital{
                    margin-top:5px;
                }
                .report-header{
                    margin-bottom:10px;
                    text-align:center;
                }
                .thNarration{
                    text-align:center;
                }
            }
        </style>
        <div class="hospital_address_logo">
            <div class="image">
                <img src="/hospital/backend/img/users/logo/${img}" 
                    alt="Hospital Logo" 
                    style="width: 90px; height: auto;" 
                    onerror="this.onerror=null; this.src='/hospital/backend/img/no_pic.png';">
            </div>
            <div class="image2">
                <h3>${patientList[0].user?.hospital_name || 'N/A'}</h3>
                <p class='mb-0'>${patientList[0].user?.location_details || 'N/A'}</p>
                <p >${patientList[0].user?.mobile_number_1 || ''}, ${patientList[0]?.user?.mobile_number_2 || ''}</p>
            </div>   
        </div>
        <div class="report-header">
            <h5>Patient Appoinment Report</h5>
        </div>
         <div class="hospital">
            <h6>Doctor Name: ${patientList[0].doctor?.doctorName || 'N/A'}</h6>
            <h6>Department Name: ${patientList[0].doctor?.deparment_category || 'N/A'}</h6>
            <h6>Date: ${patientList[0]?.visit_date || 'N/A'}</h6>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered prescription-table" id="appointment-table">
                <thead>
                    <tr>
                        <th rowspan="2">S.L No</th>
                        <th rowspan="2" >Patient Name</th>
                        <th rowspan="2" >Email / Phone</th>
                        <th rowspan="2" >Age</th>
                        <th rowspan="2" >Gender</th>
                        <th rowspan="2" >Visit Time</th>
                        <th rowspan="2" >Fee</th>
                        <th rowspan="3" >Payment Status</th>
                        <th colspan="2" class="thNarration" >Narration</th>
                        <th rowspan="2" >Reference</th>
                        <th rowspan="2" >Appoint By</th>
                    </tr>
                    <tr>
                        <th >Discount</th>
                        <th >Discount or Free</th>
                    </tr>
                </thead>
    
                <tbody>
                ${patientList.length === 0
                ? `<tr>
                        <td colspan="13" class="text-center text-black">No data found</td>
                    </tr>`
                : patientList.map((patient, index) => {
                    let paymentStatusHtml = '';
                    if (patient.payment_status === 'Discount') {
                        paymentStatusHtml = `${Math.floor(patient.amount)}% (Discount)`;
                    } else if (patient.payment_status === 'Free') {
                        paymentStatusHtml = `${Math.floor(patient.amount)}% (Free)`;
                    } else if (patient.payment_status === 'Paid') {
                        paymentStatusHtml = '-';
                    } else {
                        paymentStatusHtml = `${Math.floor(patient.amount)} (${patient.payment_status})`;
                    }

                    let narration = patient.discount_narration || patient.free_narration || '-';

                    return `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${patient.patient_name}</td>
                                <td>${patient.patient_mobile}</td>
                                <td>${patient.age}</td>
                                <td>${patient.gender}</td>
                                <td>${patient.visit_time}</td>
                                <td>${patient.fee}</td>
                                <td>${patient.payment_status}</td>
                                <td>${paymentStatusHtml}</td>
                                <td>
                                    <table class='more3>
                                        <tr class='more2'>
                                            <td class='more'>${narration}</td>
                                        </tr>
                                    </table>
                                </td>
                                <td>${patient.reference?.name || '-'}</td>
                                <td>${patient.appointby}</td>
                            </tr>
                        `;
                }).join('')}
            </tbody>
        </table>
        </div>
    `;

        printArea.innerHTML = content;
        window.print();
        document.body.removeChild(printArea);
    }
}

export default PatientPrescriptionPrint;

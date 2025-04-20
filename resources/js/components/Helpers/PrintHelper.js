class PrintHelper {
    static printTable(hospitalName, hospitalLogo, appointments) {
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
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Department/Category</th>
                        <th>Doctor</th>
                        <th>Total Patient</th>
                        <th>Male</th>
                        <th>Female</th>
                        <th>1st Timer</th>
                        <th>2nd Timer</th>
                        <th>3rd Timer</th>
                        <th>Visit</th>
                    </tr>
                </thead>
                <tbody>
                    ${appointments
                        .map((appointment) => `
                            <tr>
                                <td>${appointment.department_name}</td>
                                <td>${appointment.doctor_name}</td>
                                <td>${appointment.total_appointments}</td>
                                <td>${appointment.total_male}</td>
                                <td>${appointment.total_female}</td>
                                <td>${appointment.first_time_visits}</td>
                                <td>${appointment.second_time_visits}</td>
                                <td>${appointment.third_time_visits}</td>
                                <td>0</td>
                            </tr>
                        `).join('')}
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

export default PrintHelper;

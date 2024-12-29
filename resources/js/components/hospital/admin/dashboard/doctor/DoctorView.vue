<template>
    <!-- <div class="container"> -->
    <div class="profile-card mt-4">
        <div class="doctor-symtop">
            <div class="row d-flex justify-between align-items-center">
                <div class="col-md-3 text-center">
                    <img src="https://png.pngtree.com/png-vector/20230928/ourmid/pngtree-young-afro-professional-doctor-png-image_10148632.png"
                        alt="Doctor" class="doctor-image">
                </div>
                <div class="col-md-9 doctor-details">
                    <h4 class="fw-bold">Dr. Md. Jasim Uddin Nizami</h4>
                    <p>MBBS DMU FCPS MS</p>
                    <p>WHO Clinical Polw On Child Urologist (India)</p>
                    <p>Polw On Child Urologist (USA)</p>
                    <p><strong>Specialist:</strong> Child, BabyCare, Urologists, Medicine</p>
                    <p><strong>Proposer:</strong> Department of Child Surgery</p>
                    <p>Sohid Sorowardy Medical College</p>
                    <p>Reg. No: <strong>2132134</strong></p>
                    <p><strong>Contact:</strong> 01984-994406</p>
                </div>
            </div>
            <hr>
            <h5>Symptom</h5>
            <ul class="symptom-list">
                <li>You experience chest pain.</li>
                <li>You have high blood pressure.</li>
                <li>You have shortness of breath, palpitations, or dizziness.</li>
                <li>You have diabetes.</li>
                <li>You have a history of smoking.</li>
                <li>You have a history of high cholesterol.</li>
                <li>You have chronic kidney disease.</li>
                <li>You have a family history of heart disease.</li>
            </ul>
        </div>
        <table class="table table-bordered mt-4">
            <thead class="table-primary">
                <tr>
                    <th>Days</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Visit Fee</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Sat</td>
                    <td>10:30 AM</td>
                    <td>05:30 PM</td>
                    <td>120</td>
                </tr>
                <tr>
                    <td>Sun</td>
                    <td>10:30 AM</td>
                    <td>05:30 PM</td>
                    <td>120</td>
                </tr>
                <tr>
                    <td>Mon</td>
                    <td>10:30 AM</td>
                    <td>05:30 PM</td>
                    <td>120</td>
                </tr>
                <tr>
                    <td>Tue</td>
                    <td>10:30 AM</td>
                    <td>05:30 PM</td>
                    <td>90</td>
                </tr>
                <tr>
                    <td>Wed</td>
                    <td>10:30 AM</td>
                    <td>05:30 PM</td>
                    <td>50</td>
                </tr>
                <tr>
                    <td>Thu</td>
                    <td>10:30 AM</td>
                    <td>05:30 PM</td>
                    <td>120</td>
                </tr>
                <tr>
                    <td>Fri</td>
                    <td>10:30 AM</td>
                    <td>05:30 PM</td>
                    <td>100</td>
                </tr>
            </tbody>
        </table>
        <div class="text-center mt-3">
            <a href="#" class="btn appointment-btn">Appointment</a>
        </div>
        <div class="text-center mt-2 contact-info">
            <p>📞 01778344090</p>
        </div>
    </div>
    <!-- </div> -->
</template>

<script>
export default {
    name: 'DoctorView',
    setup() {
        return {

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

.doctor-symtop {}

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
    line-height: 9.9px;
}

table th,
table td {
    text-align: center;
    vertical-align: middle;
}
</style>
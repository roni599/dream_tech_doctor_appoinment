<template>
    <div class="container">
        <div
            class="header-buttons d-flex flex-wrap justify-content-start justify-content-center justify-content-md-start mb-2 gap-2">
            <router-link to="/appoinment" class="btn btn-info text-white mb-2">All Appoinment</router-link>
            <router-link to="/appoinment-details" class="btn btn-info text-white mb-2">New Appoinment</router-link>
            <router-link to="/appoinment-report" class="btn btn-info text-white mb-2">Appoinment Report</router-link>
            <router-link to="/appoinment-doctor-report" class="btn btn-info text-white mb-2">Doctor Appoinment
                Report</router-link>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="text-center">Doctorwise Paitent Appoinment Visit List</h5>
                <div
                    class="filters d-flex flex-column flex-sm-row justify-content-center gap-3 align-items-center mb-4 my-3">
                    <div class="filter-item">
                        <label for="patientMobile" class="form-label mb-0">Visit date</label>
                        <input type="date" class="form-control"/>
                    </div>
                    <div class="filter-item">
                        <label for="patientMobile" class="form-label mb-0">Department/Category</label>
                        <select class="form-select" aria-label="Department/Category">
                            <option selected value="" disabled>Choose an option</option>
                        </select>
                    </div>
                    <div class="filter-item">
                        <label for="patientMobile" class="form-label mb-0">Doctor</label>
                        <select class="form-select" aria-label="Doctor">
                            <option selected value="" disabled>Choose an option</option>
                        </select>
                    </div>
                </div>
                <table class="table table-bordered text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>S.L No</th>
                            <th>Patient Name</th>
                            <th>Mobile</th>
                            <th>Gender</th>
                            <th>Age</th>
                            <th>Appoint</th>
                            <th>Visit Time</th>
                            <th>Payment</th>
                            <th>Amount</th>
                            <th>Visit Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>01</td>
                            <td>Jasim</td>
                            <td>01778344090</td>
                            <td>Male</td>
                            <td>38</td>
                            <td>Online</td>
                            <td>1st</td>
                            <td>
                                <select class="form-select">
                                    <option>Paid</option>
                                    <option>Unpaid</option>
                                    <option>Discount</option>
                                    <option>Free</option>
                                </select>
                            </td>
                            <td>500</td>
                            <td>Not Visited</td>
                            <td class="bg-success text-white">✔</td>
                        </tr>
                        <tr>
                            <td>02</td>
                            <td>Nizam</td>
                            <td>01584526412</td>
                            <td>Male</td>
                            <td>35</td>
                            <td>Lutfur</td>
                            <td>1st</td>
                            <td>
                                <select class="form-select">
                                    <option>Paid</option>
                                    <option>Unpaid</option>
                                    <option>Discount</option>
                                    <option>Free</option>
                                </select>
                            </td>
                            <td>500</td>
                            <td>Not Visited</td>
                            <td class="bg-warning text-white">✔</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "DoctorVisit",
    setup() {
        return {

        }
    }
}
</script>

<style scoped></style>
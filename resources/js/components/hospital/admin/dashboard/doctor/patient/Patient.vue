<template>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <div class="d-flex flex-row justify-content-between align-items-center mb-3">
                        <div class="text-start">
                            <h6>12/08/2024</h6>
                            <h6>Cardiologist</h6>
                        </div>
                        <router-link to="/Patient" class="btn btn-primary">Patient List</router-link>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead class="table-primary">
                                <tr>
                                    <th>S.L No</th>
                                    <th>Patient Name</th>
                                    <th>Gender</th>
                                    <th>Age</th>
                                    <th>Previous Prescription</th>
                                    <th>Previous Report</th>
                                    <th>New Report</th>
                                    <th>Description</th>
                                    <th>Clarence</th>
                                    <th>Create Prescription</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>01</td>
                                    <td>Md. Jasim Uddin</td>
                                    <td>Male</td>
                                    <td>35</td>
                                    <td><i class="fa-solid fa-eye"></i></td>
                                    <td><i class="fa-solid fa-eye"></i></td>
                                    <td><i class="fa-solid fa-eye"></i></td>
                                    <td><i class="fa-solid fa-eye"></i></td>
                                    <td class="bg-success"></td>
                                    <td><button class="btn btn-sm btn-primary">+</button></td>
                                </tr>
                                <tr>
                                    <td>02</td>
                                    <td>John Doe</td>
                                    <td>Male</td>
                                    <td>35</td>
                                    <td><i class="fa-solid fa-eye"></i></td>
                                    <td><i class="fa-solid fa-eye"></i></td>
                                    <td><i class="fa-solid fa-eye"></i></td>
                                    <td><i class="fa-solid fa-eye"></i></td>
                                    <td class="bg-danger"></td>
                                    <td><button class="btn btn-sm btn-primary">+</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary me-2">Download PDF</button>
                    <button class="btn btn-primary">Print</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Patient",
    setup() {
        return {

        }
    }
}
</script>

<style scoped></style>
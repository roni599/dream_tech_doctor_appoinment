<template>
    <div class="container">
        <div
            class="header-buttons d-flex flex-wrap justify-content-start justify-content-center justify-content-md-start mb-3 gap-4">
            <button class="btn btn-primary mb-2">Appoint View</button>
            <button class="btn btn-info text-white mb-2">New Appoint</button>
        </div>
        <div class="card">
            <div class="card-header  ">
                Appointment Management
            </div>
            <div class="card-body">
                <!-- Filter Section -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="visitDate" class="form-label">Visit Date</label>
                        <input type="date" class="form-control" id="visitDate" />
                    </div>
                    <div class="col-md-4">
                        <label for="departmentCategory" class="form-label">Department/Category</label>
                        <select class="form-select" id="departmentCategory">
                            <option selected>Choose...</option>
                            <option value="1">Cardiology</option>
                            <option value="2">Neurology</option>
                            <option value="3">Orthopedics</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="doctor" class="form-label">Doctor</label>
                        <select class="form-select" id="doctor">
                            <option selected>Choose...</option>
                            <option value="1">Dr. Smith</option>
                            <option value="2">Dr. Brown</option>
                            <option value="3">Dr. Taylor</option>
                        </select>
                    </div>
                </div>

                <!-- Table Section -->
                <div class="table-responsive mb-4">
                    <table class="table table-bordered">
                        <thead class="table-primary">
                            <tr>
                                <th style="height: 30px;">S.L No</th>
                                <th style="height: 30px;">Patient Name</th>
                                <th style="height: 30px;">Mobile</th>
                                <th style="height: 30px;">Gender</th>
                                <th style="height: 30px;">Age</th>
                                <th style="height: 30px;">Appoint</th>
                                <th style="height: 30px;">Visit Time</th>
                                <th style="height: 30px;">Payment</th>
                                <th style="height: 30px;">Amount</th>
                                <th style="height: 30px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>01</td>
                                <td>Md. Jasim Uddin</td>
                                <td>01778344090</td>
                                <td>Male</td>
                                <td>38</td>
                                <td>Nizam</td>
                                <td>1st</td>
                                <td>Paid</td>
                                <td>500</td>
                                <td>
                                    <button class="btn btn-link text-decoration-none p-0">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-link text-decoration-none p-0 ms-3">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                </td>
                            </tr>
                            <!-- Repeat rows as needed -->
                        </tbody>
                    </table>
                </div>

                <!-- Add Button Section -->
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add
                    </button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: "AppoinmentDetails",
    setup() {
        return {

        }
    }
}
</script>

<style scoped>
.table thead th {
    text-align: center;
}

.table tbody td {
    text-align: center;
}

button i {
    font-size: 1.2rem;
}
</style>
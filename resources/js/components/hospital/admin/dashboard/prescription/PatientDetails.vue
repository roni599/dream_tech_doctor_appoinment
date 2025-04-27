<template>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center text-muted mb-3">Patient Details</h3>
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
                                <td>
                                    <router-link to="/prescription">
                                        <button class="btn btn-sm btn-primary">+</button>
                                    </router-link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'PatientDetails',
    setup() {
        return {

        }
    }
}
</script>

<style scoped>
.fixed-bottom-buttons {
    position: fixed;
    bottom: 10px;
    right: 10px;
    background: white;
    padding: 10px;
    z-index: 1000;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

@media (max-width: 576px) {
    .fixed-bottom-buttons {
        width: 100%;
        text-align: center;
        bottom: 0;
        right: 0;
        padding: 10px 0;
    }

    .fixed-bottom-buttons button {
        width: 45%;
    }
}
</style>
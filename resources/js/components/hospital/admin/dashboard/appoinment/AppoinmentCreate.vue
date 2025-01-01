<template>
    <div class="container mt-4">
        <div class="d-flex justify-content-between mb-3">
            <button class="btn btn-primary">Appoint View</button>
            <button class="btn btn-primary">New Appoint</button>
        </div>
        <div class="row">
            <!-- Appointment Card -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        Appointment
                        <span class="close-btn">&times;</span>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <span class="section-title">S.L No:</span>
                            <span class="badge badge-custom">11</span>
                        </div>
                        <div class="mb-3">
                            <p><strong>Visit Date:</strong> 10/08/2024</p>
                            <p><strong>Department/Category:</strong> Cardiologist</p>
                            <p><strong>Doctor:</strong> Dr. Md. Jasim Uddin</p>
                        </div>
                        <form>
                            <div class="mb-3">
                                <label for="patientMobile" class="form-label">Patient Mobile/Mail</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="patientMobile">
                                    <button class="btn btn-danger" type="button">✔</button>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="patientName" class="form-label">Patient Name</label>
                                <input type="text" class="form-control" id="patientName">
                            </div>
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select" id="gender">
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="age" class="form-label">Age</label>
                                    <input type="number" class="form-control" id="age">
                                </div>
                            </div>
                            <div class="row g-2 mt-3">
                                <div class="col-md-6">
                                    <label for="visitTime" class="form-label">Visit Time</label>
                                    <select class="form-select" id="visitTime">
                                        <option>Morning</option>
                                        <option>Afternoon</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="payment" class="form-label">Payment</label>
                                    <select class="form-select" id="payment">
                                        <option>Paid</option>
                                        <option>Unpaid</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="remenance" class="form-label">Remenance</label>
                                <input type="text" class="form-control" id="remenance">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-custom w-100">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Discount and Free Sections -->
            <div class="col-lg-3">
                <div class="form-section">
                    <div class="d-flex justify-content-between">
                        <span class="section-title">Discount</span>
                        <span class="close-btn">&times;</span>
                    </div>
                    <form>
                        <div class="mb-3">
                            <label for="fee" class="form-label">Fee</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="fee">
                                <input type="text" class="form-control" placeholder="Amount">
                                <input type="text" class="form-control" placeholder="%">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="reference" class="form-label">Reference</label>
                            <input type="text" class="form-control" id="reference">
                        </div>
                        <div class="mb-3">
                            <label for="narration" class="form-label">Narration</label>
                            <textarea class="form-control" id="narration" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-custom w-100">Ok</button>
                    </form>
                </div>
                <div class="form-section mt-3">
                    <div class="d-flex justify-content-between">
                        <span class="section-title">Free</span>
                        <span class="close-btn">&times;</span>
                    </div>
                    <form>
                        <div class="mb-3">
                            <label for="referenceFree" class="form-label">Reference</label>
                            <input type="text" class="form-control" id="referenceFree">
                        </div>
                        <div class="mb-3">
                            <label for="narrationFree" class="form-label">Narration</label>
                            <textarea class="form-control" id="narrationFree" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-custom w-100">Ok</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "AppoinmentCreate",
    setup() {
        return {

        }
    }
}
</script>

<style scoped>
.card-header {
    background-color: #155724;
    color: #fff;
    font-weight: bold;
}

.close-btn {
    color: #fff;
    float: right;
    cursor: pointer;
}

.btn-custom {
    background-color: #0d6efd;
    color: #fff;
}

.form-section {
    border: 1px solid #ced4da;
    border-radius: 0.5rem;
    padding: 1rem;
    margin-bottom: 1rem;
}

.badge-custom {
    background-color: orange;
    color: #fff;
    font-size: 0.9rem;
    padding: 0.3rem 0.5rem;
}

.section-title {
    font-size: 1.2rem;
    font-weight: bold;
}
</style>
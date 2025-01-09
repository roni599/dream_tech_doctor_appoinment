<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between"
                        style="background-color: #f6f6f6; color: #a0b1bf; font-weight: bold;">
                        <div>
                            <h6 class="text-center">Appointment</h6>
                        </div>
                        <div class="align-items-center">
                            <p class="align-items-center"><i
                                    class="fa-solid fa-xmark text-white bg-danger p-1 rounded-circle align-items-center"></i>
                            </p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-1 text-center">
                            <span class="section-title">S.L No:</span>
                            <span class="badge badge-custom ms-2">11</span>
                        </div>
                        <div class="mb-2 text-center">
                            <p class="mb-0"><strong>Visit Date:</strong> 10/08/2024</p>
                            <p class="mb-0"><strong>Department/Category:</strong> Cardiologist</p>
                            <p class="mb-0"><strong>Doctor:</strong> Dr. Md. Jasim Uddin</p>
                        </div>
                        <form>
                            <div class="mb-2">
                                <label for="patientMobile" class="form-label mb-0">Patient Mobile/Mail</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="patientMobile">
                                    <button class="btn btn-danger" type="button">✔</button>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label for="patientName" class="form-label mb-0">Patient Name</label>
                                <input type="text" class="form-control" id="patientName">
                            </div>
                            <div class="row mb-0 g-2">
                                <div class="col-md-6">
                                    <label for="gender" class="form-label mb-0">Gender</label>
                                    <select class="form-select" id="gender">
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="age" class="form-label mb-0">Age</label>
                                    <input type="number" class="form-control" id="age">
                                </div>
                            </div>
                            <div class="row g-2 mt-1">
                                <div class="col-md-6">
                                    <label for="visitTime" class="form-label mb-0">Visit Time</label>
                                    <select class="form-select" id="visitTime">
                                        <option>Morning</option>
                                        <option>Afternoon</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="payment" class="form-label mb-0">Payment</label>
                                    <select class="form-select" id="payment">
                                        <option>Paid</option>
                                        <option>Unpaid</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2 mt-3">
                                <label for="remenance" class="form-label mb-0">Remenance</label>
                                <input type="text" class="form-control" id="remenance">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label mb-0">Description</label>
                                <textarea class="form-control" id="description" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-custom w-100">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-section">
                    <div class="d-flex justify-content-between mb-3">
                        <h6 class="text-center">Discount</h6>
                        <span><i class="fa-solid fa-xmark text-white bg-danger p-1 rounded-circle"></i></span>
                    </div>
                    <form>
                        <div class="mb-3">
                            <label for="fee" class="form-label mb-0">Fee</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="fee">
                                <input type="text" class="form-control" placeholder="Amount">
                                <input type="text" class="form-control" placeholder="%">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="reference" class="form-label mb-0">Reference</label>
                            <input type="text" class="form-control" id="reference">
                        </div>
                        <div class="mb-3">
                            <label for="narration" class="form-label mb-0">Narration</label>
                            <textarea class="form-control" id="narration" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-custom w-100">Ok</button>
                    </form>
                </div>
                <div class="form-section mt-3">
                    <div class="d-flex justify-content-between mb-3">
                        <h6 class="text-center">Free</h6>
                        <span><i class="fa-solid fa-xmark text-white bg-danger p-1 rounded-circle"></i></span>
                    </div>
                    <form>
                        <div class="mb-3">
                            <label for="referenceFree" class="form-label mb-0">Reference</label>
                            <input type="text" class="form-control" id="referenceFree">
                        </div>
                        <div class="mb-3">
                            <label for="narrationFree" class="form-label mb-0">Narration</label>
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
        return {};
    },
};
</script>

<style scoped>
.hh {
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

.Appointment-text {
    color: #8c8794;
    font-weight: bold;
}
</style>
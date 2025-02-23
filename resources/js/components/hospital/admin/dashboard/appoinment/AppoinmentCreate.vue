<template>
    <div class="container">
        <div class="row">
            <div class="container">
                <div class="row justify-content-center">
                    <!-- Main Card -->
                    <div
                        :class="{ 'col-lg-8': form.payment === 'Discount' || form.payment === 'Free', 'col-lg-12': !(form.payment === 'Discount' || form.payment === 'Free') }">
                        <div class="card w-100">
                            <div class="card-header d-flex justify-content-between"
                                style="background-color: #f6f6f6; color: #a0b1bf; font-weight: bold;">
                                <h6 class="text-center">Appointment</h6>
                                <!-- <p><i class="fa-solid fa-xmark text-white bg-danger p-1 rounded-circle"></i></p> -->
                            </div>
                            <div class="card-body">
                                <div class="mb-1 text-center">
                                    <span class="section-title">S.L No:</span>
                                    <span class="badge badge-custom ms-2">102</span>
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
                                            <input type="text" class="form-control" id="patientMobile"
                                                placeholder="patient mobile/mail">
                                            <button class="btn btn-danger" type="button">✔</button>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label for="patientName" class="form-label mb-0">Patient Name</label>
                                        <input type="text" class="form-control" id="patientName"
                                            placeholder="patient name">
                                    </div>
                                    <div class="row mb-0 g-2">
                                        <div class="col-md-6">
                                            <label for="gender" class="form-label mb-0">Gender</label>
                                            <select class="form-select" id="gender">
                                                <option selected value="" disabled>Select an option</option>
                                                <option>Male</option>
                                                <option>Female</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="age" class="form-label mb-0">Age</label>
                                            <input type="number" class="form-control" id="age" placeholder="age">
                                        </div>
                                    </div>
                                    <div class="row g-2 mt-1">
                                        <div class="col-md-6">
                                            <label for="visitTime" class="form-label mb-0">Visit Time</label>
                                            <select class="form-select" id="visitTime">
                                                <option selected value="" disabled>Select an option</option>
                                                <option>1st Time</option>
                                                <option>2nd Time</option>
                                                <option>3rd Time</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="payment" class="form-label mb-0">Payment</label>
                                            <select v-model="form.payment" class="form-select" id="payment">
                                                <option selected value="" disabled>Select an option</option>
                                                <option>Paid</option>
                                                <option>Unpaid</option>
                                                <option>Discount</option>
                                                <option>Free</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-2 mt-3">
                                        <label for="remenance" class="form-label mb-0">Reference</label>
                                        <select id="reference" class="form-select">
                                            <option value="" selected>Choose...</option>
                                            <option v-for="reference in references" :key="reference.id"
                                                :value="reference.name">{{
                                                    reference.name }}</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label mb-0">Description</label>
                                        <textarea class="form-control" id="description" rows="3"
                                            placeholder="description"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-custom w-100">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Extra Section (Discount/Free) -->
                    <div class="col-lg-4" v-if="form.payment === 'Discount' || form.payment === 'Free'">
                        <div class="form-section" v-if="form.payment === 'Discount'">
                            <div class="d-flex justify-content-between mb-3">
                                <h6 class="text-center">Discount</h6>
                                <span><i class="fa-solid fa-xmark text-white bg-danger p-1 rounded-circle"
                                        style="cursor: pointer;" @click="hideContent"></i></span>
                            </div>
                            <form>
                                <div class="mb-3">
                                    <label for="fee" class="form-label mb-0">Fee</label>
                                    <!-- <div class="input-group">
                                        <input type="text" v-model="fee" class="form-control" id="fee" placeholder="Fee"
                                            @input="calculateFromFeeAndAmount" />
                                        <input type="text" v-model="amount" class="form-control" placeholder="%"
                                            @input="calculateFromFeeAndAmount" />
                                        <input type="text" v-model="percentage" class="form-control" placeholder="TK"
                                            @input="calculateFromFeeAndPercentage" />
                                    </div> -->
                                    <div class="input-group">
                                        <input type="text" v-model="fee" class="form-control" id="fee" placeholder="Fee"
                                            @input="calculateValues" />
                                        <input type="text" v-model="amount" class="form-control" placeholder="%"
                                            @input="calculateFromFeeAndAmount" />
                                        <input type="text" v-model="percentage" class="form-control" placeholder="TK"
                                            @input="calculateFromFeeAndPercentage" />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="reference" class="form-label mb-0">Reference</label>
                                    <input type="text" class="form-control" id="reference" placeholder="reference">
                                </div>
                                <div class="mb-3">
                                    <label for="narration" class="form-label mb-0">Narration</label>
                                    <textarea class="form-control" id="narration" rows="3"
                                        placeholder="narration"></textarea>
                                </div>
                                <button type="submit" class="btn btn-custom w-100">Ok</button>
                            </form>
                        </div>

                        <div class="form-section mt-3" v-if="form.payment === 'Free'">
                            <div class="d-flex justify-content-between mb-3">
                                <h6 class="text-center">Free</h6>
                                <span><i class="fa-solid fa-xmark text-white bg-danger p-1 rounded-circle"
                                        @click="hideContent" style="cursor: pointer;"></i></span>
                            </div>
                            <form>
                                <div class="mb-3">
                                    <label for="referenceFree" class="form-label mb-0">Reference</label>
                                    <input type="text" class="form-control" id="referenceFree" placeholder="reference">
                                </div>
                                <div class="mb-3">
                                    <label for="narrationFree" class="form-label mb-0">Narration</label>
                                    <textarea class="form-control" id="narrationFree" rows="3"
                                        placeholder="narration"></textarea>
                                </div>
                                <button type="submit" class="btn btn-custom w-100">Ok</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import { ref, computed, onMounted, watch } from 'vue';
import Cookies from 'js-cookie';
export default {
    name: "AppoinmentCreate",
    setup() {

        const form = ref({
            payment: '',
        })

        const references = ref([]);
        const access_token = ref('');

        const fee = ref('');
        const amount = ref('');
        const percentage = ref('');

        const fetchReference = async () => {
            try {
                const response = await axios.get('/api/auth/reference', {
                    headers: {
                        'Authorization': `Bearer ${access_token.value}`
                    }
                });
                if (response.data && response.status === 200) {
                    references.value = response.data;
                }
            } catch (error) {
            }
        }
        // const calculateFromFeeAndAmount = () => {
        //     percentage.value = '';
        //     if (fee.value && amount.value) {
        //         const discount = (fee.value * amount.value) / 100;
        //         percentage.value = (fee.value - discount).toFixed(2) + ' Tk';;
        //     }
        // };

        // const calculateFromFeeAndPercentage = () => {
        //     amount.value = '';
        //     if (fee.value && percentage.value) {
        //         amount.value = (((fee.value - percentage.value) / fee.value) * 100).toFixed(0) + ' %';
        //     }
        // };
        const calculateFromFeeAndAmount = () => {
            if (fee.value && amount.value) {
                const discount = (parseFloat(fee.value) * parseFloat(amount.value)) / 100;
                // percentage.value = (parseFloat(fee.value) - discount).toFixed(2) + ' Tk';
                percentage.value = (!isNaN(parseFloat(fee.value)) && !isNaN(discount))
                    ? (parseFloat(fee.value) - discount).toFixed(2) + ' Tk'
                    : 0;
            }
        };

        const calculateFromFeeAndPercentage = () => {
            if (fee.value && percentage.value) {
                const percentageValue = parseFloat(percentage.value);
                if (!isNaN(percentageValue)) {
                    // amount.value = (((parseFloat(fee.value) - percentageValue) / parseFloat(fee.value)) * 100).toFixed(0) + ' %';
                    amount.value = (
                        !isNaN(parseFloat(fee.value)) && !isNaN(percentageValue) && !isNaN(parseFloat(fee.value))
                    )
                        ? (((parseFloat(fee.value) - percentageValue) / parseFloat(fee.value)) * 100).toFixed(0) + ' %'
                        : 0;
                }
            }
        };

        // Watch for changes in `fee` and update values dynamically
        watch(fee, (newValue) => {
            if (newValue && amount.value) {
                calculateFromFeeAndAmount();
            } else if (newValue && percentage.value) {
                calculateFromFeeAndPercentage();
            } else {
                amount.value = '';
                percentage.value = '';
            }
        });


        const hideContent = () => {
            if (form.value.payment === 'Discount') {
                form.value.payment = '';
            } else if (form.value.payment === 'Free') {
                form.value.payment = '';
            }
        };
        onMounted(() => {
            access_token.value = Cookies.get('access_token');
            fetchReference()
        })
        return {
            form,
            fee,
            amount,
            percentage,
            hideContent,
            access_token,
            references,
            calculateFromFeeAndAmount,
            calculateFromFeeAndPercentage,
        };
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

.card {
    transition: width 0.3s ease-in-out;
}
</style>
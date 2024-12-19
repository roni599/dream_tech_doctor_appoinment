<template>
    <div class="container d-flex align-items-center justify-content-center py-4"
        style="min-height: 100vh; overflow: hidden">
        <div class="row justify-content-center" style="width: 100%; height: 100%">
            <div class="col-lg-10 col-md-12" style="max-width: 1300px; width: 100%; height: 100%">
                <div class="card dd card-primary" style="height: 100%; width: 100%; overflow: hidden">
                    <h3 class="text-center mt-4">{{ heading }}</h3>
                    <div class="card-body dd d-flex flex-column flex-lg-row align-items-center p-lg-5 p-3"
                        style="overflow-y: auto; height: 100%; max-height: calc(100vh - 90px);">
                        <div class="hospital_image w-100 w-lg-50 mb-4 mb-lg-0 text-center">
                            <img src="../../../../../../public/hospital/backend/app/assets/img/heartboard-1.png"
                                class="img-fluid" style="max-width: 550px; height: auto" alt="Hospital Image" />
                        </div>
                        <div
                            class="login-container w-100 w-lg-50 d-flex flex-column justify-content-center align-items-center">
                            <form v-show="currentStep === 'initialForm'" @submit.prevent="storeData('otpCheck')"
                                class="w-100 px-3 p-3">
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <input type="text" class="form-control" placeholder="Hospital Name" required />
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <input type="text" class="form-control" placeholder="Reg. Number" required />
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <input type="text" class="form-control" placeholder="Establish" required />
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <input type="text" class="form-control" placeholder="Country" required />
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <input type="text" class="form-control" placeholder="Division" required />
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <input type="text" class="form-control" placeholder="District" required />
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <input type="text" class="form-control" placeholder="Sub District" required />
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <input type="text" class="form-control" placeholder="Location Details"
                                            required />
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <input type="tel" class="form-control" placeholder="Mobile Number" required />
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <input type="tel" class="form-control" placeholder="Mobile Number" required />
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <input type="email" class="form-control" placeholder="E-Mail" required />
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <input type="text" class="form-control" placeholder="Admin Name" required />
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <input type="tel" class="form-control" placeholder="Admin Mobile" required />
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <input type="email" class="form-control" placeholder="Admin E-Mail" required />
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <input type="password" class="form-control" placeholder="Password" required />
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <input type="password" class="form-control" placeholder="Re-Password"
                                            required />
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label class="form-label">Logo</label>
                                        <input type="file" class="form-control" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Hospital/Medical Front Picture</label>
                                        <input type="file" class="form-control" />
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary w-100">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div v-if="currentStep === 'otpCheck'" class="text-center mb-1">
                                <p v-if="timer > 0" class="text-danger fw-bold mb-0">OTP expired on: {{ formattedTimer
                                    }}</p>
                                <p v-else class="text-danger fw-bold mb-0">Time is up! Please restart the process.</p>
                            </div>
                            <form v-show="currentStep === 'otpCheck'" @submit.prevent="storeData('otpCheck')"
                                class="w-100 px-3">
                                <div class="mb-3">
                                    <input type="text" class="form-control w-100" placeholder="Enter your OTP"
                                        required />
                                </div>
                                <router-link to="/" :disabled="buttonDesable" class="btn btn-primary w-100">Check
                                    OTP</router-link>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, computed } from "vue";

export default {
    name: "Register",
    setup() {
        const currentStep = ref("initialForm");
        const heading = ref('Welcome To Sign Up');
        const timer = ref(0);
        const buttonDesable = ref(false);
        let timerInterval = null;

        const storeData = (nextStep) => {
            if (nextStep === "otpCheck") {
                heading.value = "Check Your Email For Otp"
                startTimer();
            }
            currentStep.value = nextStep;
        };
        const startTimer = () => {
            timer.value = 120;
            timerInterval = setInterval(() => {
                if (timer.value > 0) {
                    timer.value -= 1
                }
                else {
                    stopTimer()
                }
            }, 1000)
        }
        const stopTimer = () => {
            timer.value = 0;
            buttonDesable.value = true;
            if (timerInterval) {
                clearInterval(timerInterval);
                timerInterval = null
            }
        }

        const formattedTimer = computed(() => {
            const minutes = Math.floor(timer.value / 60);
            const seconds = timer.value % 60;
            return `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
        });
        return {
            heading,
            currentStep,
            storeData,
            timer,
            buttonDesable,
            formattedTimer
        };
    },
};
</script>

<style scoped></style>
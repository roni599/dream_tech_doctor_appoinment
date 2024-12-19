<template>
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="row justify-content-center" style="width: 100%;">
            <div class="col-lg-6 col-md-8" style="max-width: 1300px; width: 100%;">
                <div class="card card-primary" style="height: 80vh; width: 100%;">
                    <h3 class="text-center mt-5">{{ heading }}</h3>
                    <div class="card-body d-flex flex-column flex-lg-row align-items-center mt-3">
                        <div class="hospital_image w-100 w-lg-50 mb-4 mb-lg-0 text-center">
                            <img src="../../../../../../public/hospital/backend/app/assets/img/heartboard-1.png"
                                class="img-fluid" style="max-width: 550px; height: auto;" alt="Hospital Image">
                        </div>
                        <div
                            class="login-container w-100 w-lg-50 d-flex flex-column justify-content-center align-items-center">
                            <form v-show="currentStep === 'forgetForm'" @submit.prevent="handleStep('otpCheckForm')"
                                class="w-75">
                                <div class="mb-3">
                                    <input type="email" class="form-control" placeholder="Enter your E-Mail" required />
                                </div>
                                <button class="btn btn-primary w-100">Submit</button>
                            </form>
                            <div v-if="currentStep === 'otpCheckForm'" class="text-center mb-1">
                                <p v-if="timer > 0" class="text-danger fw-bold mb-0">OTP expired on: {{ formattedTimer
                                    }}</p>
                                <p v-else class="text-danger fw-bold mb-0">Time is up! Please restart the process.</p>
                            </div>
                            <form v-show="currentStep === 'otpCheckForm'" @submit.prevent="handleStep('resetPassword')"
                                class="w-75">
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Enter your OTP" required />
                                </div>
                                <button :disabled="buttonDesable" class="btn btn-primary w-100">Check OTP</button>
                            </form>

                            <form v-show="currentStep === 'resetPassword'" @submit.prevent="handleStep('complete')"
                                class="w-75">
                                <div class="mb-3 position-relative">
                                    <input :type="eye ? 'text' : 'password'" class="form-control" placeholder="Password"
                                        required>
                                    <button type="button" @click="eye = !eye"
                                        class="btn btn-link position-absolute end-0 top-0" style="margin: 5px;">
                                        <i
                                            :class="eye ? 'fa-solid fa-eye text-black fs-6' : 'fa-solid fa-eye-slash text-black fs-6'"></i>
                                    </button>
                                </div>
                                <div class="mb-3 position-relative">
                                    <input :type="confirmEye ? 'text' : 'password'" class="form-control"
                                        placeholder="Confirm password" required>
                                    <button type="button" @click="confirmEye = !confirmEye"
                                        class="btn btn-link position-absolute end-0 top-0" style="margin: 5px;">
                                        <i
                                            :class="confirmEye ? 'fa-solid fa-eye text-black fs-6' : 'fa-solid fa-eye-slash text-black fs-6'"></i>
                                    </button>
                                </div>
                                <router-link to="/" type="submit" class="btn btn-primary w-100">Reset
                                    Password</router-link>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, computed } from 'vue';

export default {
    name: 'Forget',
    setup() {
        const heading = ref('Reset Your Password');
        const currentStep = ref('forgetForm');
        const eye = ref(false);
        const confirmEye = ref(false);
        const timer = ref(0);
        const buttonDesable = ref(false);
        let timerInterval = null;


        const handleStep = (nextStep) => {
            if (nextStep === 'otpCheckForm') {
                heading.value = "Check Your Email For Otp"
                startTimer();
            }
            if (nextStep === 'resetPassword') {
                heading.value = 'Reset Your Password'
                stopTimer();
            }
            if (nextStep === 'complete') {
                console.log('complete')
            }
            currentStep.value = nextStep;
        };

        const startTimer = () => {
            timer.value = 60;
            timerInterval = setInterval(() => {
                if (timer.value > 0) {
                    timer.value -= 1;
                } else {
                    stopTimer();
                }
            }, 1000);
        };

        const stopTimer = () => {
            timer.value = 0;
            buttonDesable.value = true;
            if (timerInterval) {
                clearInterval(timerInterval);
                timerInterval = null;
            }
        };

        const formattedTimer = computed(() => {
            const minutes = Math.floor(timer.value / 60);
            const seconds = timer.value % 60;
            return `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
        });


        return {
            heading,
            currentStep,
            handleStep,
            eye,
            confirmEye,
            timer,
            formattedTimer,
            buttonDesable
        }
    }
}
</script>

<style></style>
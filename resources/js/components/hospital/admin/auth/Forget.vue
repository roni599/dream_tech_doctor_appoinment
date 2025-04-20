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
                                    <input type="email" class="form-control" placeholder="Enter your E-Mail" required
                                        v-model="forgetForm.admin_email" />
                                </div>
                                <button class="btn btn-primary w-100">Submit</button>
                            </form>
                            <div v-if="currentStep === 'otpCheckForm'" class="text-center mb-1">
                                <p v-if="timer > 0" class="text-danger fw-bold mb-0">OTP expired on: {{ formattedTimer
                                    }}</p>
                                <p v-else class="text-danger fw-bold mb-0">Time is up! Please restart the process or
                                    resend OTP.</p>
                                <p v-if="timer > 0" class="text-danger fw-bold mb-0">{{ otpText }}</p>
                                <button v-if="timer === 0" class="btn btn-primary w-100 mb-2"
                                    @click="handleStep('otpCheckForm')">Resend
                                    Otp?</button>
                            </div>
                            <form v-if="timer > 0" v-show="currentStep === 'otpCheckForm'"
                                @submit.prevent="handleStep('resetPassword')" class="w-75">
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Enter your OTP" required
                                        v-model="forgetForm.otp_check" />
                                </div>
                                <button class="btn btn-primary w-100">Check OTP</button>
                            </form>

                            <form v-show="currentStep === 'resetPassword'" @submit.prevent="handleStep('complete')"
                                class="w-75">
                                <div class="mb-3 position-relative">
                                    <input :type="eye ? 'text' : 'password'" class="form-control" placeholder="Password"
                                        required v-model="forgetForm.password">
                                    <button type="button" @click="eye = !eye"
                                        class="btn btn-link position-absolute end-0 top-0" style="margin: 5px;">
                                        <i
                                            :class="eye ? 'fa-solid fa-eye text-black fs-6' : 'fa-solid fa-eye-slash text-black fs-6'"></i>
                                    </button>
                                    <small class="text-danger" v-if="errors.password">{{ errors.password[0] }}</small>
                                </div>
                                <div class="mb-3 position-relative">
                                    <input :type="confirmEye ? 'text' : 'password'" class="form-control"
                                        placeholder="Confirm password" required
                                        v-model="forgetForm.password_confirmation">
                                    <button type="button" @click="confirmEye = !confirmEye"
                                        class="btn btn-link position-absolute end-0 top-0" style="margin: 5px;">
                                        <i
                                            :class="confirmEye ? 'fa-solid fa-eye text-black fs-6' : 'fa-solid fa-eye-slash text-black fs-6'"></i>
                                    </button>
                                    <small class="text-danger" v-if="errors.password">{{ errors.password[0] }}</small>
                                </div>
                                <button class="btn btn-primary w-100">Reset Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { ref, computed } from 'vue';
import { useRouter } from 'vue-router';
export default {
    name: 'Forget',
    setup() {
        const router = useRouter();
        const heading = ref('Reset Your Password');
        const currentStep = ref('forgetForm');
        const eye = ref(false);
        const confirmEye = ref(false);
        const timer = ref(0);
        const buttonDesable = ref(false);
        let timerInterval = null;
        const otpText = ref('')
        const errors = ref({});

        const forgetForm = ref({
            admin_email: '',
            otp_check: '',
            password: '',
            password_confirmation: ''
        })

        const handleStep = async (nextStep) => {
            if (nextStep === 'otpCheckForm') {
                otpText.value = '';
                forgetForm.value.otp_check = ''
                try {
                    const response = await axios.post('/api/auth/send_otp', {
                        admin_email: forgetForm.value.admin_email,
                    });
                    if (response.data) {
                        heading.value = "Check Your Email For Otp"
                        startTimer();
                        currentStep.value = nextStep;
                    }
                } catch (error) {
                    console.log(error)
                }
            }
            if (nextStep === 'resetPassword') {
                try {
                    const response = await axios.post('/api/auth/password_reset_otp_check', forgetForm.value);
                    console.log(response)
                    if (response.data) {
                        currentStep.value = nextStep;
                        heading.value = 'Reset Your Password'
                    }
                } catch (error) {
                    otpText.value = error.response.data.otpMessage;
                }
            }
            if (nextStep === 'complete') {
                try {
                    const response = await axios.post('/api/auth/reset_password', forgetForm.value);
                    if (response.data) {
                        router.push({ name: 'Login' });
                    }
                } catch (error) {
                    console.log(error)
                    errors.value = error.response.data.errors;
                }
            }
        };

        const startTimer = () => {
            timer.value = 120;
            timerInterval = setInterval(() => {
                if (timer.value > 0) {
                    timer.value -= 1;
                } else {
                    otpText.value = '';
                    stopTimer();
                }
            }, 1000);
        };

        const stopTimer = () => {
            otpText.value = '';
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
            buttonDesable,
            forgetForm,
            otpText,
            errors
        }
    }
}
</script>

<style></style>
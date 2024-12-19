<template>
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="row justify-content-center" style="width: 100%;">
            <div class="col-lg-6 col-md-8" style="max-width: 1300px; width: 100%;">
                <div class="card card-primary" style="height: 80vh; width: 100%;">
                    <h3 class="text-center mt-5">Welcome to Login</h3>
                    <div class="card-body d-flex flex-column flex-lg-row align-items-center mt-3">
                        <div class="hospital_image w-100 w-lg-50 mb-4 mb-lg-0 text-center">
                            <img src="../../../../../../public/hospital/backend/app/assets/img/heartboard-1.png"
                                class="img-fluid" style="max-width: 550px; height: auto;" alt="Hospital Image">
                        </div>
                        <div
                            class="login-container w-100 w-lg-50 d-flex flex-column justify-content-center align-items-center">
                            <form class="w-75">
                                <div class="mb-3">
                                    <input type="email" class="form-control" placeholder="Admin E-Mail" required>
                                </div>
                                <div class="mb-3 position-relative">
                                    <input :type="eye ? 'text' : 'password'" class="form-control" placeholder="Password"
                                        required>
                                    <button type="button" @click="eye = !eye"
                                        class="btn btn-link position-absolute end-0 top-0" style="margin: 5px;">
                                        <i
                                            :class="eye ? 'fa-solid fa-eye text-black fs-6' : 'fa-solid fa-eye-slash text-black fs-6'"></i>
                                    </button>
                                </div>
                                <router-link to="/hospital_dashboard" type="submit"
                                    class="btn btn-primary w-100">Login</router-link>
                            </form>
                            <div
                                class="footer-links mt-4 w-75 d-flex justify-content-between align-items-center flex-wrap flex-md-nowrap">
                                <div class="forgate w-100 w-md-50 text-center text-md-start mb-2 mb-md-0">
                                    <router-link to="/forget" href="#" class="text-decoration-none">Forget Password?</router-link>
                                </div>
                                <div class="create_hospital w-100 w-md-50 text-center text-md-end">
                                    <router-link to="/register" href="#" class="text-decoration-none fw-bold">Create
                                        Hospital/Medical</router-link>
                                </div>
                            </div>

                            <div class="social-icons mt-4 w-75 d-flex justify-content-center align-items-center gap-2">
                                <a href="#"><i class="fs-4 fa-brands fa-facebook facebook"></i></a>
                                <a href="#"><i class="fs-4 fa-brands fa-telegram telegram"></i></a>
                                <a href="#"><i class="fs-4 fa-brands fa-whatsapp whatsapp"></i></a>
                                <a href="#"><i class="fs-4 fa-brands fa-youtube youtube"></i></a>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from 'vue';

export default {
    name: 'Login',
    setup() {
        let eye = ref(false);
        return {
            eye,
        }
    }
}
</script>

<style scoped>
.facebook {
    color: #184587;
}

.telegram {
    color: #30a7de;
}

.whatsapp {
    color: #8bc84d;
}

.youtube {
    color: #ff3131;
}

/* @media (max-width: 768px) {
    .card-body {
        margin-top: -5rem !important;
    }
} */
</style>
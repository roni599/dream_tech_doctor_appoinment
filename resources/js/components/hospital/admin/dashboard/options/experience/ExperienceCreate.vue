<template>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3 w-100">
            <div class="d-flex w-100 mb-2 mb-sm-0">
                <router-link to="/experience" class="btn btn-primary ms-2">
                    + Experience List
                </router-link>
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <div class="card" style="width: 1300px;">
                <div class="card-header mt-2">
                    <h5 class="card-title">Experience Create</h5>
                </div>
                <div class="card-body">
                    <form @submit.prevent="submitExperience">
                        <div class="row form-section mb-4">
                            <div class="col-md-12">
                                <label for="department" class="form-label mb-0">Experience</label>
                                <input v-model="form.experience" type="text" class="form-control" id="reg-number">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-primary me-3 w-100">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { onMounted, ref } from 'vue';
import Cookies from 'js-cookie';
import { useRouter } from 'vue-router';
export default {
    name: "ExperienceCreate",
    setup() {
        const access_token = ref('access_token');
        const router = useRouter();
        const form = ref({
            experience: ''
        })
        const submitExperience = async () => {
            try {
                const response = await axios.post('/api/auth/experience/store', form.value, {
                    headers: {
                        'Authorization': `Bearer ${access_token.value}`
                    }
                });
                if (response.data && response.status === 201) {
                    router.push({name:"Experience"})
                    Swal.fire({
                        title: response.data.message,
                        icon: "success",
                        draggable: true
                    });
                    form.value.experience = '';
                }
            } catch (error) {
                console.log(error)
            }
        }
        onMounted(() => {
            access_token.value = Cookies.get('access_token');
        })
        return {
            form,
            submitExperience
        }
    }
}
</script>

<style></style>
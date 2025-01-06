<template>
    <div class="d-flex justify-content-center align-items-center">
        <div class="card" style="width: 1230px;">
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
</template>

<script>
import axios from 'axios';
import { onMounted, ref } from 'vue';
import Cookies from 'js-cookie';
export default {
    name: "ExperienceCreate",
    setup() {
        const currentComponent = ref(false);
        const access_token = ref('access_token');
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
            currentComponent,
            form,
            submitExperience
        }
    }
}
</script>

<style></style>
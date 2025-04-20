<template>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3 w-100">
            <div class="d-flex w-100 mb-2 mb-sm-0">
                <router-link to="/specialist" class="btn btn-primary ms-2">
                    + Specialist List
                </router-link>
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <div class="card" style="width: 1300px;">
                <div class="card-header mt-2">
                    <h5 class="card-title">Specialist Create</h5>
                </div>
                <div class="card-body">
                    <form @submit.prevent="submitSpecialist">
                        <div class="row form-section mb-4">
                            <div class="col-md-12">
                                <label for="department" class="form-label mb-0">Specialist</label>
                                <input v-model="form.specialist" type="text" class="form-control" id="reg-number">
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
import { onMounted, ref } from 'vue';
import Cookies from 'js-cookie';
import axios from 'axios';
import { useRouter } from 'vue-router';
export default {
    name: "Specialist",
    setup() {
        const access_token = ref('');
        const router = useRouter();
        const form = ref({
            specialist: ''
        })
        const submitSpecialist = async () => {
            try {
                const response = await axios.post('/api/auth/specialist/store', form.value, {
                    headers: {
                        Authorization: `Bearer ${access_token.value}`,
                    },
                })
                if (response.data && response.status === 201) {
                    Swal.fire({
                        title: response.data.message,
                        icon: "success",
                        draggable: true
                    });
                    form.value.specialist = '';
                    router.push({name:"Specialist"})
                }

            } catch (error) {
                console.log(error.response)
            }
        }
        onMounted(() => {
            access_token.value = Cookies.get('access_token');
        })
        return {
            form,
            submitSpecialist
        }
    }
}
</script>

<style></style>
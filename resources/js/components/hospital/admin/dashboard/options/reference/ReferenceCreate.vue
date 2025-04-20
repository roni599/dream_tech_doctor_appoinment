<template>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3 w-100">
            <div class="d-flex w-100 mb-2 mb-sm-0">
                <router-link to="/reference" class="btn btn-primary ms-2">
                    + Reference List
                </router-link>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center align-items-center">
        <div class="card" style="width: 1300px;">
            <div class="card-header" style="background-color: rgb(248,249,250)">
                <h5 class="card-title align-items-center mt-2 mb-0">Reference Create</h5>
            </div>
            <div class="card-body">
                <form @submit.prevent="submitReference">
                    <div class="row form-section mb-3">
                        <div class="col-md-6">
                            <label for="department" class="form-label mb-0">Referencer Name</label>
                            <input type="text" v-model="form.name" class="form-control" id="referenceName"
                                placeholder="Mr. John Doe">
                        </div>
                        <div class="col-md-6">
                            <label for="department" class="form-label mb-0">Referencer Email</label>
                            <input type="email" v-model="form.email" class="form-control" id="referenceEmail"
                                placeholder="reference@gmail.com">
                        </div>
                    </div>
                    <div class="row form-section mb-4">
                        <div class="col-md-6">
                            <label for="department" class="form-label mb-0">Referencer Phone</label>
                            <input type="text" v-model="form.phone" class="form-control" id="referencePhone"
                                placeholder="+880">
                        </div>
                        <div class="col-md-6">
                            <label for="department" class="form-label mb-0">Referencer Address</label>
                            <input type="text" v-model="form.address" class="form-control" id="referenceAddress"
                                placeholder="#House,#road,#city">
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
import { useRouter } from 'vue-router';
export default {
    name: "ReferenceCreate",
    setup() {
        const access_token = ref('access_token');
        const router = useRouter();
        const form = ref({
            name: '',
            email: '',
            phone: '',
            address: ''
        })
        const submitReference = async () => {
            try {
                const response = await axios.post('/api/auth/reference/store', form.value, {
                    headers: {
                        'Authorization': `Bearer ${access_token.value}`
                    }
                });
                if (response.data && response.status === 201) {
                    router.push({name:"ReferenceList"})
                    Swal.fire({
                        title: response.data.message,
                        icon: "success",
                        draggable: true
                    });
                    formReset();
                }
            } catch (error) {
                console.log(error)
            }
        }
        const formReset = async () => {
            form.value.name = '';
            form.value.email = '';
            form.value.phone = '';
            form.value.address = '';
        }
        onMounted(() => {
            access_token.value = Cookies.get('access_token');
        })
        return {
            form,
            submitReference
        }
    }
}
</script>

<style></style>
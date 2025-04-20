<template>
    <router-link to="/reference" class="btn btn-primary w-100 mb-2">
        <i class="fa-solid fa-list"></i> Reference List</router-link>
    <div class="d-flex justify-content-center align-items-center">
        <div class="card w-100" style="max-width: 1230px">
            <div class="card-header mt-2">
                <h5 class="card-title">Reference Edit</h5>
            </div>
            <div class="card-body">
                <form @submit.prevent="submitReferenceEdit">
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
                    <div class="row form-section mb-4">
                        <div class="col-md-12">
                            <label for="department" class="form-label mb-0">Reference Status</label>
                            <select v-model="form.status" id="reference_status" class="form-select">
                                <option value="" selected>Choose...</option>
                                <option value="1">Active</option>
                                <option value="0">Deactive</option>
                            </select>
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
import axios from "axios";
import { onMounted, ref } from "vue";
import { useRoute,useRouter } from "vue-router";
import Cookies from "js-cookie";
import CryptoJS from 'crypto-js';
export default {
    name: "ReferenceEdit",
    setup() {
        const router = useRouter();
        const route=useRoute();
        const reference_id = ref("");
        const access_token = ref("");

        const form = ref({
            id: '',
            name: '',
            email: '',
            phone: '',
            address: '',
            status:''
        })

        const referenceEditView = async () => {
            try {
                const response = await axios.get(`/api/auth/reference/referencedata/${reference_id.value}`,
                    {
                        headers: {
                            Authorization: `Bearer ${access_token.value}`,
                        },
                    }
                );
                if (response.data && response.status === 200) {
                    form.value.id = response.data.id;
                    form.value.name = response.data.name;
                    form.value.email = response.data.email;
                    form.value.phone = response.data.phone;
                    form.value.address = response.data.address;
                    form.value.status = response.data.status;
                }
            } catch (error) {
                console.log(error.response);
            }
        };

        const submitReferenceEdit = async () => {
            try {
                const response = await axios.post("/api/auth/reference/referenceedit", form.value,
                    {
                        headers: {
                            Authorization: `Bearer ${access_token.value}`,
                        },
                    }
                );
                if (response.data && response.status === 200) {
                    Swal.fire({
                        title: response.data.message,
                        icon: "success",
                        draggable: true,
                    });
                    form.value.name = response.data.reference.nme;
                    form.value.email = response.data.reference.email;
                    form.value.phone = response.data.reference.phone;
                    form.value.address = response.data.reference.address;
                    form.value.status = response.data.reference.status;
                    router.push({name:"ReferenceList"})
                }
            } catch (error) {
                console.log(error)
            }
        };

        onMounted(() => {
            access_token.value = Cookies.get("access_token");
            const encryptedId = route.params.id;
            reference_id.value = decryptId(encryptedId);
            referenceEditView()
        });
        const decryptId = (encryptedId) => {
            const bytes = CryptoJS.AES.decrypt(encryptedId, access_token.value);
            return bytes.toString(CryptoJS.enc.Utf8);
        }
        return {
            form,
            submitReferenceEdit
        }
    }
}
</script>

<style></style>
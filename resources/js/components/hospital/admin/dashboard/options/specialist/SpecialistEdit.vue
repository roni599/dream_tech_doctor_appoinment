<template>
    <router-link to="/specialist" class="btn btn-primary w-100 mb-2">
        <i class="fa-solid fa-list"></i> Specialist List</router-link>
    <div class="d-flex justify-content-center align-items-center">
        <div class="card w-100" style="max-width: 1230px">
            <div class="card-header mt-2">
                <h5 class="card-title">Symptom Create</h5>
            </div>
            <div class="card-body">
                <form @submit.prevent="submitSpecialistEdit">
                    <div class="row form-section mb-4">
                        <div class="col-md-12">
                            <label for="symptom" class="form-label mb-0">Symptom</label>
                            <input v-model="form.specialist" type="text" class="form-control" id="symptom" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-primary w-100">Save</button>
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
import Cookies from "js-cookie";
import { useRoute,useRouter } from "vue-router";
export default {
    name: "SpecialistEdit",
    setup() {
        const router = useRouter();
        const route=useRoute();
        const specialist_id = ref("");
        const access_token = ref("");
        const form = ref({
            id: "",
            specialist: "",
        });

        const submitSpecialistEdit = async () => {
            try {
                const response = await axios.post(
                    "/api/auth/specialist/specialistedit",
                    form.value,
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
                    form.value.specialist = response.data.specialist.specialist;
                    router.push({name:"Specialist"})
                }
            } catch (error) {
                console.log(error)
            }
        };

        const symtomEditView = async () => {
            try {
                const response = await axios.get(`/api/auth/specialist/specialistditdata/${specialist_id.value}`,
                    {
                        headers: {
                            Authorization: `Bearer ${access_token.value}`,
                        },
                    }
                );
                if (response.data && response.status === 200) {
                    form.value.specialist = response.data.specialist;
                    form.value.id = response.data.id;
                }
            } catch (error) {
                console.log(error.response);
            }
        };

        onMounted(() => {
            access_token.value = Cookies.get("access_token");
            specialist_id.value = route.params.id;
            symtomEditView();
        });
        return {
            form,
            submitSpecialistEdit
        }
    }
}
</script>

<style></style>
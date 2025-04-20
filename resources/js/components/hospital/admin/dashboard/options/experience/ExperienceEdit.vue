<template>
    <router-link to="/experience" class="btn btn-primary w-100 mb-2">
        <i class="fa-solid fa-list"></i> Experience List</router-link>
    <div class="d-flex justify-content-center align-items-center">
        <div class="card w-100" style="max-width: 1230px">
            <div class="card-header mt-2">
                <h5 class="card-title">Experience Create</h5>
            </div>
            <div class="card-body">
                <form @submit.prevent="submitExperienceEdit">
                    <div class="row form-section mb-4">
                        <div class="col-md-12">
                            <label for="symptom" class="form-label mb-0">Experience</label>
                            <input v-model="form.experience" type="text" class="form-control" id="symptom" required />
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
import { useRoute,useRouter } from "vue-router";
import Cookies from "js-cookie";
export default {
    name: "ExperienceEdit",
    setup() {
        const router = useRouter();
        const route=useRoute();
        const experience_id = ref("");
        const access_token = ref("");
        const form = ref({
            id: "",
            experience: "",
        });

        const submitExperienceEdit = async () => {
            try {
                const response = await axios.post("/api/auth/experience/experienceedit", form.value,
                    {
                        headers: {
                            Authorization: `Bearer ${access_token.value}`,
                        },
                    }
                );
                if (response.data && response.status === 200) {
                    router.push({name:"Experience"})
                    Swal.fire({
                        title: response.data.message,
                        icon: "success",
                        draggable: true,
                    });
                    form.value.specialist = response.data.experience.experience;
                }
            } catch (error) {
                console.log(error)
            }
        };

        const experienceEditView = async () => {
            try {
                const response = await axios.get(`/api/auth/experience/experiencedata/${experience_id.value}`,
                    {
                        headers: {
                            Authorization: `Bearer ${access_token.value}`,
                        },
                    }
                );
                if (response.data && response.status === 200) {
                    form.value.experience = response.data.experience;
                    form.value.id = response.data.id;
                }
            } catch (error) {
                console.log(error.response);
            }
        };

        onMounted(() => {
            access_token.value = Cookies.get("access_token");
            experience_id.value = route.params.id;
            experienceEditView();
        });
        return {
            form,
            submitExperienceEdit
        }
    }
}
</script>

<style></style>
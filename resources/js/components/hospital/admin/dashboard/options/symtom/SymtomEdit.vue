<template>
    <router-link to="/symtom" class="btn btn-primary w-100 mb-2">
        <i class="fa-solid fa-list"></i> Symtom List</router-link>
    <div class="d-flex justify-content-center align-items-center">
        <div class="card w-100" style="max-width: 1230px">
            <div class="card-header mt-2">
                <h5 class="card-title">Symptom Create</h5>
            </div>
            <div class="card-body">
                <form @submit.prevent="submitSymptomEdit">
                    <div class="row form-section mb-4">
                        <div class="col-md-12">
                            <label for="symptom" class="form-label mb-0">Symptom</label>
                            <input v-model="form.symptom" type="text" class="form-control" id="symptom" required />
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
import { useRouter,useRoute } from "vue-router";
import Cookies from "js-cookie";
export default {
    name: "SymtomEdit",
    setup() {
        const router = useRouter();
        const route=useRoute();
        const symtom_id = ref("");
        const access_token = ref("");
        const form = ref({
            id: "",
            symptom: "",
        });

        const submitSymptomEdit = async () => {
            try {
                const response = await axios.post(
                    "/api/auth/symtom/symtomedit",
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
                    form.value.symptom = response.data.symtom.symptom;
                    router.push({ name: 'Symtom' })
                }
            } catch (error) {
                console.log(error.response)
            }
        };

        const symtomEditView = async () => {
            try {
                const response = await axios.get(
                    `/api/auth/symtom/symtomeditdata/${symtom_id.value}`,
                    {
                        headers: {
                            Authorization: `Bearer ${access_token.value}`,
                        },
                    }
                );
                if (response.data && response.status === 200) {
                    form.value.symptom = response.data.symptom;
                    form.value.id = response.data.id;
                }
            } catch (error) {
                console.log(error.response);
            }
        };

        onMounted(() => {
            access_token.value = Cookies.get("access_token");
            symtom_id.value = route.params.id;
            symtomEditView();
        });
        return {
            form,
            symtom_id,
            symtomEditView,
            submitSymptomEdit,
        };
    },
};
</script>

<style></style>
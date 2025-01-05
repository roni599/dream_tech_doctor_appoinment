<template>
    <div class="d-flex justify-content-center align-items-center">
        <div class="card w-100" style="max-width: 1230px">
            <div class="card-header mt-2">
                <h5 class="card-title">Symptom Create</h5>
            </div>
            <div class="card-body">
                <form @submit.prevent="submitSymptom">
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
import Cookies from "js-cookie";
export default {
    name: "SymptomCreate",
    setup() {
        const currentComponent = ref(false);
        const access_token = ref('');
        const form = ref({
            symptom: "",
        });

        const submitSymptom = async () => {
            try {
                const response = await axios.post("/api/auth/symptoms/store", form.value, {
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
                    form.value = '';
                }
            } catch (error) { }
        };

        onMounted(() => {
            access_token.value = Cookies.get('access_token');
        })

        return {
            currentComponent,
            form,
            submitSymptom,
        };
    },
};
</script>

<style scoped></style>
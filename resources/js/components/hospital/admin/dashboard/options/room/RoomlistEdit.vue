<template>
    <router-link to="/room" class="btn btn-primary w-100 mb-2">
        <i class="fa-solid fa-list"></i> Room List</router-link>
    <div class="d-flex justify-content-center align-items-center">
        <div class="card w-100" style="max-width: 1230px">
            <div class="card-header mt-2">
                <h5 class="card-title">Room Create</h5>
            </div>
            <div class="card-body">
                <form @submit.prevent="submitRoomlistEdit">
                    <div class="row form-section mb-4">
                        <div class="col-md-12">
                            <label for="symptom" class="form-label mb-0">Room Number</label>
                            <input v-model="form.room_number" type="text" class="form-control" id="room" required />
                        </div>
                    </div>
                    <div class="row form-section mb-4">
                        <div class="col-md-12">
                            <label for="symptom" class="form-label mb-0">Room Status</label>
                            <select v-model="form.room_status" id="roomEdit" class="form-select">
                                <option value="" selected>Choose...</option>
                                <option value="1">Active</option>
                                <option value="0">Deactive</option>
                            </select>
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
    name: "ExperienceEdit",
    setup() {
        const router = useRouter();
        const route=useRoute();
        const room_id = ref("");
        const access_token = ref("");
        const form = ref({
            id: "",
            room_number: "",
            room_status: "",
        });

        const submitRoomlistEdit = async () => {
            try {
                const response = await axios.post("/api/auth/room/roomlistedit", form.value,
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
                    form.value.room_number = response.data.romm_number.romm_number;
                    form.value.room_status = response.data.romm_number.status;
                    router.push({name:"Roomlist"})
                }
            } catch (error) {
                console.log(error)
            }
        };

        const roomlistEditView = async () => {
            try {
                const response = await axios.get(`/api/auth/room/roomlistdata/${room_id.value}`,
                    {
                        headers: {
                            Authorization: `Bearer ${access_token.value}`,
                        },
                    }
                );
                if (response.data && response.status === 200) {
                    form.value.room_number = response.data.room_number;
                    form.value.id = response.data.id;
                    form.value.room_status = response.data.status;
                }
            } catch (error) {
                console.log(error.response);
            }
        };

        onMounted(() => {
            access_token.value = Cookies.get("access_token");
            room_id.value = route.params.id;
            roomlistEditView();
        });
        return {
            form,
            submitRoomlistEdit
        }
    }
}
</script>

<style></style>
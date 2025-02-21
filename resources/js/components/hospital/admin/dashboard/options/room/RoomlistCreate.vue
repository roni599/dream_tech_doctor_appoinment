<template>
    <div class="d-flex justify-content-center align-items-center">
        <div class="card" style="width: 1300px;">
            <div class="card-header mt-2">
                <h5 class="card-title">Room Create</h5>
            </div>
            <div class="card-body">
                <form @submit.prevent="submitRoom">
                    <div class="row form-section mb-4">
                        <div class="col-md-12">
                            <label for="department" class="form-label mb-0">Room Number</label>
                            <input v-model="form.room_number" type="text" class="form-control" id="reg-number">
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
    name: "RoomlistCreate",
    setup() {
        const currentComponent = ref(false);
        const access_token = ref('access_token');
        const form = ref({
            room_number: ''
        })
        const submitRoom = async () => {
            try {
                const response = await axios.post('/api/auth/room/store', form.value, {
                    headers: {
                        'Authorization': `Bearer ${access_token.value}`
                    }
                });
                console.log(response)
                if (response.data && response.status === 201) {
                    Swal.fire({
                        title: response.data.message,
                        icon: "success",
                        draggable: true
                    });
                    form.value.room_number = '';
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
            submitRoom
        }
    }
}
</script>

<style></style>
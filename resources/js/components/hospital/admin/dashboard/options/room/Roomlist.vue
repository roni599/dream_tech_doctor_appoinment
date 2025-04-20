<template>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3 w-100">
            <div class="d-flex w-100 mb-2 mb-sm-0">
                <router-link to="/room-create" class="btn btn-primary ms-2">
                    + Create Room
                </router-link>
            </div>
        </div>
        <div class="allFeature">
            <div class="row mb-1">
                <div class="col-md-12 mb-3">
                    <label for="department" class="form-label mb-0">Room Number</label>
                    <select v-model="search_room" id="department" class="form-select">
                        <option value="" selected disabled>Choose...</option>
                        <option v-for="room in roomlists" :key="room.id" :value="room.room_number">{{ room.room_number }}
                        </option>
                    </select>
                </div>
            </div>
            <div v-if="!roomlists || roomlists.length === 0" class="not">
                <h3 class="fw-bold text-center">No Room Found</h3>
            </div>
            <div v-else>
                <div v-for="room in filteredRooms" :key="room.id" class="list-group">
                    <div class="doctor-card d-flex justify-content-between align-items-center p-3">
                        <span class="fw-bold">{{ room.room_number }} <br>
                            <span v-if="room.status === 1" class="badge bg-success">Available</span>
                            <span v-else class="badge bg-danger">Not Available</span>
                        </span>
                        <div class="d-flex ms-auto">
                            <router-link :to="{ name: 'RoomlistEdit', params: { id: room.id } }"
                                class="btn btn-outline-warning me-2">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </router-link>
                            <button class="btn btn-outline-danger" @click="deleteRoom(room.id)">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { onMounted, ref,computed } from 'vue';
import Cookies from 'js-cookie';
export default {
    name: "Roomlist",
    setup() {
        const access_token = ref('');
        const roomlists = ref([]);
        const search_room = ref('');
        const fetchRoomlist = async () => {
            try {
                const response = await axios.get('/api/auth/roomlist', {
                    headers: {
                        'Authorization': `Bearer ${access_token.value}`
                    }
                });
                if (response.data && response.status === 200) {
                    roomlists.value = response.data;
                }
            } catch (error) {
            }
        }
        const deleteRoom = async (id) => {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        const response = await axios.post('/api/auth/room/roomdelete', { id }, {
                            headers: {
                                'Authorization': `Bearer ${access_token.value}`
                            }
                        })
                        if (response.data && response.status === 200) {
                            fetchRoomlist();
                            Swal.fire({
                                title: response.data.message,
                                icon: "success",
                                draggable: true
                            });
                        }
                    } catch (error) {
                        console.error(error.response);
                    }
                }
            });
        }
        const filteredRooms = computed(() => {
            if (!search_room.value) {
                return roomlists.value;
            }
            return roomlists.value.filter(room => room.room_number.includes(search_room.value));
        });
        onMounted(() => {
            access_token.value = Cookies.get('access_token');
            fetchRoomlist()
        })
        return {
            roomlists,
            deleteRoom,
            search_room,
            filteredRooms
        }
    }
}
</script>

<style scoped>
.doctor-card {
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin-bottom: 10px;
    padding: 10px;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
}

.doctor-card {
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin-bottom: 10px;
    padding: 10px;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
}

.doctor-card ul li {
    text-decoration: none;
    list-style: none;
}

@media (max-width: 768px) {
    .doctor-card {
        flex-direction: column;
        align-items: flex-start;
        text-align: left;
    }

    .doctor-avatar {
        margin-bottom: 10px;
    }

    .d-flex.align-items-center {
        flex-direction: row;
        flex-wrap: wrap;
        width: 100%;
        gap: 5px;
    }
}
</style>
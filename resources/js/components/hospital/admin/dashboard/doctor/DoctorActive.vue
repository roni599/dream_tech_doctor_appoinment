<template>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3 w-100">
            <div class="d-flex w-100 mb-2 mb-sm-0">
                <router-link to="/doctor" class="btn btn-primary ms-2">
                    + Doctor List
                </router-link>
                <router-link to="/doctor-create" class="btn btn-primary ms-2">
                    + Create Doctor
                </router-link>
            </div>
            <div class="d-flex w-100 justify-content-end">
                <router-link to="/doctor-inactive" class="btn btn-success me-2">
                    Inactive Doctor
                </router-link>
            </div>
        </div>
        <div v-if="doctors.length > 0">
            <div v-for="doctor in doctors" :key="doctor.id" class="list-group">
                <div class="doctor-card d-flex align-items-center">
                    <div class="doctor-avatar me-3">
                        <img :src="doctor.doctor_image" alt="" width="60px" height="60px" />
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="mb-1">{{ doctor.doctorName }}</h5>
                        <p class="mb-0 text-muted">{{ doctor.deparment_category }}</p>
                    </div>
                    <div class="d-flex align-items-center">
                        <router-link :to="{ name: 'DoctorView', params: { id: doctor.id } }"
                            class="btn btn-outline-primary me-2">
                            <i class="fa-solid fa-eye"></i>
                        </router-link>
                        <router-link :to="{ name: 'DoctorEdit', params: { id: doctor.id } }"
                            class="btn btn-outline-warning me-2">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </router-link>
                        <button class="btn btn-outline-warning me-2 copy-button" @click="generateAndCopyLink(doctor.id)"
                            @mouseenter="onHover($event, doctor.id)" @mouseleave="hoveredButton = null">
                            <i class="fa-solid fa-copy"></i>
                        </button>
                        <div v-if="hoveredButton === doctor.id" :style="tooltipStyle" class="custom-tooltip below">
                            {{ copymessage }}
                        </div>
                        <button class="btn btn-outline-danger me-2" @click="deleteDoctor(doctor.id)">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                        <div class="dropdown">
                            <select class="form-select border border-success text-success custom-select"
                                aria-label="Status select" v-model="doctor.status"
                                @change="updateStatus(doctor.id, doctor.status)">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-else class="alert alert-info text-center">
            All doctors are inactive.So Go doctor list and active doctor
        </div>
    </div>

</template>

<script>
import { onMounted, ref } from 'vue';
import Cookies from 'js-cookie';
export default {
    name: 'DoctorActive',
    setup() {
        const access_token = ref('');
        const currentComponent = ref(false);
        const doctors = ref([]);

        const hoveredButton = ref(null);
        const tooltipStyle = ref({});
        const copymessage = ref('Copy link address')

        const fetchDoctor = async () => {
            const response = await axios.get("/api/auth/hospital-doctor/active-doctor", {
                headers: {
                    'Authorization': `Bearer ${access_token.value}`,
                },
            });

            if (response.data && response.status === 200) {
                doctors.value = response.data;
            }
        };

        const onHover = (event, id) => {
            copymessage.value = 'Copy link address';
            hoveredButton.value = id;
            const buttonRect = event.target.getBoundingClientRect();
            const viewportWidth = window.innerWidth;
            let leftOffset = buttonRect.left + buttonRect.width / 2 - 280;
            const additionalOffset = 20;
            leftOffset += additionalOffset;
            if (viewportWidth <= 768) {
                copymessage.value = 'Copy link address';
                leftOffset = buttonRect.left + buttonRect.width / 2 - 30 + additionalOffset;
            }

            tooltipStyle.value = {
                position: "absolute",
                top: `${buttonRect.bottom + window.scrollY - 85}px`,
                left: `${leftOffset}px`,
                transform: "translateX(-90%)",
            };
        };

        const generateAndCopyLink = async (id) => {
            const currentHost = window.location.origin;
            const generatedLink = `${currentHost}/doctorview/${id}`;
            try {
                await navigator.clipboard.writeText(generatedLink);
                copymessage.value = 'copied';
                setTimeout(() => {
                    copymessage.value = '';
                    tooltipStyle.value = { display: 'none' };
                }, 5000);
            } catch (error) {
                console.error("Failed to copy:", error);
            }
        };

        const deleteDoctor = async (doctorId) => {
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
                        const response = await axios.post(
                            '/api/auth/hospital-doctor/delete-doctor',
                            { doctorId },
                            {
                                headers: {
                                    'Authorization': `Bearer ${access_token.value}`,
                                },
                            }
                        );

                        if (response.data && response.data.message && response.status === 200) {
                            fetchDoctor();
                            Swal.fire({
                                title: response.data.message,
                                icon: "success",
                                draggable: true
                            });
                        }
                    } catch (error) {
                        console.error("Error updating status:", error);
                    }
                }
            });
        }

        const updateStatus = async (doctorId, status) => {
            try {
                const response = await axios.post(
                    "/api/auth/hospital-doctor/change-status",
                    {
                        doctorId,
                        status: status === "0" ? 0 : 1,
                    },
                    {
                        headers: {
                            'Authorization': `Bearer ${access_token.value}`,
                        },
                    }
                );

                if (response.data && response.data.message && response.status === 201) {
                    fetchDoctor();
                    Swal.fire({
                        title: response.data.message,
                        icon: "success",
                        draggable: true
                    });
                }
            } catch (error) {
                console.error("Error updating status:", error);
            }
        };

        onMounted(async () => {
            access_token.value = Cookies.get('access_token');
            await fetchDoctor();
        });
        return {
            currentComponent,
            doctors,
            fetchDoctor,
            deleteDoctor,
            updateStatus,
            tooltipStyle,
            onHover,
            generateAndCopyLink,
            hoveredButton,
            copymessage,
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

.doctor-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background-color: #e0e0e0;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 24px;
    color: #6c757d;
    overflow: hidden;
}

.doctor-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}

.status-dropdown {
    min-width: 120px;
}

.custom-select {
    font-size: 14px;
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

    .d-flex.align-items-center button,
    .d-flex.align-items-center .dropdown {
        flex: 1 0 auto;
        margin-bottom: 0;
    }
}

.copy-button {
    cursor: pointer;
}


.custom-tooltip {
    background-color: #000;
    color: #fff;
    padding: 5px 10px;
    border-radius: 4px;
    font-size: 0.875rem;
    white-space: nowrap;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
    z-index: 1000;
    opacity: 0.9;
    transform: translateX(-60%);
}

@media (max-width: 768px) {
    .custom-tooltip {
        font-size: 0.75rem;
        padding: 4px 8px;
    }
}
</style>
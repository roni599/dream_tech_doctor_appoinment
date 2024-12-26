<template>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3 w-100">
            <div class="d-flex w-100 mb-2 mb-sm-0">
                <button @click="anotherLoad" class="btn btn-primary">
                    <i class="fa-solid fa-list"></i><span class="ms-2">Doctor List</span>
                </button>
                <button @click="componentLoad('DoctorCreate')" class="btn btn-primary ms-2">+ Create Doctor</button>
            </div>
            <div class="d-flex w-100 justify-content-end">
                <button @click="componentLoad('DoctorActive')" class="btn btn-success me-2">Active</button>
                <button @click="componentLoad('DoctorInactive')" class="btn btn-secondary">Inactive</button>
            </div>
        </div>
        <div v-show="!currentComponent" class="allFeature">
            <div class="row mb-3">
                <div class="col-md-6 mb-3">
                    <label for="department" class="form-label">Department/Category</label>
                    <select id="department" class="form-select">
                        <option value="" selected>Choose...</option>
                        <option value="1">Cardiology</option>
                        <option value="2">Neurology</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="doctor" class="form-label">Doctor</label>
                    <select id="doctor" class="form-select">
                        <option value="" selected>Choose...</option>
                        <option value="1">Dr. Jasim</option>
                        <option value="2">Dr. Rahman</option>
                    </select>
                </div>
            </div>
            <div class="list-group">
                <div class="doctor-card d-flex align-items-center">
                    <div class="doctor-avatar me-3">
                        <img src="https://png.pngtree.com/png-vector/20230928/ourmid/pngtree-young-afro-professional-doctor-png-image_10148632.png"
                            alt="" width="60px" height="60px">
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="mb-1">Dr Md. Jasim Uddin Nizami</h5>
                        <p class="mb-0 text-muted">Cardiologist</p>
                    </div>
                    <div class="d-flex align-items-center">
                        <button class="btn btn-outline-primary me-2">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                        <button class="btn btn-outline-warning me-2">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <button class="btn btn-outline-danger me-2">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                        <div class="dropdown">
                            <button class="btn btn-outline-success dropdown-toggle status-dropdown" type="button"
                                id="statusDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Active
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="statusDropdown">
                                <li><a class="dropdown-item" href="#">Active</a></li>
                                <li><a class="dropdown-item" href="#">Inactive</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="list-group">
                <div class="doctor-card d-flex align-items-center">
                    <div class="doctor-avatar me-3">
                        <img src="https://png.pngtree.com/png-vector/20230928/ourmid/pngtree-young-afro-professional-doctor-png-image_10148632.png"
                            alt="" width="60px" height="60px">
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="mb-1">Dr Md. Jasim Uddin Nizami</h5>
                        <p class="mb-0 text-muted">Cardiologist</p>
                    </div>
                    <div class="d-flex align-items-center">
                        <button class="btn btn-outline-primary me-2">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                        <button class="btn btn-outline-warning me-2">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <button class="btn btn-outline-danger me-2">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                        <div class="dropdown">
                            <button class="btn btn-outline-success dropdown-toggle status-dropdown" type="button"
                                id="statusDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Active
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="statusDropdown">
                                <li><a class="dropdown-item" href="#">Active</a></li>
                                <li><a class="dropdown-item" href="#">Inactive</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="list-group">
                <div class="doctor-card d-flex align-items-center">
                    <div class="doctor-avatar me-3">
                        <img src="https://png.pngtree.com/png-vector/20230928/ourmid/pngtree-young-afro-professional-doctor-png-image_10148632.png"
                            alt="" width="60px" height="60px">
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="mb-1">Dr Md. Jasim Uddin Nizami</h5>
                        <p class="mb-0 text-muted">Cardiologist</p>
                    </div>
                    <div class="d-flex align-items-center">
                        <button class="btn btn-outline-primary me-2">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                        <button class="btn btn-outline-warning me-2">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <button class="btn btn-outline-danger me-2">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                        <div class="dropdown">
                            <button class="btn btn-outline-success dropdown-toggle status-dropdown" type="button"
                                id="statusDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Active
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="statusDropdown">
                                <li><a class="dropdown-item" href="#">Active</a></li>
                                <li><a class="dropdown-item" href="#">Inactive</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="list-group">
                <div class="doctor-card d-flex align-items-center">
                    <div class="doctor-avatar me-3">
                        <img src="https://png.pngtree.com/png-vector/20230928/ourmid/pngtree-young-afro-professional-doctor-png-image_10148632.png"
                            alt="" width="60px" height="60px">
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="mb-1">Dr Md. Jasim Uddin Nizami</h5>
                        <p class="mb-0 text-muted">Cardiologist</p>
                    </div>
                    <div class="d-flex align-items-center">
                        <button class="btn btn-outline-primary me-2">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                        <button class="btn btn-outline-warning me-2">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <button class="btn btn-outline-danger me-2">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                        <div class="dropdown">
                            <button class="btn btn-outline-success dropdown-toggle status-dropdown" type="button"
                                id="statusDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Active
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="statusDropdown">
                                <li><a class="dropdown-item" href="#">Active</a></li>
                                <li><a class="dropdown-item" href="#">Inactive</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <component :is="currentComponent"></component>
</template>

<script>
import { ref, reactive, shallowRef, markRaw } from 'vue';
import DoctorCreate from './DoctorCreate.vue';
import DoctorActive from './DoctorActive.vue';
import DoctorInactive from './DoctorInactive.vue';

export default {
    name: "Doctor-vue",
    setup() {
        const currentComponent = shallowRef(null);
        const componentLoad = (componentvalue) => {
            if (componentvalue === 'DoctorCreate') {
                currentComponent.value = markRaw(DoctorCreate)
            }
            else if (componentvalue === 'DoctorActive') {
                currentComponent.value = markRaw(DoctorActive)
            }
            else if (componentvalue === 'DoctorInactive') {
                currentComponent.value = markRaw(DoctorInactive)
            }
        }
        const anotherLoad = () => {
            currentComponent.value = null
        }
        return {
            currentComponent,
            componentLoad,
            anotherLoad
        }
    }
}
</script>

<style scoped>
/* .doctor-card {
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin-bottom: 10px;
    padding: 10px;
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
} */

.doctor-card {
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin-bottom: 10px;
    padding: 10px;
    display: flex;
    flex-wrap: wrap;
    /* Wrap elements for smaller screens */
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
    /* Wrap elements for smaller screens */
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

@media (max-width: 768px) {

    /* For tablets and smaller screens */
    .doctor-card {
        flex-direction: column;
        /* Stack elements vertically */
        align-items: flex-start;
        /* Align items to the start */
        text-align: left;
    }

    .doctor-avatar {
        margin-bottom: 10px;
        /* Add spacing below avatar */
    }

    .d-flex.align-items-center {
        flex-direction: row;
        /* Align buttons in a single row */
        flex-wrap: wrap;
        /* Allow wrapping for small buttons if needed */
        width: 100%;
        gap: 5px;
        /* Add spacing between buttons */
    }

    .d-flex.align-items-center button,
    .d-flex.align-items-center .dropdown {
        flex: 1 0 auto;
        /* Ensure buttons stay in a row */
        margin-bottom: 0;
        /* Remove vertical margin */
    }
}
</style>
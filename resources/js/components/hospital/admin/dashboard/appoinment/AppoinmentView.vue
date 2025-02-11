<template>
    <div class="container">
        <div
            class="header-buttons d-flex flex-wrap justify-content-start justify-content-center justify-content-md-start mb-2">
            <button @click="anotherLoad" class="btn btn-primary mb-2">Appoint View</button>
            <button @click="componentLoad('AppoinmentCreate')" class="btn btn-info text-white mb-2">New Appoint</button>
        </div>
        <div v-show="!currentComponent" class="card">
            <div class="card-body">
                <div
                    class="filters d-flex flex-column flex-sm-row justify-content-center gap-3 align-items-center mb-4 my-3">
                    <div class="filter-item">
                        <label for="patientMobile" class="form-label mb-0">Department/Category</label>
                        <select class="form-select" aria-label="Department/Category">
                            <option selected>Department/Category</option>
                            <option value="1">Cardiology</option>
                            <option value="2">Neurology</option>
                            <option value="3">Orthopedics</option>
                        </select>
                    </div>
                    <div class="filter-item">
                        <label for="patientMobile" class="form-label mb-0">Doctor</label>
                        <select class="form-select" aria-label="Doctor">
                            <option selected>Doctor</option>
                            <option value="1">Dr. Smith</option>
                            <option value="2">Dr. Brown</option>
                            <option value="3">Dr. Taylor</option>
                        </select>
                    </div>
                    <div class="filter-item">
                        <label for="patientMobile" class="form-label mb-0">Visit date</label>
                        <input type="date" class="form-control"/>
                    </div>
                    <div class="filter-item">
                        <label for="patientMobile" class="form-label mb-0">Appointment</label>
                        <div class="appoint-number">102</div>
                    </div>
                </div>
                <!-- <div class="mb-3">
                    <h5 class="text-start">12/08/2028</h5>
                </div> -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="height: 30px;">Category/Department</th>
                                <th style="height: 30px;">Doctor Name</th>
                                <th style="height: 30px;">Patient Name</th>
                                <th style="height: 30px;">Visit Date</th>
                                <th style="height: 30px;">S.L No</th>
                                <th style="height: 30px;">Appoint</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Cardiology</td>
                                <td>Dr. Smith</td>
                                <td>John Doe</td>
                                <td>2028-12-08</td>
                                <td>1</td>
                                <td>Online</td>
                            </tr>
                            <tr>
                                <td>Neurology</td>
                                <td>Dr. Brown</td>
                                <td>Jane Doe</td>
                                <td>2028-12-09</td>
                                <td>2</td>
                                <td>jasim</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <component :is="currentComponent"></component>
</template>

<script>
import { markRaw, onMounted, ref, shallowRef } from 'vue';
import AppoinmentCreate from './AppoinmentCreate.vue';
export default {
    name: "AppoinmentView",
    setup() {
        const currentComponent = shallowRef(null);
        const componentLoad = (componentvalue) => {
            if (componentvalue === "AppoinmentCreate") {
                currentComponent.value = markRaw(AppoinmentCreate);
            }
        };
        const anotherLoad = () => {
            currentComponent.value = null;
        };
        return {
            currentComponent,
            anotherLoad,
            componentLoad
        }
    }
}
</script>

<style scoped>
.header-buttons .btn {
    margin-right: 10px;
}

.filters {
    margin-bottom: 20px;
}

.filters select {
    max-width: 200px;
}

.appoint-number {
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    font-weight: bold;
    color: white;
    background-color: #0056b3;
    border-radius: 8px;
    width: 80px;
    height: 40px;
}

.table th {
    background-color: #007bff;
    color: white;
}

.table td {
    text-align: center;
}

@media (max-width: 768px) {
    .filters {
        flex-direction: column;
    }

    .header-buttons {
        flex-direction: row;
        align-items: center;
    }

    .filters .filter-item {
        width: 100%;
        margin-bottom: 5px;
    }

    .appoint-number {
        width: auto;
        font-size: 18px;
    }

    .table-responsive {
        margin-top: 15px;
    }
}
</style>
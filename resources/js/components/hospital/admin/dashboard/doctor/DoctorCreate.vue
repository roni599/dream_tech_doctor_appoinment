<template>
    <!-- <div class="mt-4">
        <form>
            <div class="row form-section mb-2">
                <div class="col-md-12">
                    <label for="department" class="form-label mb-0">Department/Category</label>
                    <select class="form-select" id="department">
                        <option value="" disabled selected>Select Department</option>
                    </select>
                </div>
            </div>
            <div class="row form-section mb-2">
                <div class="col-md-12">
                    <label for="department" class="form-label mb-0">Department/Category</label>
                    <input type="text" class="form-control" id="reg-number">
                </div>
            </div>
            <div class="row form-section mb-2">
                <div class="col-md-12">
                    <label for="department" class="form-label mb-0">Doctor Name</label>
                    <input type="text" class="form-control" id="reg-number">
                </div>
            </div>

            <div class="row form-section mb-2">
                <div class="col-md-4">
                    <label for="gender" class="form-label mb-0">Gender</label>
                    <input type="text" class="form-control" id="gender">
                </div>
                <div class="col-md-4">
                    <label for="age" class="form-label mb-0">Age</label>
                    <input type="number" class="form-control" id="age">
                </div>
                <div class="col-md-4">
                    <label for="experience" class="form-label mb-0">Experience</label>
                    <input type="text" class="form-control" id="experience">
                </div>
            </div>
            <div class="row form-section mb-2">
                <div class="col-md-12">
                    <label for="details" class="form-label mb-0">Details</label>
                    <textarea class="form-control" id="details" rows="2"></textarea>
                </div>
            </div>
            <div class="row form-section mb-2">
                <div class="col-md-12">
                    <label for="specialist" class="form-label mb-0">Specialist</label>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
            </div>
            <div class="row form-section mb-2">
                <div class="col-md-12">
                    <label for="specialist" class="form-label mb-0">Symptom</label>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
            </div>
            <div class="row form-section mb-2">
                <div class="col-md-12">
                    <label for="email" class="form-label mb-0">E-Mail</label>
                    <input type="email" class="form-control" id="email">
                </div>
            </div>
            <div class="row form-section mb-2">
                <div class="col-md-6">
                    <label for="mobile" class="form-label mb-0">Mobile</label>
                    <input type="text" class="form-control" id="mobile">
                </div>
                <div class="col-md-6">
                    <label for="mobile" class="form-label mb-0">Mobile</label>
                    <input type="text" class="form-control" id="mobile">
                </div>
            </div>
            <div class="row form-section mb-2">
                <div class="col-md-12">
                    <label for="mobile" class="form-label mb-0">Shedule</label>
                    <table class="table table-bordered border-black table-hover table-striped">
                        <thead>
                            <tr class=" border-black">
                                <th class="border-black" scope="col">Days</th>
                                <th class="border-black" scope="col">Start</th>
                                <th class="border-black" scope="col">End</th>
                                <th class="border-black" scope="col">Visit Limit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-black">
                                <th class="border-black" scope="row">1</th>
                                <td class="border-black">Mark</td>
                                <td class="border-black">Otto</td>
                                <td class="border-black">@mdo</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row form-section mb-2">
                <div class="col-md-12">
                    <label for="mobile" class="form-label mb-0">Payment Detals</label>
                    <table class="table table-bordered border-black table-hover table-striped">
                        <thead>
                            <tr class=" border-black">
                                <th class="border-black" scope="col">Days</th>
                                <th class="border-black" scope="col">Start</th>
                                <th class="border-black" scope="col">End</th>
                                <th class="border-black" scope="col">Visit Limit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-black">
                                <th class="border-black" scope="row">1</th>
                                <td class="border-black">Mark</td>
                                <td class="border-black">Otto</td>
                                <td class="border-black">@mdo</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row form-section mb-2">
                <label for="mobile" class="form-label mb-0"> For Appoint Mobile</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="mobile">
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="mobile">
                </div>
            </div>
            <div class="row form-section">
                <div class="col-md-6">
                    <label>Picture</label>
                    <div class="picture-box rounded-circle bg-light"></div>
                </div>
                <div class="col-md-6">
                    <label>Signature</label>
                    <div class="signature-box bg-light"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 d-flex justify-content-between">
                    <button type="button" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-success">Save & View</button>
                </div>
            </div>
        </form>
    </div> -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Doctor Create</h5>
        </div>
        <div class="card-body">
            <form>
                <div class="row form-section mb-2">
                    <div class="col-md-12">
                        <label for="department" class="form-label mb-0">Department/Category</label>
                        <select class="form-select" id="department">
                            <option value="" disabled selected>Select Department</option>
                        </select>
                    </div>
                </div>

                <div class="row form-section mb-2">
                    <div class="col-md-12">
                        <label for="department" class="form-label mb-0">Reg Number</label>
                        <input type="text" class="form-control" id="reg-number">
                    </div>
                </div>

                <div class="row form-section mb-2">
                    <div class="col-md-12">
                        <label for="department" class="form-label mb-0">Doctor Name</label>
                        <input type="text" class="form-control" id="reg-number">
                    </div>
                </div>
                <div class="row form-section mb-2">
                    <div class="col-md-12">
                        <label for="email" class="form-label mb-0">E-Mail</label>
                        <input type="email" class="form-control" id="email">
                    </div>
                </div>

                <div class="row form-section mb-2">
                    <div class="col-md-4">
                        <label for="age" class="form-label mb-0">Age</label>
                        <input type="number" class="form-control" id="age">
                    </div>
                    <div class="col-md-4">
                        <label for="gender" class="form-label mb-0">Gender</label>
                        <select class="form-select form-control" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="experience" class="form-label mb-0">Experience</label>
                        <input type="text" class="form-control" id="experience">
                    </div>
                </div>

                <div class="row form-section mb-2">
                    <div class="col-md-12">
                        <label for="details" class="form-label mb-0">Details</label>
                        <textarea class="form-control" id="details" rows="2"></textarea>
                    </div>

                </div>
                <div class="row form-section mb-2">
                    <div class="col-md-12">
                        <label for="specialist" class="form-label mb-0">Specialist</label>
                        <div v-for="(item, index) in selects" :key="index" class="d-flex align-items-center mt-2">
                            <select class="form-select flex-grow-1 me-2" v-model="item.value"
                                aria-label="Default select example">
                                <option selected disabled value="">Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                            <div class="d-flex">
                                <button type="button" class="btn btn-success me-1" v-if="index === selects.length - 1"
                                    @click="addSelect">+
                                </button>
                                <button type="button" class="btn btn-danger" v-if="selects.length > 1"
                                    @click="removeSelect(index)"> -
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row form-section mb-2">
                    <div class="col-md-12">
                        <label for="symptom" class="form-label mb-0">Symptom</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>
                <div class="row form-section mb-2">
                    <div class="col-md-6">
                        <label for="mobile" class="form-label mb-0">Mobile</label>
                        <input type="text" class="form-control" id="mobile">
                    </div>
                    <div class="col-md-6">
                        <label for="mobile" class="form-label mb-0">Optional Mobile</label>
                        <input type="text" class="form-control" id="mobile">
                    </div>
                </div>
                <div class="row form-section mb-2">
                    <div class="col-md-12">
                        <label for="mobile" class="form-label mb-0">Shedule</label>
                        <table class="table table-bordered border-black table-hover table-striped">
                            <thead>
                                <tr class=" border-black">
                                    <th class="border-black" scope="col">Days</th>
                                    <th class="border-black" scope="col">Start</th>
                                    <th class="border-black" scope="col">End</th>
                                    <th class="border-black" scope="col">Visit Limit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-black">
                                    <th class="border-black" scope="row" style="width: 222px;">
                                        <select class="form-select form-control" aria-label="Default select example">
                                            <option selected>SatarDay</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </th>
                                    <td class="border-black">Mark</td>
                                    <td class="border-black">Otto</td>
                                    <td class="border-black">@mdo</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row form-section mb-2">
                    <div class="col-md-12">
                        <label for="mobile" class="form-label mb-0">Payment Detals</label>
                        <table class="table table-bordered border-black">
                            <thead class="border-black">
                                <tr class="border-black">
                                    <th class="border-black">Visit Fee</th>
                                    <th class="border-black">2nd Time</th>
                                    <th class="border-black">3rd Time</th>
                                    <th class="border-black">Payment Type</th>
                                    <th class="border-black">Room Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-black">
                                    <td class="border-black"><input type="text" class="input-cell" value="600"></td>
                                    <td class="border-black">
                                        <div class="d-flex">
                                            <input type="text" class="input-cell me-2" placeholder="Day">
                                            <input type="text" class="input-cell" placeholder="Fee">
                                        </div>
                                    </td>
                                    <td class="border-black">
                                        <div class="d-flex">
                                            <input type="text" class="input-cell me-2" placeholder="Day">
                                            <input type="text" class="input-cell" placeholder="Fee">
                                        </div>
                                    </td>
                                    <td class="border-black">
                                        <select class="form-select input-cell">
                                            <option value="" disabled selected>Select</option>
                                            <option value="online">Online</option>
                                            <option value="offline">Offline</option>
                                            <option value="both">Offline/Online</option>
                                        </select>
                                    </td>
                                    <td class="border-black">
                                        <div class="d-flex">
                                            <input type="text" class="input-cell me-2" placeholder="Rom number">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row form-section mb-2">
                    <label for="mobile" class="form-label mb-0"> For Appoint Mobile</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="mobile">
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="mobile">
                    </div>
                </div>
                <div class="row form-section mb-3">
                    <div class="col-md-5 mb-2">
                        <label for="inputFile">Doctor Picture</label>
                        <div class="form-floating mb-3 mb-md-0">
                            <input class="form-control p-3 px-4" type="file" @change="onFileSelect" />
                        </div>
                    </div>
                    <div class="col-md-1 mt-4">
                        <div class="form-floating mb-3 mb-md-0">
                            <img width="55" height="55" />
                        </div>
                    </div>
                    <div class="col-md-5 mb-2">
                        <label for="inputFile">Signature </label>
                        <div class="form-floating mb-3 mb-md-0">
                            <input class="form-control p-3 px-4" type="file" @change="onFileSelect" />
                        </div>
                    </div>
                    <div class="col-md-1 mt-4">
                        <div class="form-floating mb-3 mb-md-0">
                            <img width="55" height="55" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-between">
                        <button type="button" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-success">Save & View</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</template>

<script>
import { onMounted, ref } from 'vue';
export default {
    name: "DoctorCreate",
    setup() {
        const currentComponent = ref(false);
        const selects = ref([
            { value: "" },
        ]);
        const addSelect = () => {
            selects.value.push({ value: "" });
        };
        const removeSelect = (index) => {
            selects.value.splice(index, 1);
        };

        return {
            currentComponent,
            selects,
            addSelect,
            removeSelect,
        }
    }
}
</script>

<style scoped>
.picture-box,
.signature-box {
    border: 1px solid #ddd;
    height: 100px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.signature-box {
    height: 80px;
}

.table-custom th,
.table-custom td {
    text-align: center;
    vertical-align: middle;
}

.input-cell {
    width: 100%;
}
</style>
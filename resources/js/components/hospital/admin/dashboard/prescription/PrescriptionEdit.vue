<template>
    <div class="container-fluid" style="margin-top: -100px">
        <div class="maindiv" v-show="!currentComponent">
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid content-wrapper">
                        <div class="row flex-grow-1">
                            <nav class="col-md-2 sidebar d-none d-md-block">
                                <h6 class="p-2 rounded text-center text-white">
                                    Pathology List
                                </h6>
                                <select class="form-select mb-3" aria-label="Pathology List"
                                    v-model="selectedCategoryId">
                                    <option selected disabled value="">Select Category</option>
                                    <option v-for="pathology in pathologies" :key="pathology.id" :value="pathology.id">
                                        {{ pathology.name }}
                                    </option>
                                </select>
                                <select class="form-select mb-3" aria-label="Pathology List"
                                    @change="addPathology($event)">
                                    <option selected disabled>Select Pathology</option>
                                    <option v-for="pathology in filteredPathologies" :key="pathology.id"
                                        :value="pathology.name">
                                        {{ pathology.name }}
                                    </option>
                                </select>
                            </nav>

                            <main class="col-md-10 pt-2 d-flex flex-column content">
                                <div
                                    class="doctor_details_hospital d-flex flex-column-reverse flex-md-row justify-content-between align-items-center w-100 p-1 mb-md-2">
                                    <div class="doctorName_details w-100 w-md-50 mb-2 mb-md-0">
                                        <h6 class="mb-2">{{ prescriptionEditData.doctor?.doctorName }}</h6>
                                        <div class="doctor_details mb-2">
                                            <p v-for="line in splitExperience(prescriptionEditData.doctor?.details)"
                                                :key="line.id" class="mb-0 line-tight">
                                                {{ line }}
                                            </p>
                                            <p class="mb-0 line-tight">
                                                <strong>Specialist: </strong> <br />
                                                <span
                                                    v-for="(specialist, index) in prescriptionEditData.doctor?.Specialist"
                                                    :key="index">
                                                    {{ specialist
                                                    }}<span
                                                        v-if="index !== prescriptionEditData.doctor?.Specialist.length - 1">,
                                                    </span>
                                                </span>
                                            </p>
                                            <p class="fw-bold mb-0 line-tight">Proposer</p>
                                            <p class="mb-0 line-tight">Department of Child Surgery</p>
                                            <p class="mb-1 line-tight">
                                                Sohid Sorowerdy Medical Collge
                                            </p>
                                            <p class="fw-bold mb-0 line-tight">Reg No:</p>
                                            <p class="mb-1 line-tight">{{ prescriptionEditData.doctor?.regnum }}</p>
                                            <p class="fw-bold mb-0 line-tight">Contact:</p>
                                            <p class="mb-0 line-tight">{{ prescriptionEditData.doctor?.mobile }}</p>
                                        </div>
                                    </div>
                                    <div class="hospital_address_logo w-100 w-md-50 mb-3">
                                        <div class="address_logo d-flex justify-content-start align-items-center">
                                            <div class="hospital_logo">
                                                <img v-if="prescriptionEditData.doctor?.user"
                                                    :src="`/hospital/backend/img/users/logo/${prescriptionEditData.doctor?.user?.logo}`"
                                                    alt="User Logo" width="80" height="auto" />
                                            </div>
                                            <div class="ihospital_address line-tight">
                                                <h3 class="mb-0">{{ prescriptionEditData.doctor?.user?.hospital_name }}
                                                </h3>
                                                <p class="mb-1 line-tight">
                                                    {{ prescriptionEditData.doctor?.user?.location_details }}
                                                </p>
                                                <p class="mb-0 line-tight">
                                                    {{ prescriptionEditData.doctor?.user?.mobile_number_1 }},
                                                    {{ prescriptionEditData.doctor?.user?.mobile_number_2 }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-md-none mt-md-3">
                                    <select class="form-select mb-3" aria-label="Pathology List"
                                        v-model="selectedCategoryId">
                                        <option selected disabled value="">Select Category</option>
                                        <option v-for="pathology in pathologies" :key="pathology.id"
                                            :value="pathology.id">
                                            {{ pathology.name }}
                                        </option>
                                    </select>
                                </div>

                                <div class="d-md-none mt-md-3">
                                    <select class="form-select mb-3" aria-label="Pathology List"
                                        @change="addPathology($event)">
                                        <option selected disabled>Select Pathology</option>
                                        <option v-for="pathology in filteredPathologies" :key="pathology.id"
                                            :value="pathology.name">
                                            {{ pathology.name }}
                                        </option>
                                    </select>
                                </div>

                                <div class="patient_details mb-0">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th class="custom-height">Name</th>
                                                    <td class="custom-height">{{
                                                        prescriptionEditData.appointment?.patient_name }}</td>
                                                    <th class="custom-height">Gender</th>
                                                    <td class="custom-height">{{
                                                        prescriptionEditData.appointment?.gender }}</td>
                                                    <th class="custom-height">Age</th>
                                                    <td class="custom-height">{{ prescriptionEditData.appointment?.age
                                                    }}</td>
                                                    <th class="custom-height">Date</th>
                                                    <td class="custom-height">{{
                                                        prescriptionEditData.appointment?.visit_date }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="prescription d-flex flex-column h-100">
                                    <div class="prescription_details w-100 d-flex flex-column flex-md-row flex-grow-1">
                                        <div class="pathology_test pt-2 w-lg-25 w-md-100"
                                            style="background-color: #eae7f1; height: 63vh">
                                            <p class="text-center mb-0">Blood Pressure</p>
                                            <div
                                                class="input_group d-flex flex-md-column flex-md-row align-items-center px-5 gap-1 mb-2">
                                                <div class="d-flex flex-column align-items-center w-100 w-md-50">
                                                    <label for="up" class="mb-0">Up</label>
                                                    <input type="text" v-model="form.blood_pressure_up" name="up"
                                                        id="up" class="text-center w-100" />
                                                </div>
                                                <div class="d-flex flex-column align-items-center w-100 w-md-50">
                                                    <label for="down" class="mb-0">Down</label>
                                                    <input v-model="form.blood_pressure_down" type="text" name="down"
                                                        id="down" class="text-center w-100" />
                                                </div>
                                            </div>
                                            <div class="pathology_list container mt-1">
                                                <p class="mb-0 text-center text-decoration-underline">
                                                    Pathology Test
                                                </p>
                                                <ul>
                                                    <li v-for="(pathology, index) in form.pathologyArray" :key="index"
                                                        class="mb-2">
                                                        {{ pathology }}
                                                        <button type="button" class="btn btn-sm btn-outline-danger ms-2"
                                                            @click="form.pathologyArray.splice(index, 1)">
                                                            <i class="fa-solid fa-minus"></i>
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="prescription_text pt-2 w-100 w-md-75"
                                            style="background-color: white">
                                            <div class="row mb-3">
                                                <div class="col-md-1 ms-md-5">
                                                    <h3>R<sub>X</sub></h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Medicine Group</label>
                                                    <select class="form-select" v-model="medicine_groupId">
                                                        <option selected disabled value="">Select</option>
                                                        <option v-for="medicine in medicines" :key="medicine.id"
                                                            :value="medicine.id">
                                                            {{ medicine.group_name }}
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Medicine Name</label>
                                                    <select class="form-select" @change="addMedicine($event)">
                                                        <option>Select</option>
                                                        <option v-for="medicine in filteredMedicines" :key="medicine.id"
                                                            :value="`${medicine.dosages_description} : ${medicine.medicine_name}(${medicine.strength})`">
                                                            {{ medicine.medicine_name }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="row mb-3 d-flex ms-md-1 justify-content-center align-items-center w-100"
                                                    v-for="(row, index) in form.medicineArray" :key="index">
                                                    <div class="col-md-3">
                                                        <label>{{ row.medicine_name }}</label>
                                                        <select class="form-select" v-model="row.capsul">
                                                            <option selected disabled value="">Select</option>
                                                            <option value="1+1+1">1+1+1</option>
                                                            <option value="0+1+1">0+1+1</option>
                                                            <option value="1+0+1">1+0+1</option>
                                                            <option value="1+1+0">1+1+0</option>
                                                            <option value="1+0+0">1+0+0</option>
                                                            <option value="0+1+0">0+1+0</option>
                                                            <option value="0+0+1">0+0+1</option>
                                                        </select>
                                                        <div v-if="errors?.[`medicineArray.${index}.capsul`]">
                                                            <div class="text-danger small">
                                                                {{
                                                                    errors[
                                                                        `medicineArray.${index}.capsul`
                                                                    ][0].replace(`medicineArray.${index}.`, "")
                                                                }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <label>Indicate</label>
                                                        <select class="form-select" v-model="row.indicate">
                                                            <option selected disabled value="">Select</option>
                                                            <option value="চলবে">...চলবে</option>
                                                            <option value="৫ দিন">...৫ দিন</option>
                                                            <option value="১০ দিন">...১০ দিন</option>
                                                            <option value="১৫ দিন">...১৫ দিন</option>
                                                            <option value="১ মাস">...১ মাস</option>
                                                            <option value="২ মাস">...২ মাস</option>
                                                        </select>
                                                        <div v-if="errors?.[`medicineArray.${index}.indicate`]">
                                                            <div class="text-danger small">
                                                                {{
                                                                    errors[
                                                                        `medicineArray.${index}.indicate`
                                                                    ][0].replace(`medicineArray.${index}.`, "")
                                                                }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <label>Narration</label>
                                                        <select class="form-select" v-model="row.narration">
                                                            <option selected disabled value="">Select</option>
                                                            <option value="খাওয়ার পর">...খাওয়ার পর</option>
                                                            <option value="খাওয়ার আগে">
                                                                ...খাওয়ার আগে
                                                            </option>
                                                            <option value="১ চামচ করে খাওয়ার পর">
                                                                ...১ চামচ করে খাওয়ার পর
                                                            </option>
                                                            <option value="১ চামচ করে খাওয়ার আগে">
                                                                ...১ চামচ করে খাওয়ার আগে
                                                            </option>
                                                            <option value="১/২ চামচ করে খাওয়ার পর">
                                                                ...১/২ চামচ করে খাওয়ার পর
                                                            </option>
                                                            <option value="১/২ চামচ করে খাওয়ার আগে">
                                                                ...১/২ চামচ করে খাওয়ার আগে
                                                            </option>
                                                            <option value="২ চামচ করে খাওয়ার পর">
                                                                ...২ চামচ করে খাওয়ার পর
                                                            </option>
                                                            <option value="২ চামচ করে খাওয়ার আগে">
                                                                ...২ চামচ করে খাওয়ার আগে
                                                            </option>
                                                        </select>
                                                        <div v-if="
                                                            errors?.[`medicineArray.${index}.narration`]
                                                        ">
                                                            <div class="text-danger small">
                                                                {{
                                                                    errors[
                                                                        `medicineArray.${index}.narration`
                                                                    ][0].replace(`medicineArray.${index}.`, "")
                                                                }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-1 d-flex align-items-end pt-md-4">
                                                        <button class="btn btn-outline-danger btn-sm"
                                                            @click="removeRow(index)">
                                                            <i class="fa-solid fa-minus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </main>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end p-3 bg-white position-sticky bottom-0 w-100 shadow">
                    <button class="btn btn-success" @click="prescriptionSubmit">
                        Save & Show
                    </button>
                </div>
            </div>
        </div>
    </div>
    <component v-if="currentComponent && prescriptionData" :is="currentComponent" :prescriptionData="prescriptionData"
        @loadComponent="loadComponent"></component>
</template>

<script>
import {
    ref,
    onMounted,
    computed,
    watch,
    shallowRef,
    markRaw,
    nextTick,
} from "vue";
import { useRouter, useRoute } from "vue-router";
import Cookies from "js-cookie";
import axios from "axios";
import PrintPrescription from "./PrintPrescription.vue";
export default {
    components: { PrintPrescription },
    name: 'PrescriptionEdit',
    setup() {
        const router = useRouter();
        const route = useRoute();
        let currentComponent = shallowRef(null);
        const selectedCategoryId = ref("");
        const medicine_groupId = ref("");
        const prescriptionEditData = ref({});

        const access_token = ref("");
        const pathologies = ref([]);
        const medicines = ref([]);
        const id = ref('');

        const prescriptionData = ref({});
        const today = ref(new Date().toISOString().split("T")[0]);
        const form = ref({
            prescriptionId:'',
            blood_pressure_up: "",
            blood_pressure_down: "",
            pathologyArray: [],
            medicineArray: [],
            appoint_id: "",
            visit_date: today.value,
            patient_phone: ''
        });
        const errors = ref({});
        const rows = ref([{ capsul: "", indicate: "", narration: "" }]);

        // const addPathology = async (event) => {
        //   const selectedName = event.target.value;
        //   form.value.pathologyArray.push(selectedName);
        //   console.log(form.value.pathologyArray);
        // };

        const addPathology = async (event) => {
            const selectedName = event.target.value;

            if (form.value.pathologyArray.includes(selectedName)) {
                Swal.fire({
                    title: `The medicine "${selectedName}" is already added.`,
                    icon: "success",
                    draggable: true,
                });
            } else {
                form.value.pathologyArray.push(selectedName);
                console.log(form.value.pathologyArray);
            }
        };

        const addRow = () => {
            form.value.medicineArray.push({
                medicine_name: "",
                capsul: "",
                indicate: "",
                narration: "",
            });
        };

        const removeRow = (index) => {
            form.value.medicineArray.splice(index, 1);
        };

        const addMedicine = (event) => {
            const selectedName = event.target.value;

            if (!selectedName) return;

            const isDuplicate = form.value.medicineArray.some(
                (m) => m.medicine_name === selectedName
            );

            if (isDuplicate) {
                Swal.fire({
                    title: `The medicine "${selectedName}" is already added.`,
                    icon: "success",
                    draggable: true,
                });
            } else {
                form.value.medicineArray.push({
                    medicine_name: selectedName,
                    capsul: "",
                    indicate: "",
                    narration: "",
                });
            }
        };

        const prescriptionSubmit = async () => {
            try {
                const response = await axios.post(
                    "/api/auth/doctor/patient/prescription/store",
                    form.value,
                    {
                        headers: {
                            Authorization: `Bearer ${access_token.value}`,
                        },
                    }
                );
                console.log(response)
                if (response.data && response.status === 201 || response.status === 200) {
                    prescriptionData.value = response.data.data;
                    await nextTick();
                    currentComponent.value = markRaw(PrintPrescription);
                    Swal.fire({
                        title: response.data.message,
                        icon: "success",
                        draggable: true,
                    });
                }
            } catch (error) {
                if (error.response && error.response.data.errors) {
                    errors.value = error.response.data.errors;
                    console.log(error.response.data.errors);
                }
                if (error.response && error.response.data.error) {
                    const { status, data } = error.response;
                    if (status === 401) {
                        alert("Unauthorized access. Please log in.");
                    }
                }
            }
        };
        const loadComponent = () => {
            router.push({ 
                name: 'PatientDetails',
                query: { 
                    id: patient.id,
                    patient_phone: patient.patient_mobile 
                }
            });
            currentComponent.value = null;
        };

        // const addMedicine = (event) => {
        //   const selectedName = event.target.value;
        //   if (
        //     selectedName &&
        //     !form.value.medicineArray.some((m) => m.medicine_name === selectedName)
        //   ) {
        //     form.value.medicineArray.push({
        //       medicine_name: selectedName,
        //       capsul: "",
        //       indicate: "",
        //       narration: "",
        //     });
        //   }
        // };

        const fetchPathology = async () => {
            try {
                const response = await axios.get("/api/auth/pathology/list", {
                    headers: {
                        Authorization: `Bearer ${access_token.value}`,
                    },
                });
                if (
                    response.data &&
                    response.status === 200 &&
                    Array.isArray(response.data)
                ) {
                    pathologies.value = response.data;
                } else {
                    console.error("Data is not in expected format:", response.data);
                }
            } catch (error) {
                console.log(error);
            }
        };

        const fetchMedicine = async () => {
            try {
                const response = await axios.get("/api/auth/medicine/list", {
                    headers: {
                        Authorization: `Bearer ${access_token.value}`,
                    },
                });
                if (
                    response.data &&
                    response.status === 200 &&
                    Array.isArray(response.data)
                ) {
                    medicines.value = response.data;
                } else {
                    console.error("Data is not in expected format:", response.data);
                }
            } catch (error) {
                console.log(error);
            }
        };

        const previousPrescription = async () => {
            try {
                const response = await axios.get('/api/auth/doctor/patient/prescriptionpatient', {
                    params: { id: id.value },
                    headers: {
                        'Authorization': `Bearer ${access_token.value}`
                    }
                });

                if (response.data && response.status === 200) {
                    prescriptionEditData.value = response.data;
                    form.value.prescriptionId = prescriptionEditData.value.id
                    form.value.appoint_id = prescriptionEditData.value.appointment.id
                    form.value.pathologyArray = prescriptionEditData.value.pathologies
                    form.value.medicineArray = prescriptionEditData.value.medicine
                    form.value.blood_pressure_up = prescriptionEditData.value.blood_pressure_up
                    form.value.blood_pressure_down = prescriptionEditData.value.blood_pressure_down
                    form.value.patient_phone = prescriptionEditData.value.appointment.patient_mobile
                    console.log(prescriptionEditData.value)
                }
            } catch (error) {
                console.error(error);
            }
        }

        const splitExperience = (experience) => {
            const formattedExperience = (experience || "")
                .split(",")
                .map((item) => item.trim())
                .filter((item) => item.length > 0);

            const groupedLines = [];
            let firstLine = [];
            let currentLine = [];

            for (let i = 0; i < formattedExperience.length; i++) {
                const item = formattedExperience[i];

                if (firstLine.length < 3) {
                    if (item.length > 4) {
                        if (firstLine.length > 0) {
                            groupedLines.push(firstLine.join(", "));
                        }
                        groupedLines.push(item);
                        firstLine = [];
                        currentLine = formattedExperience.slice(i + 1);
                        break;
                    } else {
                        firstLine.push(item);
                    }
                }

                if (firstLine.length === 3 || i === formattedExperience.length - 1) {
                    groupedLines.push(firstLine.join(", "));
                    currentLine = formattedExperience.slice(i + 1);
                    break;
                }
            }
            let tempLine = [];
            currentLine.forEach((item) => {
                if (item.length > 11) {
                    if (tempLine.length > 0) {
                        groupedLines.push(tempLine.join(", "));
                        tempLine = [];
                    }
                    groupedLines.push(item);
                } else {
                    tempLine.push(item);
                    if (tempLine.length === 3) {
                        groupedLines.push(tempLine.join(", "));
                        tempLine = [];
                    }
                }
            });
            if (tempLine.length > 0) {
                groupedLines.push(tempLine.join(", "));
            }

            return groupedLines;
        };
        const filteredPathologies = computed(() => {
            return pathologies.value
                .flatMap((category) => category.pathologies)
                .filter((p) => p.pathology_category_id === selectedCategoryId.value);
        });

        const filteredMedicines = computed(() => {
            return medicines.value
                .flatMap((category) => category.medicines)
                .filter((p) => p.medicine_group_id === medicine_groupId.value);
        });

        onMounted(async () => {
            access_token.value = Cookies.get("access_token");
            id.value = route.query.id;
            await fetchPathology();
            await fetchMedicine();
            await previousPrescription();
        });

        watch(
            () => form.value.medicineArray,
            (newVal) => {
                console.log("Updated medicine array:", JSON.stringify(newVal, null, 2));
            },
            { deep: true }
        );

        return {
            pathologies,
            selectedCategoryId,
            medicine_groupId,
            filteredPathologies,
            filteredMedicines,
            splitExperience,
            medicines,
            addPathology,
            form,
            addRow,
            rows,
            removeRow,
            addMedicine,
            prescriptionSubmit,
            prescriptionData,
            currentComponent,
            loadComponent,
            errors,
            prescriptionEditData
        };
    }
}
</script>

<style scoped>
.sidebar {
    background-color: #f4f6ff;
    min-height: 100vh;
    padding: 10px;
}

.line-tight {
    line-height: 1.5;
}

.sidebar a {
    color: black;
    text-decoration: none;
    display: block;
    margin: 5px 0;
}

.sidebar a:hover {
    text-decoration: underline;
}

.sidebar h6 {
    background-color: #004aad;
}

.content-wrapper {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

.content {
    flex: 1;
}

.bottom-buttons {
    margin-top: auto;
    text-align: right;
    padding: 10px 0;
}

@media (min-width: 768px) {
    .pathology_test {
        height: 100%;
    }

    .prescription_text {
        height: 100%;
    }

    .line-tight {
        line-height: 1.5;
    }
}

@media (max-width: 767px) {

    .pathology_test,
    .prescription_text {
        height: auto;
    }

    .line-tight {
        line-height: 1.5;
    }

    .prescription_details {
        flex-direction: column;
    }

    .pathology_test {
        order: 1;
        width: 100%;
    }

    .prescription_text {
        order: 2;
        width: 100%;
    }

    .input_group {
        gap: 0.5rem;
    }

    .row {
        flex-direction: column;
    }
}

.custom-height {
    height: 30px;
    background-color: #1d93d2;
    color: white;
}

@media (max-width: 768px) {
    .custom-height {
        height: 25px;
    }

    .line-tight {
        line-height: 1.5;
    }
}
</style>
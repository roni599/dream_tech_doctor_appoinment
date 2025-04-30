<template>
  <div class="container-fluid" style="margin-top: -100px;">
    <div class="maindiv">
      <div class="card">
        <div class="card-body">
          <div class="container-fluid content-wrapper">
            <div class="row flex-grow-1">
              <nav class="col-md-2 sidebar d-none d-md-block">
                <h6 class="p-2 rounded text-center text-white">Pathology List</h6>
                <select class="form-select mb-3" aria-label="Pathology List" v-model="selectedCategoryId">
                  <option selected disabled value="">Select Category</option>
                  <option v-for="pathology in pathologies" :key="pathology.id" :value="pathology.id">{{
                    pathology.name }}</option>
                </select>
                <select class="form-select mb-3" aria-label="Pathology List">
                  <option selected disabled>Select Pathology</option>
                  <option v-for="pathology in filteredPathologies" :key="pathology.id" :value="pathology.id">{{
                    pathology.name }}</option>
                </select>
              </nav>

              <main class="col-md-10 pt-2 d-flex flex-column content">
                <div
                  class="doctor_details_hospital d-flex flex-column-reverse flex-md-row justify-content-between align-items-center w-100 p-1 mb-md-2">
                  <div class="doctorName_details w-100 w-md-50 mb-2 mb-md-0">
                    <h6 class="">Dr. Md. Jasim Uddin Nizami</h6>
                    <div class="doctor_details">
                      <p class="mb-0">MBBS DMU FCPS MS</p>
                      <p class="mb-0">WHO Clinical Polw On Child Urologist</p>
                      <p class="mb-0">Polw On Child Urologist</p>
                      <p class="fw-bold mb-0">Specialist</p>
                      <p class="mb-0">Child, BabyCare, Urologists, Medicine</p>
                      <p class="mb-0">Hfdngf, Reaset</p>
                      <p class="fw-bold mb-0">Proposer</p>
                      <p class="mb-0">Department of Child Surgery</p>
                      <p class="mb-0">Sohid Sorowerdy Medical Collge</p>
                      <p class="mb-0">01984-994406</p>
                    </div>
                  </div>
                  <div class="hospital_address_logo w-100 w-md-50 mb-3">
                    <div class="address_logo d-flex justify-content-start align-items-center">
                      <div class="hospital_logo">
                        <img src="../../../../../../../public/doctor_html/images/logo.png" width="80" height="auto"
                          alt="">
                      </div>
                      <div class="hospital_address">
                        <h3 class="mb-0">Ibnsina Hospital</h3>
                        <p class="mb-0">House# 68, Road # 15/A, Dhanmondi, Dhaka-1206</p>
                        <p class="mb-0">0194-994406, 01778344090</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="d-md-none mt-md-3">
                  <select class="form-select mb-3" aria-label="Pathology List">
                    <option selected disabled>Select Pathology</option>
                    <option value="hematology-thalassemia">Hematology Thalassemia</option>
                    <option value="diabetes-kidney">Diabetes Kidney</option>
                    <option value="disease-heart">Disease Heart</option>
                    <option value="disease-anemia">Disease Anemia</option>
                    <option value="profile-serum">Profile Serum</option>
                    <option value="electrolytes-liver">Electrolytes Liver</option>
                    <option value="disease-thyroid">Disease Thyroid</option>
                    <option value="disorders-cancer">Disorders Cancer</option>
                    <option value="markers-endocrine">Markers Endocrine</option>
                    <option value="tests-drug">Tests Drug</option>
                  </select>
                </div>

                <div class="patient_details mb-0">
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <tbody>
                        <tr>
                          <th class="custom-height">Name</th>
                          <td class="custom-height">Md. XYZ</td>
                          <th class="custom-height">Gender</th>
                          <td class="custom-height">Male</td>
                          <th class="custom-height">Age</th>
                          <td class="custom-height">38</td>
                          <th class="custom-height">Date</th>
                          <td class="custom-height">12.08.2024</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="prescription d-flex flex-column h-100">
                  <div class="prescription_details w-100 d-flex flex-column flex-md-row flex-grow-1">
                    <div class="pathology_test pt-2 d-flex flex-column align-items-center w-lg-25 w-md-100"
                      style="background-color: #eae7f1; height: 63vh;">
                      <p class="text-center mb-2">Blood Pressure</p>
                      <div class="input_group d-flex flex-md-column flex-md-row align-items-center px-5 gap-1">
                        <div class="d-flex flex-column align-items-center w-100 w-md-50">
                          <label for="up" class="mb-1">Up</label>
                          <input type="text" name="up" id="up" class="text-center w-100">
                        </div>
                        <div class="d-flex flex-column align-items-center w-100 w-md-50">
                          <label for="down" class="mb-1">Down</label>
                          <input type="text" name="down" id="down" class="text-center w-100">
                        </div>
                      </div>

                    </div>
                    <div class="prescription_text pt-2 w-100 w-md-75" style="background-color: white;">
                      <div class="row mb-3">
                        <div class="col-md-1 ms-md-5">
                          <h3>R<sub>X</sub></h3>
                        </div>
                        <div class="col-md-4">
                          <label>Medicine Group</label>
                          <select class="form-select">
                            <option>Select</option>
                          </select>
                        </div>
                        <div class="col-md-4">
                          <label>Medicine Name</label>
                          <select class="form-select">
                            <option>Select</option>
                          </select>
                        </div>
                      </div>
                      <div class="row mb-3 d-flex ms-md-1 justify-content-center align-items-center w-100">
                        <div class="col-md-3">
                          <label>Capsul: Agothmaisin</label>
                          <select class="form-select">
                            <option>Select</option>
                          </select>
                        </div>
                        <div class="col-md-3">
                          <label>Indicate</label>
                          <select class="form-select">
                            <option>Select</option>
                          </select>
                        </div>
                        <div class="col-md-2">
                          <label>Narration</label>
                          <input type="text" class="form-control">
                        </div>
                        <div class="col-md-1">
                          <p class="pt-md-4"><i class="fa-solid fa-plus"></i></p>
                        </div>
                      </div>
                      <div class="row mb-3 d-flex justify-content-center ms-md-1 align-items-center w-100">
                        <div class="col-md-3">
                          <label>Tablet: Mattile</label>
                          <select class="form-select">
                            <option>Select</option>
                          </select>
                        </div>
                        <div class="col-md-3">
                          <label>Indicate</label>
                          <select class="form-select">
                            <option>Select</option>
                          </select>
                        </div>
                        <div class="col-md-2">
                          <label>Narration</label>
                          <input type="text" class="form-control">
                        </div>
                        <div class="col-md-1">
                          <p class="pt-md-4"><i class="fa-solid fa-plus"></i></p>
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
          <button class="btn btn-success">Save & Print</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted, computed } from "vue";
import { useRouter, useRoute } from "vue-router";
import Cookies from 'js-cookie';
export default {
  name: 'Prescription',
  setup() {
    const router = useRouter();
    const route = useRoute();
    const selectedCategoryId = ref('')
    const access_token = ref('');
    const pathologies = ref([]);
    const fetchPathology = async () => {
      try {
        const response = await axios.get('/api/auth/pathology', {
          headers: {
            'Authorization': `Bearer ${access_token.value}`
          }
        });
        console.log(response.data)
        if (response.data && response.status === 200 && Array.isArray(response.data)) {
          pathologies.value = response.data;
        } else {
          console.error("Data is not in expected format:", response.data);
        }
      } catch (error) {
        console.log(error)
      }
    }
    const filteredPathologies = computed(() => {
      return pathologies.value
        .flatMap(category => category.pathologies)
        .filter(p => p.pathology_category_id === selectedCategoryId.value); 
    });
    onMounted(async () => {
      access_token.value = Cookies.get('access_token');
      const patientId = route.query.id;
      await fetchPathology();
    })
    return {
      pathologies,
      selectedCategoryId,
      filteredPathologies
    }
  }
}
</script>

<style scoped>
.sidebar {
  background-color: #f4f6ff;
  min-height: 100vh;
  padding: 10px;
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
}

@media (max-width: 767px) {

  .pathology_test,
  .prescription_text {
    height: auto;
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
}
</style>
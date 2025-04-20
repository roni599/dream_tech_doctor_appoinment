<template>
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3 w-100">
      <div class="d-flex w-100 mb-2 mb-sm-0">
        <router-link to="/medicine-create" class="btn btn-primary ms-2">
          + Create Medicine
        </router-link>
      </div>
    </div>
    <div class="allFeature">
      <div class="row mb-1">
        <div class="col-md-12 mb-3">
          <label for="department" class="form-label mb-0">Medicine Name</label>
          <select id="department-category" v-model="selectedMedicine" class="form-select">
            <option value="" selected>Choose...</option>
            <option v-for="med in medicines" :key="med.id" :value="med.medicine_name">
              {{ med.medicine_name }}
            </option>
          </select>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead class="table-light">
            <tr>
              <th>Sl No</th>
              <th>Medicine Name</th>
              <th>Medicine Group Name</th>
              <th>Strength</th>
              <th>Description Of Doasages</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(medicine, index) in filteredmedicine" :key="medicine.id">
              <td>{{ index + 1 }}</td>
              <td>{{ medicine.medicine_name }}</td>
              <td>{{ medicine.medicine_group.group_name }}</td>
              <td>{{ medicine.strength }}</td>
              <td>{{ medicine.dosages_description }}</td>
              <td>
                <span class="badge bg-success" v-if="medicine.status === 1">Active</span>
                <span v-else class="badge bg-danger">InActive</span>
              </td>
              <td class="">
                <router-link :to="{ name: 'MedicineEdit', params: { id: medicine.id } }"
                  class="btn btn-outline-warning btn-sm">
                  <i class="fa-solid fa-pen-to-square"></i>
                </router-link>
                <button class="btn btn-outline-danger btn-sm" @click="deleteMedicine(medicine.id)">
                  <i class="fa-solid fa-trash"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
<script>
import { ref, computed, onMounted } from 'vue';
import Cookies from 'js-cookie';
export default {
  name: "Medicine",
  setup() {
    const access_token = ref('');
    const medicineGroup = ref([]);
    const medicines = ref([]);
    const selectedMedicine = ref('');

    const filteredmedicine = computed(() => {
      return medicines.value.filter(medicine =>
        medicine.medicine_name.toLowerCase().includes(selectedMedicine.value.toLowerCase())
      );
    });


    const fetchMedicineGroup = async () => {
      try {
        const response = await axios.get('/api/auth/medicine-group', {
          headers: {
            'Authorization': `Bearer ${access_token.value}`
          }
        });
        if (response.data && response.status === 200) {
          medicineGroup.value = response.data;
        }
      } catch (error) {
      }
    }

    const fetchMedicine = async () => {
      try {
        const response = await axios.get('/api/auth/medicine', {
          headers: {
            'Authorization': `Bearer ${access_token.value}`
          }
        });
        if (response.data && response.status === 200) {
          medicines.value = response.data;
        }
      } catch (error) {

      }
    }
    const deleteMedicine = async (id) => {
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
            const response = await axios.post('/api/auth/medicine/delete', { id }, {
              headers: {
                'Authorization': `Bearer ${access_token.value}`
              }
            })

            if (response.data && response.status === 200) {
              fetchMedicineGroup();
              fetchMedicine();
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
    onMounted(async () => {
      access_token.value = Cookies.get('access_token');
      await fetchMedicineGroup();
      await fetchMedicine();
    })
    return {
      medicineGroup,
      deleteMedicine,
      filteredmedicine,
      selectedMedicine,
      medicines,
    }
  }
}
</script>

<style scoped></style>
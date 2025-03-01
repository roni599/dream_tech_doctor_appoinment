<template>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3 w-100">
            <div class="d-flex w-100 mb-2 mb-sm-0">
                <router-link to="/reference-create" class="btn btn-primary ms-2">
                    + Create Reference
                </router-link>
            </div>
        </div>
        <div>
            <div class="row mb-1">
                <div class="col-md-12 mb-3">
                    <label for="reference" class="form-label mb-0">Search Reference</label>
                    <select id="reference" v-model="search_reference" class="form-select">
                        <option value="" selected>Choose...</option>
                        <option v-for="reference in references" :key="reference.id" :value="reference.name" selected>{{ reference.name }}</option>
                    </select>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered custom-table">
                    <thead>
                        <tr class="bg-primary">
                            <th style="height: 35px; color: white; padding: 10px;"># SL No</th>
                            <th style="height: 35px; color: white; padding: 10px;">Name</th>
                            <th style="height: 35px; color: white; padding: 10px;">Email</th>
                            <th style="height: 35px; color: white; padding: 10px;">Phone</th>
                            <th style="height: 35px; color: white; padding: 10px;">Address</th>
                            <th style="height: 35px; color: white; padding: 10px;">Status</th>
                            <th style="height: 35px; color: white; padding: 10px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(reference, index) in filteredReference" :key="reference.id">
                            <th scope="row">{{ index + 1 }}</th>
                            <td>{{ reference.name }}</td>
                            <td>{{ reference.email }}</td>
                            <td>{{ reference.phone }}</td>
                            <td>{{ reference.address }}</td>
                            <td>
                                <span v-if="reference.status === 1" class="badge bg-success">Active</span>
                                <span v-else class="badge bg-danger">Dactive</span>
                            </td>
                            <td>
                                <div class="d-flex ms-auto">
                                    <router-link
                                        :to="{ name: 'ReferenceEdit', params: { id: encryptId(reference.id) } }"
                                        class="btn btn-outline-warning me-2">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </router-link>
                                    <button class="btn btn-outline-danger" @click="deleteReference(reference.id)">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import { onMounted, ref,computed } from 'vue';
import Cookies from 'js-cookie';
import CryptoJS from 'crypto-js';
export default {
    name: "ReferenceList",
    setup() {
        const access_token = ref('');
        const references = ref([]);
        const search_reference = ref('');
        const filteredReference = computed(() => {
            if (!search_reference.value) {
                return references.value;
            }
            return references.value.filter(reference => reference.name.includes(search_reference.value));
        });

        const fetchReference = async () => {
            try {
                const response = await axios.get('/api/auth/reference', {
                    headers: {
                        'Authorization': `Bearer ${access_token.value}`
                    }
                });
                if (response.data && response.status === 200) {
                    references.value = response.data;
                }
            } catch (error) {
            }
        }

        const deleteReference = async (id) => {
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
                        const response = await axios.post('/api/auth/reference/referencedelete', { id }, {
                            headers: {
                                'Authorization': `Bearer ${access_token.value}`
                            }
                        })
                        if (response.data && response.status === 200) {
                            fetchReference();
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

        const encryptId = (id) => {
            return CryptoJS.AES.encrypt(id.toString(), access_token.value).toString();
        }

        onMounted(() => {
            access_token.value = Cookies.get('access_token');
            fetchReference()
        })

        return {
            search_reference,
            references,
            encryptId,
            deleteReference,
            filteredReference
        }
    }
}
</script>

<style scoped>
.custom-table {
    border-radius: 5px;
    overflow: hidden;
    border-collapse: separate;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    border-spacing: 0;
}

.custom-table th {
    padding: 10px;
    white-space: nowrap;
    /* Prevents text wrapping */
}

.custom-table td {
    white-space: nowrap;
}

/* Ensuring responsiveness */
@media screen and (max-width: 768px) {
    .table-responsive {
        border-radius: 5px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        overflow-x: auto;
    }
}
</style>
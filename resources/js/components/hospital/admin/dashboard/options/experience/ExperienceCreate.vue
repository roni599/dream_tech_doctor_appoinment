<template>
    <div class="d-flex justify-content-center align-items-center">
        <div class="card" style="width: 1230px;">
            <div class="card-header mt-2">
                <h5 class="card-title">Experience Create</h5>
            </div>
            <div class="card-body">
                <form @submit.prevent="submitForm">
                    <div class="row form-section mb-4">
                        <div class="col-md-12">
                            <label for="department" class="form-label mb-0">Experience</label>
                            <input type="text" class="form-control" id="reg-number">
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
import { ref } from 'vue';

export default {
    name: "ExperienceCreate",
    setup() {
        const currentComponent = ref(false);
        return {
            currentComponent
        }
    }
}
</script>

<style></style>
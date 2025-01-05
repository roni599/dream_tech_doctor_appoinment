<template>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3 w-100">
            <div class="d-flex w-100 mb-2 mb-sm-0">
                <button @click="anotherLoad" class="btn btn-primary">
                    <i class="fa-solid fa-list"></i><span class="ms-2">Experience List</span>
                </button>
                <button @click="componentLoad('ExperienceCreate')" class="btn btn-primary ms-2">
                    + Create Experience
                </button>
            </div>
        </div>
        <div v-show="!currentComponent" class="allFeature">
            <div class="row mb-3">
                <div class="col-md-12 mb-3">
                    <label for="department" class="form-label mb-0">Experience</label>
                    <select id="department" class="form-select">
                        <option value="" selected>Choose...</option>
                    </select>
                </div>
            </div>
            <div class="list-group">
                <div class="doctor-card d-flex align-items-center">
                    <div class="doctor-avatar me-3">
                        <!-- <img  alt="" width="60px" height="60px" /> -->
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="mb-1"></h5>
                        <p class="mb-0 text-muted"></p>
                    </div>
                    <div class="d-flex align-items-center">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <component :is="currentComponent"></component>
</template>

<script>
import { markRaw, shallowRef } from 'vue';
import ExperienceCreate from './ExperienceCreate.vue';
export default {
    name: "Experience",
    setup() {
        const currentComponent = shallowRef(null);
        const componentLoad = (componentvalue) => {
            if (componentvalue === "ExperienceCreate") {
                currentComponent.value = markRaw(ExperienceCreate);
            }
        };
        const anotherLoad = () => {
            currentComponent.value = null;
        };
        return {
            currentComponent,
            componentLoad,
            anotherLoad
        }
    }
}
</script>

<style></style>
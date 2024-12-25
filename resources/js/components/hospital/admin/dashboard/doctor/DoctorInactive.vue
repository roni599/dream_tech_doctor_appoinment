<template>
    <h1>i am from DoctorInactive</h1>
</template>

<script>
import { onMounted, ref } from 'vue';
export default {
    name: "DoctorInactive",
    setup() {
        const currentComponent = ref(false);
        return {
            currentComponent
        }
    }
}
</script>

<style scoped></style>
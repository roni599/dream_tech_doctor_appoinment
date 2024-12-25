<template>
    <h1>I am from DoctorActive</h1>
</template>

<script>
import { onMounted, ref } from 'vue';
export default {
    name: 'DoctorActive',
    setup() {
        const currentComponent = ref(false);
        return {
            currentComponent
        }
    }
}
</script>

<style></style>
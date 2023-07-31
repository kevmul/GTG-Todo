<script setup lang="ts">
import { ref } from 'vue';

const showAlert = ref(true);

const closeAlert = () => {
    showAlert.value = false;
};
</script>

<template>
    <div v-show="showAlert">
        <div data-testid="alert">
            <div data-testid="close" @click="closeAlert">&times;</div>
        </div>
    </div>
</template>

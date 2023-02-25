<script setup lang="ts">
import { ref } from "vue";
</script>

<template>
    <div class="bg-gray-100">
        <div class="container m-auto space-x-2">
            <router-link to="/">Home</router-link>
            <router-link to="/about">About</router-link>
        </div>
    </div>
    <div class="container m-auto">
        <router-view></router-view>
    </div>
</template>

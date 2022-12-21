<script setup lang="ts">
import { ref } from "vue";
</script>

<template>
    <h1>Hello World!</h1>
    <router-link to="/">Home</router-link>
    <router-link to="/about">About</router-link>
    <router-view></router-view>
</template>

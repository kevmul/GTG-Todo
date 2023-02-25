<script setup lang="ts">
import { computed } from "vue";
import type { TodoStatus } from "../types/todo";

const props = defineProps<{
    isImportant: boolean;
    status: TodoStatus;
}>();

const strokeWidth = computed(() => {
    return props.isImportant ? 4 : 2;
});
</script>

<template>
    <svg
        width="50"
        height="50"
        viewBox="0 0 50 50"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
        v-bind="$attrs"
    >
        <circle
            cx="25"
            cy="25"
            r="22"
            stroke="black"
            :stroke-width="strokeWidth"
        />
        <path
            d="M10.04 10.04L39.96 39.96"
            stroke="black"
            class="progressLine"
            :class="{
                visible: ['in-progress', 'complete'].includes(props.status),
            }"
            :stroke-width="strokeWidth"
        />
        <path
            d="M39.96 10.04L10.04 39.96"
            stroke="black"
            class="progressLine"
            :class="{
                visible: ['complete'].includes(props.status),
            }"
            :stroke-width="strokeWidth"
        />
    </svg>
</template>

<style>
:root {
    --line-length: 42;
}
.progressLine {
    stroke-dasharray: var(--line-length);
    stroke-dashoffset: var(--line-length);
    transition: 0.4s cubic-bezier(0.48, 0, 0.81, 0.15);
}
.progressLine.visible {
    stroke-dashoffset: 0;
}
</style>

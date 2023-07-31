<script setup lang="ts">
const props = defineProps<{
    isOpen: boolean;
}>();

const emit = defineEmits<{
    (e: 'update:is-open', boolean): void;
}>();
</script>

<template>
    <div
        v-show="props.isOpen"
        data-testid="flyout-backer"
        class="opacity-0 fixed top-0 left-0 right-0 bottom-0 z-10"
        @click="emit('update:is-open', false)"
    />
    <div
        v-show="props.isOpen"
        class="absolute z-10 top-full rounded py-1 min-w-[120px] bg-white shadow-2xl border border-gray-300"
    >
        <slot />
    </div>
</template>

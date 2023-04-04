<script setup lang="ts">
import TodoIcon from "./TodoIcon.vue";
import { TodoStatus } from "../types/todo";
import { useTodoStore } from "../stores/TodoStore";
import { onBeforeMount, ref } from "vue";

const { updateStatus, updateTitle } = useTodoStore();

const props = defineProps<{
    id: string;
    isImportant: boolean;
    status: TodoStatus;
    title: string;
}>();

const title = ref("");

onBeforeMount(() => {
    title.value = props.title;
});
</script>

<template>
    <div class="flex border-b-2 border-black space-x-4 items-center">
        <TodoIcon
            class="cursor-pointer"
            :isImportant="false"
            :status="props.status"
            @click="updateStatus(props.id)"
        />
        <input
            class="text-3xl font-bold text-ellipsis flex w-full"
            data-testid="todo-title-input"
            type="text"
            v-model="title"
            @blur="updateTitle(props.id, title)"
        />
        <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="w-6 h-6"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M19.5 8.25l-7.5 7.5-7.5-7.5"
            />
        </svg>
    </div>
</template>

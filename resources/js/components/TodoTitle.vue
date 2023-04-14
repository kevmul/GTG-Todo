<script setup lang="ts">
import TodoIcon from "./TodoIcon.vue";
import { TodoStatus } from "../types/todo";
import { useTodoStore } from "../stores/TodoStore";
import { onBeforeMount, ref } from "vue";
import Flyout from "./Flyout.vue";

const { updateStatus, updateTitle, archive } = useTodoStore();

const props = defineProps<{
    id: string;
    isImportant: boolean;
    status: TodoStatus;
    title: string;
}>();

const title = ref("");

const showActions = ref(false);

onBeforeMount(() => {
    title.value = props.title;
});
</script>

<template>
    <div class="flex border-b-2 border-black space-x-4 items-center">
        <span class="relative">
            <div class="cursor-pointer" @click="showActions = true">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                </svg>
            </div>
            <Flyout v-model:is-open="showActions">
                <button class="px-4 hover:bg-gray-200 w-full" @click="archive(props.id)">Archive</button>
            </Flyout>
        </span>
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

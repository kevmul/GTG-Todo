<script setup lang="ts">
import { Todo } from "../types/todo";
import SubTask from "./SubTask.vue";
import TodoTitle from "./TodoTitle.vue";

const props = defineProps<{
    todo: Todo;
}>();
</script>

<template>
    <div class="p-4 rounded shadow">
        <TodoTitle
            :id="props.todo.id"
            :is-important="props.todo.is_important"
            :title="props.todo.title"
            :progress="props.todo.progress"
        />
        <SubTask :tasks="props.todo.subtasks"/>
    </div>
</template>

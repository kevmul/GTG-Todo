<script setup lang="ts">
import { useTodoStore } from "../stores/TodoStore";
import { onBeforeMount } from "vue";

const todoStore = useTodoStore();

onBeforeMount(() => {
    todoStore.fetch();
});
</script>

<template>
    <h1>TODOs!</h1>
    <div>
        <ul>
            <li
                v-for="todo in todoStore.todos"
                :key="todo.id"
                data-testid="todo-list-item"
            >
                {{ todo.title }}
            </li>
        </ul>
    </div>
</template>

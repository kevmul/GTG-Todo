<script setup lang="ts">
import { useTodoStore } from "../stores/TodoStore";
import { onBeforeMount } from "vue";
import Todo from "../components/Todo.vue";

const todoStore = useTodoStore();

onBeforeMount(() => {
    todoStore.fetch();
});
</script>

<template>
    <h1>TODOs!</h1>
    <div class="space-y-4">
        <div
            v-for="todo in todoStore.todos"
            :key="todo.id"
            data-testid="todo-list-item"
        >
            <Todo :todo="todo" />
        </div>
    </div>
</template>

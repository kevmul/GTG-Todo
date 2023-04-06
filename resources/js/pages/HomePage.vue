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
            <transition>
                <Todo :todo="todo" v-if="!todo.meta?.archived"/>
            </transition>
        </div>
        <button
            type="button"
            class="w-8 h-8 fixed bottom-4 right-4 bg-slate-100 text-slate-800 shadow rounded"
            data-testid="create-todo-btn"
            @click="todoStore.create"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                strokeWidth="{1.5}"
                stroke="currentColor"
                className="w-6 h-6"
            >
                <path
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    d="M12 4.5v15m7.5-7.5h-15"
                />
            </svg>
        </button>
    </div>
</template>

<style>
.v-enter-active,
.v-leave-active {
  transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
}
</style>

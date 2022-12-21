<script setup lang="ts">
import axios from "axios";
import { ref } from "vue";

const list = ref([]);

const fetch = () => {
    axios.get("todos").then((response) => {
        list.value = response.data.todos;
    });
};
</script>

<template>
    <h1>TODOs!</h1>
    <div>
        <ul>
            <li
                v-for="todo in list"
                :key="todo.id"
                data-testid="todo-list-item"
            >
                {{ todo.title }}
            </li>
        </ul>
        <button @click="fetch">Fetch TODOs</button>
    </div>
</template>

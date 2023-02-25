import { DateTime } from "luxon";
import { defineStore } from "pinia";
import { computed, ref } from "vue";
import axios from "axios";

export const useTodoStore = defineStore("todos", () => {
    const todos = ref([]);
    const lastFetch = ref(null);

    const list = computed(() => {
        return todos.value;
    });

    const fetch = async () => {
        const now = DateTime.now();
        if (
            !lastFetch.value ||
            lastFetch.value.plus({ seconds: 5 }).toMillis() <= now.toMillis()
        ) {
            const response = await axios.get("todos");
            todos.value = response.data.todos;
            lastFetch.value = now;
        }
    };

    const updateStatus = (id) => {
        const todo = todos.value.find((todo) => todo.id === id);

        if (todo.status === "new") return (todo.status = "in-progress");
        if (todo.status === "in-progress") return (todo.status = "complete");
        if (todo.status === "complete") return (todo.status = "new");
    };

    return {
        todos,
        lastFetch,
        list,
        fetch,
        updateStatus,
    };
});

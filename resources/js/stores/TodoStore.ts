import { DateTime } from "luxon";
import { defineStore } from "pinia";
import { computed, ref, Ref } from "vue";
import axios from "axios";
import { Todo } from "../types/todo";

export const useTodoStore = defineStore("todos", () => {
    const todos = <Ref<Todo[]>>ref([]);
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

    const create = async () => {
        const response = await axios.post("/todo");
        console.log(response);

        todos.value.unshift(response.data?.todo);
        console.log(todos.value);
    };

    const updateStatus = (id) => {
        const todo = todos.value.find((todo) => todo.id === id);

        if (todo.status === "new") return (todo.status = "in-progress");
        if (todo.status === "in-progress") return (todo.status = "complete");
        if (todo.status === "complete") return (todo.status = "new");
    };

    const updateTitle = async (id, title) => {
        const response = await axios.patch(`/todo/${id}`, { title });
        todos.value.find((todo) => todo.id === id).title = title;
        return response;
    };

    const archive = async (id) => {
        const response = await axios.delete(`/todo/${id}`);
        const todo = todos.value.find((todo) => todo.id === id);
        todo.meta = {archived: true};
        return response;
    }

    return {
        todos,
        lastFetch,
        list,
        fetch,
        create,
        updateStatus,
        updateTitle,
        archive,
    };
});

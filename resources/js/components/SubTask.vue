<script setup lang="ts">
import { TSubTask } from '../types/todo';

const props = defineProps<{
    tasks: TSubTask[]
}>();
</script>

<template>
    <ul class="ml-3 border-0 border-l-2 border-slate-200 pl-3">
        <li v-for="task in props.tasks" :key="task.id">
            <div class="flex flex-row w-full">
                <span class="flex justify-center items-center w-8">
                    <input type="checkbox" name="" id="" v-if="task.is_task">
                    <span v-else class="block w-2 h-2 rounded bg-slate-600"></span>
                </span>
                {{ task.body }}
            </div>
            <SubTask v-if="task.subtasks?.length" :tasks="task.subtasks"/>
        </li>
    </ul>
</template>

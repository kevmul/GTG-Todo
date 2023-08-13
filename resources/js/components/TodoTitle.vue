<script setup lang="ts">
import TodoIcon from '@/components/TodoIcon.vue';
import { TodoProgress } from '@/types/todo';
import { ref } from 'vue';
import Flyout from '@/components/Flyout.vue';
import { useTodoStore } from '@/stores/TodoStore';

const { updateProgress, updateTitle, archive } = useTodoStore();

const props = defineProps<{
    id: string;
    isImportant: boolean;
    progress: TodoProgress;
    title: string;
}>();

const showActions = ref(false);
</script>

<template>
    <div class="flex border-b-2 border-black space-x-4 items-center">
        <span class="relative">
            <div class="cursor-pointer" @click="showActions = true">
                <InlineSvg name="ellipsis-vertical" />
            </div>
            <Flyout v-model:is-open="showActions">
                <button
                    class="px-4 hover:bg-gray-200 w-full flex"
                    @click="archive(props.id)"
                >
                    <InlineSvg
                        name="archive-box"
                        class="mr-2 text-yellow-400"
                    />
                    Archive
                </button>
            </Flyout>
        </span>
        <TodoIcon
            class="cursor-pointer"
            :isImportant="false"
            :progress="props.progress"
            @click="updateProgress(props.id)"
        />
        <input
            class="text-3xl font-bold text-ellipsis flex w-full"
            data-testid="todo-title-input"
            type="text"
            :value="props.title"
            @blur="
                updateTitle(props.id, ($event.target as HTMLInputElement).value)
            "
        />
        <InlineSvg name="chevron-down" />
    </div>
</template>

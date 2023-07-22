export type TodoProgress = "new" | "in-progress" | "complete";

export interface Todo {
    id: string;
    title: string;
    progress: TodoProgress;
    is_important: boolean;
    subtasks: TSubTask[];
    created_at: Date;
    updated_at: Date;
    completed_at?: Date;
    archived_at?: Date;
    /** Add any meta data needed for UI */
    meta?: any;
}

export type TSubTask = {
    id: string;
    body : string;
    is_task : boolean;
    subtasks: TSubTask[];
}

export type TodoStatus = "new" | "in-progress" | "complete";

export interface Todo {
    id: string;
    title: string;
    status: TodoStatus;
    is_important: boolean;
    created_at: Date;
    updated_at: Date;
    completed_at?: Date;
    archived_at?: Date;
    /** Add any meta data needed for UI */
    meta?: any;
}

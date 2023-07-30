import axios from "axios";
import { createPinia, setActivePinia } from "pinia";
import { useTodoStore } from "../TodoStore";

vi.mock("axios");

const expectedResponse = {
    data: {
        todos: [
            { id: 1, title: "First Todo" },
            { id: 2, title: "Second Todo" },
        ],
    },
};

let store;
describe("TodoStore", () => {
    beforeEach(() => {
        setActivePinia(createPinia());
        vi.useFakeTimers();
        axios.get.mockResolvedValue(expectedResponse);
        axios.post.mockResolvedValue({
            data: {
                todo: { id: 3, title: "New Todo" },
            },
        });
        axios.patch.mockResolvedValue({data: {}})
    });

    afterEach(() => {
        vi.useRealTimers();
        vi.resetAllMocks();
    });

    describe("actions", () => {
        beforeEach(() => {
            store = useTodoStore();
        });
        test("fetch can only be called 5 seconds after previous call", async () => {
            await store.fetch();
            expect(axios.get).toBeCalledTimes(1);

            // After 1 second
            vi.advanceTimersByTime(1000);
            await store.fetch();
            expect(axios.get).toBeCalledTimes(1);

            // after 5 seconds (total)
            vi.advanceTimersByTime(4000);
            await store.fetch();
            expect(axios.get).toBeCalledTimes(2);
        });

        it("can create a new todo and prepend to the list", async () => {
            await store.fetch();
            expect(store.todos.length).toBe(2);
            expect(store.todos[0].title).toBe("First Todo");
            await store.create();
            expect(store.todos.length).toBe(3);
            expect(store.todos[0].title).toBe("New Todo");
        });

        it('can update its progress', async () => {
            store.todos.push({id: 1, title: 'My first test', progress: 'new'});
            expect(store.todos[0].progress).to.equal('new');

            await store.updateProgress(1);
            vi.advanceTimersByTime(499);
            expect(store.todos[0].progress).to.equal('in-progress')

            await store.updateProgress(1);
            vi.advanceTimersByTime(499);
            expect(store.todos[0].progress).to.equal('complete')

            await store.updateProgress(1);
            vi.advanceTimersByTime(500);
            expect(store.todos[0].progress).to.equal('new')

            expect(axios.patch).toHaveBeenCalledTimes(1)
        })
    });
});

import axios from "axios";
import { createPinia, setActivePinia } from "pinia";
import { useTodoStore } from "../TodoStore";

vi.mock("axios");

const expectedResponse = {
    data: {
        todos: [
            { id: 1, title: "Neque repudiandae." },
            { id: 2, title: "Neque repudiandae." },
        ],
    },
};

describe("TodoStore", () => {
    beforeEach(() => {
        setActivePinia(createPinia());
        vi.useFakeTimers();
        axios.get.mockResolvedValue(expectedResponse);
    });

    afterEach(() => {
        vi.useRealTimers();
    });

    describe("actions", () => {
        test("fetch can only be called 5 seconds after previous call", async () => {
            const store = useTodoStore();
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
    });
});

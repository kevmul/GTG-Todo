import { createTestingPinia } from "@pinia/testing";
import { shallowMount } from "@vue/test-utils";
import { useTodoStore } from "../../stores/TodoStore";
import axios from "axios";
import HomePage from "../HomePage.vue";

let store;
let wrapper;
let pinia;
const expectedResponse = {
    data: {
        todos: [
            { id: 1, title: "Neque repudiandae." },
            { id: 2, title: "Neque repudiandae." },
        ],
    },
};
vi.mock("axios");

describe("HomePage", () => {
    beforeEach(() => {
        vi.useFakeTimers();
        axios.get.mockResolvedValue(expectedResponse);
        pinia = createTestingPinia({ stubActions: false });
        wrapper = shallowMount(HomePage, {
            global: {
                plugins: [pinia],
            },
        });
        store = useTodoStore();
    });

    afterEach(() => {
        vi.useRealTimers();
        wrapper.unmount();
        vi.resetAllMocks();
    });

    it("can fetch all the todos", async () => {
        const todoList = wrapper.findAll('[data-testid="todo-list-item"]');

        expect(todoList).toHaveLength(2);
    });
});

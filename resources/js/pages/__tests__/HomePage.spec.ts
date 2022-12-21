import { mount } from "@vue/test-utils";
import axios from "axios";
import sinon from "sinon";
import HomePage from "../HomePage.vue";

const expectedResponse = {
    data: {
        todos: [
            { id: 1, title: "Neque repudiandae." },
            { id: 2, title: "Neque repudiandae." },
        ],
    },
};

describe("HomePage", () => {
    it("can fetch all the todos", async () => {
        sinon.stub(axios, "get").resolves(expectedResponse);
        const wrapper = mount(HomePage);
        await wrapper.get("button").trigger("click");
        await wrapper.vm.$nextTick();
        const todoList = wrapper.findAll('[data-testid="todo-list-item"]');

        expect(todoList).toHaveLength(2);
    });
});

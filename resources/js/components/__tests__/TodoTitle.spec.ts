import { shallowMount } from '@vue/test-utils';
import TodoTitle from '../TodoTitle.vue';
import axios from 'axios';
import { createTestingPinia } from '@pinia/testing';
import { useTodoStore } from '../../stores/TodoStore';

let wrapper;

vi.mock('axios');

describe('TodoTitle', () => {
    beforeEach(() => {
        createTestingPinia({ stubActions: false });
        wrapper = shallowMount(TodoTitle, {
            propsData: {
                id: 1,
                isImportant: false,
                progress: 'new',
                title: 'New Todo',
            },
        });
        axios.patch.mockResolvedValue({ message: 'Success' });
    });

    it('can update its own title', async () => {
        const store = useTodoStore();
        store.todos.push({ id: 1, title: 'New Todo' });
        const input = wrapper.find('[data-testid="todo-title-input"]');
        input.setValue('Updated Title!');
        await input.trigger('blur');
        expect(axios.patch).toBeCalledTimes(1);

        expect(store.todos.find((x) => x.id === 1).title).toEqual(
            'Updated Title!'
        );
    });
});

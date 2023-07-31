import { VueWrapper, shallowMount } from '@vue/test-utils';
import Flyout from '../Flyout.vue';

let wrapper: VueWrapper;
describe('Flyout', () => {
    beforeEach(() => {
        wrapper = shallowMount(Flyout, {
            propsData: {
                isOpen: false
            }
        });
    });

    it('can be opened', async() => {
        const backer = wrapper.find('[data-testid="flyout-backer"]');
        expect(backer.isVisible()).toBeFalsy();
        await wrapper.setProps({isOpen: true});
        expect(backer.isVisible()).toBeTruthy();
    });

    it('can be closed', async () => {
        await wrapper.setProps({isOpen: true});
        const backer = wrapper.find('[data-testid="flyout-backer"]');
        expect(backer.isVisible()).toBeTruthy();
        await backer.trigger('click');
        expect(wrapper.emitted('update:is-open')).toBeTruthy();
    });
});

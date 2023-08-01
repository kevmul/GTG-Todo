import Alert from '../Alert.vue';
import { shallowMount } from '@vue/test-utils';

describe('Alert', () => {
    it('is a component', () => {
        const wrapper = shallowMount(Alert);

        expect(wrapper).toBeTruthy();
    });

    describe('Close button', () => {
        it('closes when the user clicks the close button.', async () => {
            const wrapper = shallowMount(Alert);
            const alert = wrapper.find('[data-testid="alert"]');
            expect(alert.isVisible()).toBeTruthy();

            alert.find('[data-testid="close"]').trigger('click');
            await wrapper.vm.$nextTick();

            expect(alert.isVisible()).toBeFalsy();
        });
    });
});

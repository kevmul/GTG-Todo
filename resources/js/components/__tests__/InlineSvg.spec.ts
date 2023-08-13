import { mount } from '@vue/test-utils';
import InlineSvg from '../InlineSvg';

let consoleWarnStub;

describe('InlineSvg', () => {
    beforeEach(() => {
        consoleWarnStub = vi.spyOn(console, 'warn').mockImplementation(vi.fn());
    });

    it('can find the correct icon by name', () => {
        const wrapper = mount(InlineSvg, {
            propsData: { name: 'chevron-down' },
        });
        expect(wrapper.html()).includes('<svg');
        expect(consoleWarnStub).not.toHaveBeenCalled();
    });

    it('fails if the given Svg is invalid', () => {
        const wrapper = mount(InlineSvg, {
            propsData: { name: 'invalid' },
        });
        expect(wrapper.html()).not.includes('<svg');
        expect(consoleWarnStub).toHaveBeenCalled();
    });
});

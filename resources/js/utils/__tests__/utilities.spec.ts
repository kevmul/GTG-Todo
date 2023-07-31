import { debounce } from '../utilities';

describe('Utilities', () => {
    beforeEach(() => {
        vi.useFakeTimers();
    });

    afterEach(() => {
        vi.useRealTimers();
    });
    describe('Debounce', () => {
        it('can call a function after a given time', () => {
            const fake = vi.fn(() => {});
            debounce(fake, 300);
            expect(fake).not.toHaveBeenCalled();
            vi.advanceTimersByTime(300);
            expect(fake).toHaveBeenCalled();
        });

        it('only makes 1 call before timeout finishes', () => {
            const fake = vi.fn(() => {});
            debounce(fake, 300);
            // First Call
            vi.advanceTimersByTime(299);
            debounce(fake, 300);
            // Second Call
            vi.advanceTimersByTime(299);
            debounce(fake, 300);
            // Third Call
            vi.advanceTimersByTime(300);
            expect(fake).toHaveBeenCalledOnce();
        });
    });
});

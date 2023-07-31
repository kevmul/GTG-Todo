let debounceFunction = null;

/**
 * Create a new Debouces method that sets a timeout with a callable function
 * Note: Lodash debounce not working. Thats why this exists.
 */
export const debounce = (
    callback: (args?: unknown) => void,
    timeout?: number
) => {
    if (debounceFunction) clearTimeout(debounceFunction);
    debounceFunction = setTimeout(callback, timeout);
};

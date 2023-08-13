import { SvgNames } from '@/types/svgTypes';
import { PropType, defineComponent, h } from 'vue';

const files = Object.entries(
    import.meta.glob('@/svg/**/*.svg', {
        as: 'raw',
        eager: true,
    })
).map(([path, content]) => {
    const name = path.replace(/^.*\//, '').replace(/\.svg$/, '');
    return { name, content };
});

export default defineComponent({
    props: {
        name: { required: true, type: String as PropType<SvgNames> },
    },

    render() {
        const svg = files.find((file) => file.name === this.name);

        if (!svg || !svg.content) {
            console.warn(`The "${this.name}" svg does not exist.`);
            return;
        }

        return h('div', {
            class: 'inline-svg',
            innerHTML: svg.content,
        });
    },
});

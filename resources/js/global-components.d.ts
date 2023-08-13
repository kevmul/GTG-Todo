import InlineSvg from './components/InlineSvg';

declare module '@vue/runtime-core' {
    export interface GlobalComponents {
        InlineSvg: typeof InlineSvg;
    }
}

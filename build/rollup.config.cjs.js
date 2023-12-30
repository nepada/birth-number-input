import commonjs from '@rollup/plugin-commonjs';
import {nodeResolve} from '@rollup/plugin-node-resolve';


export default {
    input: 'src/assets/index.js',
    output: {
        dir: 'dist/commonjs',
        format: 'cjs',
        exports: 'auto',
        sourcemap: true,
        preserveModules: true,
    },
    plugins: [
        nodeResolve(),
        commonjs(),
    ],
};

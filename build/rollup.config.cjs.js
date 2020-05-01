import commonjs from '@rollup/plugin-commonjs';
import nodeBuiltins from 'rollup-plugin-node-builtins';
import nodeGlobals from 'rollup-plugin-node-globals';
import nodeResolve from '@rollup/plugin-node-resolve';


export default {
    input: 'src/assets/index.js',
    output: {
        dir: 'dist/commonjs',
        format: 'cjs',
        sourcemap: true,
    },
    preserveModules: true,
    plugins: [
        nodeResolve(),
        commonjs(),
        nodeBuiltins(),
        nodeGlobals(),
    ],
};

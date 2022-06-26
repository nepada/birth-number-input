import {babel} from '@rollup/plugin-babel';
import commonjs from '@rollup/plugin-commonjs';
import nodeBuiltins from 'rollup-plugin-node-builtins';
import nodeGlobals from 'rollup-plugin-node-globals';
import {nodeResolve} from '@rollup/plugin-node-resolve';
import {terser} from 'rollup-plugin-terser';


export default [
    {
        input: 'src/assets/birth-number-input.js',
        external: [
            'nette-forms',
        ],
        output: {
            file: 'dist/birth-number-input.js',
            format: 'umd',
            exports: 'auto',
            sourcemap: true,
            globals: {
                'nette-forms': 'Nette',
            },
        },
        plugins: [
            nodeResolve(),
            commonjs(),
            nodeBuiltins(),
            nodeGlobals(),
            babel({
                babelrc: false,
                babelHelpers: 'bundled',
                presets: [['@babel/preset-env', {targets: '> 1%, cover 95%, not dead'}]],
            }),
        ],
    },
    {
        input: 'src/assets/birth-number-input.js',
        external: [
            'nette-forms',
        ],
        output: {
            file: 'dist/birth-number-input.min.js',
            format: 'umd',
            exports: 'auto',
            sourcemap: true,
            globals: {
                'nette-forms': 'Nette',
            },
        },
        plugins: [
            nodeResolve(),
            commonjs(),
            nodeBuiltins(),
            nodeGlobals(),
            babel({
                babelrc: false,
                babelHelpers: 'bundled',
                presets: [['@babel/preset-env', {targets: '> 1%, cover 95%, not dead'}]],
            }),
            terser(),
        ],
    },
];

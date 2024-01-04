import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./vendor/laravel-views/**/*.php"
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
        colors: {
            'primary': '#262A4E',
            'secondary': '#383E6E',
            'white': '#fff',
            'black': '#000',
            'yellow': '#F5BB3D',
            'blue': '#3E9FFF',
            'green': '#26C8BC',
            'red': '#f43f5e',
            'slate': '#94a3b8'
        }
    },

    plugins: [forms],
};

import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'pale-pink': {
                    50: '#fff0f5', // lighter tint
                    100: '#FDB5CE', // User light pink
                    200: '#FDC3A1', // User peach
                    300: '#FFA6A6', // User soft pinkish red
                    400: '#F39EB6', // User mauve pink
                    500: '#F57799', // User vibrant pink (main)
                    600: '#DE5D80', // Darker shade 1
                    700: '#BE4464', // Darker shade 2
                    800: '#9E324D', // Darker shade 3
                    900: '#85253E', // Darker shade 4
                    950: '#4A1020', // Darkest
                },
            },
        },
    },

    plugins: [forms],
};

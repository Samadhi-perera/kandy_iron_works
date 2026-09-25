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
                sans: ['Plus Jakarta Sans', 'Inter', ...defaultTheme.fontFamily.sans],
                display: ['Plus Jakarta Sans', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                iron: {
                    950: '#070a0f',
                    900: '#0b1017',
                    850: '#111722',
                    800: '#17202f',
                    750: '#1e293b',
                    700: '#263447',
                    600: '#3b4d66',
                    500: '#64748b',
                },
                amber: {
                    50: '#fffbeb',
                    100: '#fef3c7',
                    200: '#fde68a',
                    300: '#fcd34d',
                    400: '#fbbf24',
                    500: '#f59e0b',
                    600: '#d97706',
                    700: '#b45309',
                    800: '#92400e',
                    900: '#78350f',
                },
            },
            boxShadow: {
                'glow': '0 0 25px -5px rgba(245, 158, 11, 0.3)',
                'glow-lg': '0 0 40px -10px rgba(245, 158, 11, 0.4)',
                'steel': '0 10px 30px -10px rgba(0, 0, 0, 0.7)',
            },
        },
    },

    plugins: [forms],
};

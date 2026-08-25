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
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    DEFAULT: '#005bbf',
                    container: '#1a73e8',
                    fixed: '#d8e2ff',
                },
                secondary: {
                    DEFAULT: '#515f74',
                    container: '#d5e3fc',
                },
                surface: {
                    DEFAULT: '#f7f9fb',
                    container: '#eceef0',
                    variant: '#e0e3e5',
                },
                gray: {
                    50: '#F8FAFC',
                    100: '#F1F5F9',
                    200: '#E2E8F0',
                    300: '#CBD5E1',
                    400: '#94A3B8',
                    500: '#64748B',
                    600: '#475569',
                    700: '#334155',
                    800: '#1E293B',
                    900: '#0F172A',
                }
            },
        },
    },

    plugins: [forms],
};

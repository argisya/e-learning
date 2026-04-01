import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    50: '#f0f4ff',
                    100: '#e0eaff',
                    200: '#c7d7fe',
                    300: '#a4bcfd',
                    400: '#8098f9',
                    500: '#667eea',
                    600: '#5a67d8',
                    700: '#4c51bf',
                    800: '#434190',
                    900: '#3c366b',
                },
                secondary: {
                    500: '#764ba2',
                    600: '#6b3a8f',
                }
            },
            maxWidth: {
                'content': '650px',
            }
        }
    },
    plugins: [],
}
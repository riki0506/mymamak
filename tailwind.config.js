const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
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
                success: '#00C853', // Replace with your desired color for liked (green)
                secondary: '#B0B0B0', // Replace with your desired color for unliked (grey)
            }
        },
    },

    plugins: [require('@tailwindcss/forms')],
};

const defaultTheme = require('tailwindcss/defaultTheme');


/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    '50': '#dcebeb', // text-gray-700
                    '200': '#8ebaba', // text-gray-700
                    '500': '#4b7c7f', // text-wite
                    '900': '#325053', // text-wite
                },
                secondary: {
                    '50': '#cacbac',
                    '500': '#d8ad3e',
                    '900': '#ca7d04',
                },
            }
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'), 
    ],
};

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
                antiqua: ['Glass Antiqua']
            },
            colors: {
                primary: {
                    '200': '#EBD5C4', 
                    '500': '#D8AD3E', 
                    '900': '#CA7D04',
                },
                secondary: {
                    '500': '#4b7c7f',
                }
            }
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'), 
    ],
};

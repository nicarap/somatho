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
                    50:'#f2f9fd',
                    100:'#e3f1fb',
                    200:'#c2e5f5',
                    300:'#8bcfee',
                    400:'#52b8e3',
                    500:'#279ed0',
                    600:'#187fb1',
                    700:'#15658f',
                    800:'#155677',
                    900:'#174863',
                    950:'#0f2f42'
                },
                secondary: {
                    200:'#ffcefd',
                    300:'#ffa7f7',
                    400:'#ff73f2',
                    500:'#f83de7',
                    600:'#e11ecb',
                    700:'#b615a0',
                    800:'#951382',
                    900:'#7a156a'
                },
                ternary: {
                    200:'#f1f89e',
                    300:'#e3f165',
                    400:'#cbe11e',
                    500:'#b3ca18',
                    600:'#8ca20e',
                    700:'#697b10',
                    800:'#546113',
                    900:'#465215'
                },
            }
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'), 
    ],
};

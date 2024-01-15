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
                // #4b7c7f foncé
                // #6f999f moins foncé
                // #9abbc1 moins moins foncé
                // #afd4db clair
                // #d8ad3e jaune
                // #cacbac marron clair
                primary: {
                    '50': '#afd4db',
                    '200': '#9abbc1',
                    '500': '#6f999f',
                    '900': '#4b7c7f',
                },
                secondary: {
                    '50': '#cacbac',
                    '500': '#d8ad3e',
                },
            }
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'), 
    ],
};

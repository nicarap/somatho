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
                    // 50: '#F7F4ED',
                    // 100: '#EFE9DB',
                    // 200: '#DFD2B8',
                    // 300: '#CFBC94',
                    // 400: '#BFA570',
                    // 500: '#AF8F4C',
                    // 600: '#8C723D',
                    // 700: '#69562D',
                    // 800: '#46391E',
                    // 900: '#231D0F',
                    // 950: '#121006',
                    '50':  '#f9f4ef',
                    '100': '#f3e8dc',
                    '200': '#EBD5C4',  // Ton 200
                    '300': '#e1be9c',
                    '400': '#dcb471',
                    '500': '#D8AD3E',  // Ton 500
                    '600': '#c79732',
                    '700': '#b17f25',
                    '800': '#9c6617',
                    '900': '#A66807',  // Ton 900
                },
                secondary: {
                    '500': '#4b7c7f',
                }
            },
            animation: {
                'fade-in': 'fadeIn 0.5s ease-in-out',
                'slide-up': 'slideUp 0.5s ease-in-out',
                'slide-down': 'slideDown 0.5s ease-in-out',
                'pulse-slow': 'pulse 3s infinite',
            },
            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                slideUp: {
                    '0%': { transform: 'translateY(20px)', opacity: '0' },
                    '100%': { transform: 'translateY(0)', opacity: '1' },
                },
                slideDown: {
                    '0%': { transform: 'translateY(-20px)', opacity: '0' },
                    '100%': { transform: 'translateY(0)', opacity: '1' },
                },
            },
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'), 
    ],
};

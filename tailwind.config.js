const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary:{
                    100 : '#B4CFFA',
                    600 : '#74A3F1',
                    700 : '#6476E6',
                    800 : '#1C2F57',
                    900 : '#11213A'
                },
                secondary:{
                    700 : '#F67D48',
                    800 : '#EB5E1D',
                    900 : '#F67D48'
                }
            }
        },
    },

    plugins: [require('@tailwindcss/forms')],
};

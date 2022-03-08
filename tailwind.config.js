const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    
    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            typography: {
                DEFAULT: {
                    css: {
                        a: {
                            color: '#6366f1',
                            '&:hover': {
                                color: '#4338ca',
                            },
                            textDecoration: 'none'
                        },
                        blockquote: {
                            'p::before': {
                                content: 'unset',
                            },
                            'p::after': {
                                content: 'unset',
                            },
                        }
                    },
                },
            },
        },
    },
    
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography')
    ],
};

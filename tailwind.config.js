const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./resources/**/*.vue",
    ],
    
      theme: {
          screens: {
            'sm': '576px',
            // => @media (min-width: 576px) { ... }
    
            'md': '768px',
            // => @media (min-width: 768px) { ... }
    
            'lg': '1024px',
            // => @media (min-width: 1024px) { ... }
    
            'xl': '1366px',
            // => @media (min-width: 1440px) { ... }
    
            'xxl': '1680px',
            // => @media (min-width: 1680px) { ... }
    
            'xxxl': '1920px',
            // => @media (min-width: 1920px) { ... }
          },
    
        extend: {
            fontFamily: {
                public_sans: ['Public Sans', 'sans-serif'],
            },
            colors: {
                'purple': '#490B3d',
                'pink' : '#BD1E51',
                'yellow' : '#F1B814',
            }
        },
      },
      plugins: [],
};

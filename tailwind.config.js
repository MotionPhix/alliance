const defaultTheme = require('tailwindcss/defaultTheme')

/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'class',

  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],

  corePlugins: {
    aspectRatio: false,
  },

  theme: {
    extend: {
      fontFamily: {
        poppins: ['Poppins', ...defaultTheme.fontFamily.sans],
        display: ['DM Serif Display', 'serif'],
      },
      colors: {
        'ca-blue': '#1E3A8A',
        'ca-purple': '#6D28D9',
        'ca-red': '#DC2626',
        'ca-amber': '#F59E0B',
        'ca-green': '#10B981',
        'ca-primary': '#4F46E5',
        'ca-secondary': '#2D3748',
        'ca-highlight': '#4338CA',
        'ca-success': '#48BB78'
      },
      typography: (theme) => ({
        DEFAULT: {
          css: {
            color: theme('colors.gray.700'),
            maxWidth: 'none',
            a: {
              color: theme('colors.ca-primary'),
              '&:hover': {
                color: theme('colors.ca-highlight'),
              },
            },
          },
        },

        dark: {
          css: {
            color: theme('colors.gray.300'),
            a: {
              color: theme('colors.ca-primary'),
              '&:hover': {
                color: theme('colors.ca-highlight'),
              },
            },
          },
        },
      }),
      scale: {
        '102': '1.02',
      },
      animation: {
        'fade-in': 'fadeIn 1s ease-in forwards',
        'fade-in-delay': 'fadeIn 1s ease-in 0.5s forwards',
      },
      boxShadow: {
        'card': '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)',
        'card-hover': '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)'
      },
      keyframes: {
        fadeIn: {
          '0%': {
            opacity: '0',
            transform: 'translateY(20px)',
          },
          '100%': {
            opacity: '1',
            transform: 'translateY(0)',
          },
        },
      },
    },
  },

  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
    require('@tailwindcss/aspect-ratio'),
    require('@tailwindcss/line-clamp'),
  ],
}


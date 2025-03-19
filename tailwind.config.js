const defaultTheme = require('tailwindcss/defaultTheme')

/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'class',

  content: [
    "./resources/**/*.blade.php",
    "./vendor/filament/**/*.blade.php",
    "./resources/js/**/*.{js,ts,tsx,vue}",
    "./vendor/awcodes/filament-tiptap-editor/resources/**/*.blade.php",
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
        'ca-success': '#48BB78',
        'primary': {
          50: '#fdf4e7',
          100: '#fbe8cf',
          200: '#f7d19f',
          300: '#f3ba6f',
          400: '#efa33f',
          500: '#eb8c0f',
          600: '#bc700c',
          700: '#8d5409',
          800: '#5e3806',
          900: '#2f1c03',
          950: '#180e02',
        },
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
        'fade-in': 'fadeIn 0.5s ease-in-out',
        'scroll': 'scroll 40s linear infinite',
      },
      boxShadow: {
        'card': '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)',
        'card-hover': '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)'
      },
      keyframes: {
        scroll: {
          '0%': { transform: 'translateX(0)' },
          '100%': { transform: 'translateX(-100%)' },
        },

        fadeIn: {
          '0%': { opacity: '0', transform: 'translateY(10px)' },
          '100%': { opacity: '1', transform: 'translateY(0)' },
        },
      },
    },
  },

  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
    require('@tailwindcss/aspect-ratio'),
  ],
}


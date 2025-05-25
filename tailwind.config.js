/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          50: 'rgb(236, 253, 245)',
          100: 'rgb(209, 250, 229)',
          200: 'rgb(167, 243, 208)',
          300: 'rgb(129, 231, 175)',
          400: 'rgb(129, 231, 175)',
          500: 'rgb(16, 185, 129)',
          600: 'rgb(5, 150, 105)',
          700: 'rgb(4, 120, 87)',
          800: 'rgb(6, 95, 70)',
          900: 'rgb(6, 78, 59)',
          950: 'rgb(2, 44, 34)',
        },
      },
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms'),
  ],
} 
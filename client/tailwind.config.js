/** @type {import('tailwindcss').Config} */
export default {
  content: ['./index.html', './src/**/*.{js,jsx}'],
  theme: {
    extend: {
      colors: {
        // Indian Railway navy, carried over from the legacy design language.
        rail: {
          50: '#eef1fb',
          100: '#d5dbf4',
          200: '#aab7e5',
          300: '#7f8fd2',
          400: '#5467bf',
          500: '#2f45a8',
          600: '#1b2f8a',
          700: '#0f1f6b',
          800: '#0b1650',
          900: '#000066',
          950: '#040a33',
        },
      },
    },
  },
  plugins: [],
};

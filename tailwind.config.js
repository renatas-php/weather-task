/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      borderRadius: {
        'none': '0',
        'button': '35px',
      },
      lineHeight: {
        '60px': '60px',
      }
    },
  },
  plugins: [],
}


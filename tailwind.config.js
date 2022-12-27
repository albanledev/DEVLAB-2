/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "../landing.php",
    "./src/**/*.{html,php,js}"],
  theme: {
    extend: {
animation: {
        wiggle: 'wiggle 1s ease-in-out infinite',
      }
    },
  },
  plugins: [],
}
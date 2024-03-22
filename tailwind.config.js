/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
      ],
  theme: {
    extend: {
        fontFamily: {
        gund: ["IM Fell Great Primer SC", "serif"],
        // Add more custom font
      },},
  },
  plugins: [],
}


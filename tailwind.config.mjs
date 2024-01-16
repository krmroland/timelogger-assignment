/** @type {import('tailwindcss').Config} */

import colors from "./ui/utils/colors.js";

module.exports = {
  important: true,
  prefix: "tw-",
  content: ["./resources/**/*.blade.php", "./ui/**/*.{vue,js,ts,jsx,tsx}"],
  theme: { extend: { colors } },
  plugins: [],
};

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue'
  ],
  safelist: [
    // bg-*-100 and text-*-600 for budget colors
    'bg-rose-100','text-rose-600',
    'bg-emerald-100','text-emerald-600',
    'bg-gray-100','text-gray-600',
    'bg-blue-100','text-blue-600',
    'bg-indigo-100','text-indigo-600',
    'bg-amber-100','text-amber-600',
    'bg-teal-100','text-teal-600',
    'bg-violet-100','text-violet-600',
    'bg-pink-100','text-pink-600'
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

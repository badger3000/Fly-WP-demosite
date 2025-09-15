/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './**/*.php',
    './src/blocks/**/*.js',
    './src/blocks/**/*.jsx',
    './src/blocks/**/*.ts',
    './src/blocks/**/*.tsx',
    './src/blocks/**/*.scss',
    './src/js/**/*.js',
    './templates/**/*.html',
    './parts/**/*.html',
    './patterns/**/*.php',
    './blocks/**/*.js', // Include built blocks
  ],
  safelist: [
    // Safelist the classes we're using to ensure they're not purged
    'rounded-lg',
    'shadow-md',
    'text-blue-600',
    'hover:text-blue-800',
    'transition-colors',
    'duration-200',
    'p-4'
  ],
  theme: {
    extend: {
      // Extend Tailwind's default theme here
      colors: {
        // Custom colors that align with theme.json if needed
      },
      spacing: {
        // Custom spacing values if needed
      },
      fontFamily: {
        // Custom fonts if needed
      },
    },
  },
  plugins: [
    // Add Tailwind plugins here if needed
  ],
};
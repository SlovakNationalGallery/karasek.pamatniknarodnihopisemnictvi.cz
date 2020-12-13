module.exports = {
  purge: [
     './resources/**/*.blade.php',
     './resources/**/*.js',
     './resources/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    borderWidth: {
        DEFAULT: '1px',
        '0': '0',
        '0.5': '0.125rem',
        '1': '0.25rem',
        '1.5': '0.375rem',
        '2': '0.5rem',
        '2.5': '0.625rem',
        '3': '0.75rem',
        '3.5': '0.875rem',
        '4': '1rem',
    },
    fontSize: {
        'xs': ['0.75rem', 'inherit'],
        'sm': ['0.875rem', 'inherit'],
        'base': ['1rem', 'inherit'],
        'lg': ['1.125rem', 'inherit'],
        'xl': ['1.25rem', 'inherit'],
        '2xl': ['1.5rem', 'inherit'],
        '3xl': ['1.875rem', 'inherit'],
        '4xl': ['2.25rem', 'inherit'],
        '5xl': ['3rem', 'inherit'],
        '6xl': ['3.75rem', 'inherit'],
        '7xl': ['4.5rem', 'inherit'],
        '8xl': ['6rem', 'inherit'],
        '9xl': ['8rem', 'inherit'],
    },
    extend: {
        fontFamily: {
            'display': ['Ayer Web Medium', 'serif'],
            'serif': ['Ermina', 'serif'],
        },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}

/** @type {import('tailwindcss').Config} config */
const config = {
	content: ['./app/**/*.php', './resources/**/*.{php,vue,js}'],
	theme: {
		extend: {
			colors: {}, // Extend Tailwind's default colors
			fontFamily: {
				roboto: 'Roboto, sans-serif',
				poppins: 'Poppins, sans-serif',
			}, // Extend Tailwind's default font families
		},
	},
	plugins: [],
};

export default config;

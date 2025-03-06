/** @type {import('tailwindcss').Config} config */
const config = {
	content: ['./app/**/*.php', './resources/**/*.{php,vue,js}'],
	theme: {
		// extend: {
		colors: {
			white: '#ffffff',
			black: '#000000',
			purple: {
				50: '#f5f0ff',
				100: '#e6d4ff',
				200: '#d3b8ff',
				300: '#c598ff',
				400: '#b277ff',
				500: '#9245ff',
				600: '#7a1aff',
				700: '#6710e6',
				800: '#5808c2',
				900: '#4c05a6',
			},
		}, // Extend Tailwind's default colors
		fontFamily: {
			roboto: 'Roboto, sans-serif',
			poppins: 'Poppins, sans-serif',
		}, // Extend Tailwind's default font families
		// },
	},
	plugins: [],
};

export default config;

// tailwind.config.js
module.exports = {
    theme: {
      	fontFamily: {
    		'sans': ['Roboto', 'sans-serif'],
    		'header': ['Raleway', 'sans-serif'],
     	},
    	inset: {
    		'0': '0',
    		'1/2': '50%',
    		'auto': 'auto',
    	},
    	extend: {
            colors: {
                'orbost-red': '#BF0B3B',
                'orbost-blue': '#35428C',
            },
            spacing: {
	       		'9': '2.25rem',
                '13': '3.25rem',
                '21': '5.25rem',
                '22': '5.5rem',
	       	},
	       	translate: {
	       		'1/2': '50%'
	       	}
	    },
    }
}
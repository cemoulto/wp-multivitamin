module.exports = function(grunt) {

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		clean: {
			css: {
				styles: ['assets/css/styles.css', 'assets/css/styles.min.css', 'assets/css/styles.css.map'],
				vendors: ['assets/css/vendors.css', 'assets/css/vendors.min.css', 'assets/css/vendors.css.map']
			},
			js: {
				scripts: ['assets/js/scripts.js', 'assets/js/scripts.min.js'],
				vendors: ['assets/js/vendors.js', 'assets/js/vendors.min.js']
			}
		},

		concat: {
			options: {
				separator: ';',
			},
			scripts: {
				src: ['assets/js/scripts/*.js'],
				dest: 'assets/js/scripts.js'
			},
			vendors: {
				src: ['assets/js/vendors/*.js'],
				dest: 'assets/js/vendors.js'
			},
		},

		uglify: {
			scripts: {
				src: 'assets/js/scripts.js',
				dest: 'assets/js/scripts.min.js'
			},
			vendors: {
				src: 'assets/js/vendors.js',
				dest: 'assets/js/vendors.min.js'
			}
		},

		sass: {
			styles: {
				options: {
					style: 'expanded'
				},
				files: {
					'assets/css/styles.css': 'assets/css/styles/styles.scss'
				}
			},
			vendors: {
				options: {
					style: 'expanded'
				},
				files: {
					'assets/css/vendors.css': 'assets/css/vendors/vendors.scss'
				}
			}
		},

		autoprefixer: {
			options: {
				browsers: ['last 2 version', 'ie 8', 'ie 9']
			},
			no_dest: {
				src: 'assets/css/styles.css'
			}
		},

		cssmin: {
			styles: {
				expand: true,
				cwd: 'assets/css',
				src: ['styles.css'],
				dest: 'assets/css',
				ext: '.min.css'
			},
			vendors: {
				expand: true,
				cwd: 'assets/css',
				src: ['vendors.css'],
				dest: 'assets/css',
				ext: '.min.css'
			}
		},

		watch: {
			js_scripts: {
				files: 'assets/js/scripts/**/*.js',
				tasks: 'dist-js-styles'
			},
			js_vendors: {
				files: 'assets/js/vendors/**/*.js',
				tasks: 'dist-js-vendors'
			},
			css_styles: {
				files: 'assets/css/styles/**/*.scss',
				tasks: 'dist-css-styles',
				options: {
					livereload: true,
				}
			},
			js_vendors: {
				files: 'assets/css/vendors/**/*.scss',
				tasks: 'dist-css-vendors',
				options: {
					livereload: true,
				}
			}
		}

	});

	// These plugins provide necessary tasks
	grunt.loadNpmTasks('grunt-autoprefixer');
	grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-csslint');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');

	// JS distribution task
	grunt.registerTask('dist-js', ['dist-js-scripts', 'dist-js-vendors']);

	// JS Scripts distribution task
	grunt.registerTask('dist-js-scripts', ['clean:js:scripts', 'concat:scripts', 'uglify:scripts']);

	// JS Vendors distribution task
	grunt.registerTask('dist-js-vendors', ['clean:js:vendors', 'concat:vendors', 'uglify:vendors']);

	// CSS distribution task
	grunt.registerTask('dist-css', ['dist-css-styles', 'dist-css-vendors']);

	// CSS Styles distribution task
	grunt.registerTask('dist-css-styles', ['clean:css:styles', 'sass:styles', 'autoprefixer', 'cssmin:styles']);

	// CSS Vendors distribution task
	grunt.registerTask('dist-css-vendors', ['clean:css:vendors', 'sass:vendors', 'cssmin:vendors']);

	// Full distribution task
	grunt.registerTask('dist', ['dist-css', 'dist-js']);

	// Default task
	grunt.registerTask('default', ['dist', 'watch']);

};

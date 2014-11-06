module.exports = function(grunt) {

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		clean: {
			styles: ['assets/css/*.css'],
			scripts: ['assets/js/*.js']
		},

		concat: {
			options: {
				separator: ';',
			},
			dist: {
				src: ['assets/js/src/plugins/*.js', 'js/src/*.js'],
				dest: 'assets/js/scripts.js'
			}
		},

		uglify: {
			build: {
				src: 'assets/js/scripts.js',
				dest: 'assets/js/scripts.min.js'
			}
		},

		sass: {
			dist: {
				options: {
					style: 'expanded',
					banner: '/*\n' +
							'Theme Name: <%= pkg.name %>\n' +
							'Theme URI: <%= pkg.website %>\n' +
							'Description: <%= pkg.description %>\n' +
							'Version: <%= pkg.version %>\n' +
							'Author: <%= pkg.author %>\n' +
							'*/'
				},
				files: {
					'assets/css/styles.css': 'assets/css/src/vitamins.scss'
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
			options: {
				banner: '/*\n' +
						'Theme Name: <%= pkg.name %>\n' +
						'Theme URI: <%= pkg.website %>\n' +
						'Description: <%= pkg.description %>\n' +
						'Version: <%= pkg.version %>\n' +
						'Author: <%= pkg.author %>\n' +
						'*/'
			},
			minify: {
				expand: true,
				cwd: 'css',
				src: ['styles.css'],
				dest: 'css',
				ext: '.min.css'
			}
		},

		copy: {
			styles: {
				src: 'assets/css/styles.min.css',
				dest: 'style.css'
			},
		},

		watch: {
			scripts: {
				files: 'assets/js/**/*.js',
				tasks: ['clean:scripts', 'dist-js']
			},
			styles: {
				files: 'assets/css/**/*.scss',
				tasks: ['clean:styles', 'dist-css'],
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
	grunt.registerTask('dist-js', ['clean:scripts', 'concat', 'uglify']);

	// CSS distribution task
	grunt.registerTask('dist-css', ['clean:styles', 'sass', 'autoprefixer', 'cssmin', 'copy:styles']);

	// Full distribution task
	grunt.registerTask('dist', ['dist-css', 'dist-js']);

	// Default task
	grunt.registerTask('default', ['dist', 'watch']);

};

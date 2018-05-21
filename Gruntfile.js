// My App Gruntfile
module.exports = function (grunt) {
  'use strict'

  grunt.initConfig({
    pkg   : grunt.file.readJSON('package.json'),
    
	watch : {
      less : {        
        files: ['assets/src/less/*.less'],
        tasks: ['less:development', 'less:production','notify:less']
      },
      js   : {
        files: ['assets/src/js/*.js'],
        tasks: ['js', 'notify:js']
      },
	  sass : {        
        files: ['assets/src/sass/*.scss'],
        tasks: ['sass','notify:sass']
      },
    },    
	
    notify: {
      less: {
        options: {
          title  : 'My App',
          message: 'Ok. LESS done'
        }
      },
	  sass: {
        options: {
          title  : 'My App',
          message: 'Ok. SASS done'
        }
      },
      js  : {
        options: {
          title  : 'My App',
          message: 'Ok. JS done'
        }
      },
	  svgcss  : {
        options: {
          title  : 'My App',
          message: 'Ok. SVG to CSS done'
        }
      }
    },	
	
	svgcss: {
		toCrlf: {
		  options: {
			eol: 'crlf',
			cssprefix: 'glyphicon-',
			previewhtml: 'svg-icon-test.html'
		  },
		  files: {
			'assets/dist/svg_css/svg_styles.css': ['assets/src/svg/*.svg']
		  }
		}
	},	
    
    less  : {      
      development  : {
        files: {
          'assets/dist/css/styles.css' : 'assets/src/less/styles.less'          
        }
      },
	  production   : {
        options: {
          compress: true
        },
        files  : {
          'assets/dist/css/styles.min.css' : 'assets/src/less/styles.less'          
        }
      }
    },
	
	copy: {
	  main: {
		expand: true,
		cwd: 'assets/src/js2/',
		src: '**',
		dest: 'assets/dist/js/',
		flatten: true,
		filter: 'isFile',
	  },
	},
	
    uglify: {
      options   : {
        mangle          : true,
        preserveComments: 'some'
      },
      production: {
        files: {
          'assets/dist/js/app.min.js': ['assets/src/js/app.js'],
          'assets/dist/js/chat_app.min.js': ['assets/src/js/chat_app.js'],
          'assets/dist/js/ajax.min.js': ['assets/src/js/ajax.js'],
        }
      }
    },

    concat: {
      options: {
        separator: '\n\n',
        banner   : '/*! My App app.js\n'
        + '* ================\n'
        + '* Main JS application file for My App v2. This file\n'
        + '* should be included in all pages. It controls some layout\n'
        + '* options and implements exclusive My App plugins.\n'
        + '*\n'
        + '* @Author  Saikat Mahapatra\n'
        + '* @Support \n'
        + '* @Email   <>\n'
        + '* @version <%= pkg.version %>\n'
        + '* @repository <%= pkg.repository.url %>\n'
        + '* @license MIT <http://opensource.org/licenses/MIT>\n'
        + '*/\n\n'
        + '// Make sure jQuery has been loaded\n'
        + 'if (typeof jQuery === \'undefined\') {\n'
        + 'throw new Error(\'My App requires jQuery\')\n'
        + '}\n\n'
      },
      dist   : {
        src : ['assets/src/js/app.js'],
        dest: 'assets/dist/js/app.js'
      }
    },

    
    /*replace: {
      withoutPlugins   : {
        src         : ['assets/dist/css/alt/My App-without-plugins.css'],
        dest        : 'assets/dist/css/alt/My App-without-plugins.css',
        replacements: [
          {
            from: '../img',
            to  : '../../img'
          }
        ]
      },
      withoutPluginsMin: {
        src         : ['assets/dist/css/alt/My App-without-plugins.min.css'],
        dest        : 'assets/dist/css/alt/My App-without-plugins.min.css',
        replacements: [
          {
            from: '../img',
            to  : '../../img'
          }
        ]
      }
    },
	
	includes: {
      build: {
        src    : ['*.html'], // Source files
        dest   : 'documentation/', // Destination directory
        flatten: true,
        cwd    : 'documentation/build',
        options: {
          silent     : true,
          includePath: 'documentation/build/include'
        }
      }
    },*/

    image: {
      dynamic: {
        files: [
          {
            expand: true,
            cwd   : 'assets/src/img/',
            src   : ['**/*.{png,jpg,gif,svg,jpeg}'],
            dest  : 'assets/dist/img/'
          }
        ]
      }
    },

    // Validate JS code
    jshint: {
      options: {
        jshintrc: 'assets/src/js/.jshintrc'
      },
      grunt  : {
        options: {
          jshintrc: 'assets/src/grunt/.jshintrc'
        },
        src    : 'Gruntfile.js'
      },
      core   : {
        src: 'assets/src/js/*.js'
      }      
    },

    jscs: {
      options: {
        config: 'assets/src/js/.jscsrc'
      },
      core   : {
        src: '<%= jshint.core.src %>'
      }
    },

    // Validate CSS files
    csslint: {
      options: {
        csslintrc: 'assets/src/less/.csslintrc'
      },
      dist   : [
        'assets/dist/css/styles.css'
      ]
    },

    // Validate Bootstrap HTML
    //bootlint: {
      //options: {
        //relaxerror: ['W005']
      //},
      //files  : ['pages/**/*.html', '*.html']
   // },

    // Delete images in build directory
    // After compressing the images in the build/img dir, there is no need
    // for them
    clean: {
      build: ['assets/src/img/*']
    },
	
	// SASS to CSS
	sass: {
		dist: {
			options: {
				outputStyle: 'expanded',
				sourceMap: false
			},
			files: [{
				expand: true,
				cwd: 'assets/src/sass/',
				src: ['*.scss'],
				dest: 'assets/dist/css_from_sass/',
				ext: '.css'
			}]
		}
	},
	
	// Post Compilation of CSS
	postcss: {
		options: {
			map: false,
			processors: [
				require('autoprefixer')({browsers: 'last 3 versions'})
			]
		},
		dist: {
			src: ['assets/dist/css_from_sass/*.css']
		}
	}
	
  })

  // Load all grunt tasks modules  
  grunt.loadNpmTasks('grunt-contrib-less');// LESS Compiler  
  grunt.loadNpmTasks('grunt-contrib-watch'); // Watch File Changes  
  grunt.loadNpmTasks('grunt-contrib-uglify');// Compress JS Files  
  grunt.loadNpmTasks('grunt-includes');// Include Files Within HTML   
  grunt.loadNpmTasks('grunt-image'); // Optimize images  
  grunt.loadNpmTasks('grunt-contrib-jshint'); // Validate JS code
  grunt.loadNpmTasks('grunt-jscs');  
  grunt.loadNpmTasks('grunt-contrib-clean'); // Delete not needed files  
  grunt.loadNpmTasks('grunt-contrib-csslint'); // Lint CSS  
  grunt.loadNpmTasks('grunt-bootlint'); // Lint Bootstrap  
  grunt.loadNpmTasks('grunt-contrib-concat'); // Concatenate JS files  
  grunt.loadNpmTasks('grunt-notify'); // Notify  
  grunt.loadNpmTasks('grunt-text-replace'); // Replace  
  grunt.loadNpmTasks('grunt-contrib-copy'); // Copy  
  grunt.loadNpmTasks('grunt-svg-css'); // SVG to CSS Content
  grunt.loadNpmTasks('grunt-sass'); //SASS
  grunt.loadNpmTasks('grunt-postcss'); // Post compilation of CSS
  
  // Tasks
  grunt.registerTask('lint', ['jshint', 'csslint', 'bootlint']); // Linting task    
  grunt.registerTask('js', ['copy', 'concat', 'uglify']); // JS task  
  grunt.registerTask('css', ['less:development', 'less:production', 'sass','postcss']);  // CSS Tasks LESS-CSS, SASS-CSS  
  grunt.registerTask('default', ['watch']); // The default task (running 'grunt' in console) is 'watch'
  
}
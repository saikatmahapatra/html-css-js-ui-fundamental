module.exports = function(grunt) {
    'use strict'
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        watch: {
            // less : {        
            // files: ['assets/src/less/**/*.less'],
            // tasks: ['less:development', 'less:production','notify:less']
            // },
            js: {
                files: ['assets/src/js/**/*.js'],
                tasks: ['js', 'notify:js']
            },
            sass: {
                files: ['assets/src/sass/**/*.scss'],
                tasks: ['sass', 'notify:sass']
            },
        },

        notify: {
            less: {
                options: {
                    title: 'My App',
                    message: 'Ok. LESS done'
                }
            },
            sass: {
                options: {
                    title: 'My App',
                    message: 'Ok. SASS done'
                }
            },
            js: {
                options: {
                    title: 'My App',
                    message: 'Ok. JS done'
                }
            },
            svgcss: {
                options: {
                    title: 'My App',
                    message: 'Ok. SVG to CSS done'
                }
            }
        },

        svgcss: {
            toCrlf: {
                options: {
                    eol: 'crlf',
                    cssprefix: 'sm-icon',
                    previewhtml: 'svg-icon-test.html'
                },
                files: {
                    'assets/dist/css/svg_to_css.css': ['assets/src/img/**/*.svg']
                }
            }
        },

        less: {
            development: {
                files: {
                    'assets/dist/css/styles.css': 'assets/src/less/styles.less'
                }
            },
            production: {
                options: {
                    compress: true
                },
                files: {
                    'assets/dist/css/styles.min.css': 'assets/src/less/styles.less'
                }
            }
        },

        copy: {
            main: {
                expand: true,
                cwd: 'assets/src/js/',
                src: '**',
                dest: 'assets/dist/js/',
                flatten: true,
                filter: 'isFile',
            },
        },

        uglify: {
            options: {
                mangle: true,
                preserveComments: 'some'
            },
            production: {
                files: [{
                    expand: true,
                    cwd: 'assets/src/js',
                    src: '**/*.js',
                    dest: 'assets/dist/js',
                    ext: '.min.js'
                }]
            }
        },

        concat: {
            options: {
                separator: '\n\n',
                banner: '/*! \n' +
                    '* ================\n' +
                    '* Main JS file of the application having common functions\n' +
                    '*\n' +
                    '* @Author <%= pkg.author %>\n' +
                    '* @version <%= pkg.version %>\n' +
                    '* @repository <%= pkg.repository.url %>\n' +
                    '* @license <%= pkg.license %>\n' +
                    '*/\n\n'
            },
            dist: {
                src: ['assets/src/js/app.js'],
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
                files: [{
                    expand: true,
                    cwd: 'assets/src/img/',
                    src: ['**/*.{png,jpg,gif,svg,jpeg}'],
                    dest: 'assets/dist/img/'
                }]
            }
        },

        jshint: {
            options: {
                jshintrc: 'assets/src/js/.jshintrc'
            },
            grunt: {
                options: {
                    jshintrc: 'assets/src/grunt/.jshintrc'
                },
                src: 'Gruntfile.js'
            },
            core: {
                src: 'assets/src/js/*.js'
            }
        },

        jscs: {
            options: {
                config: 'assets/src/js/.jscsrc'
            },
            core: {
                src: '<%= jshint.core.src %>'
            }
        },

        csslint: {
            options: {
                csslintrc: 'assets/src/less/.csslintrc'
            },
            dist: [
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

        clean: {
            build: ['assets/src/img/*']
        },

        sass: {
            dist: {
                options: {
                    outputStyle: 'expanded',
                    sourceMap: false
                },
                files: [{
                    expand: true,
                    cwd: 'assets/src/sass/',
                    src: ['**/*.scss'],
                    dest: 'assets/dist/css/',
                    ext: '.css'
                }]
            }
        },

        postcss: {
            options: {
                map: false,
                processors: [
                    require('autoprefixer')({ browsers: 'last 3 versions' })
                ]
            },
            dist: {
                src: ['assets/dist/css/**/*.css']
            }
        },

        cssmin: {
            target: {
                files: [{
                    expand: true,
                    cwd: 'assets/dist/css',
                    src: ['**/*.css', '!*.min.css'],
                    dest: 'assets/dist/css',
                    ext: '.min.css'
                }]
            }
        }

    });

    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-includes');
    grunt.loadNpmTasks('grunt-image');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-jscs');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-csslint');
    grunt.loadNpmTasks('grunt-bootlint');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-notify');
    grunt.loadNpmTasks('grunt-text-replace');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-svg-css');
    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-postcss');
    grunt.loadNpmTasks('grunt-contrib-cssmin');

    grunt.registerTask('lint', ['jshint', 'csslint', 'bootlint']);
    grunt.registerTask('img', ['image']);
    grunt.registerTask('js', ['copy', 'concat', 'uglify']);
    grunt.registerTask('css', ['less:development', 'less:production', 'sass', 'postcss', 'cssmin']);
    grunt.registerTask('default', ['watch']);

}
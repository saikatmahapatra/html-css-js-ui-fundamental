// SampleWebApp Gruntfile
module.exports = function (grunt) { // jshint ignore:line
  'use strict'

  grunt.initConfig({
    pkg   : grunt.file.readJSON('package.json'),
    watch : {
      less : {
        // Compiles less files upon saving
        files: ['assets/build/less/*.less'],
        tasks: ['less:development', 'less:production','notify:less']
      },
      js   : {
        // Compile js files upon saving
        files: ['assets/build/js/*.js'],
        tasks: ['js', 'notify:js']
      }
    },
    // Notify end of tasks
    notify: {
      less: {
        options: {
          title  : 'SampleWebApp',
          message: 'LESS finished running'
        }
      },
      js  : {
        options: {
          title  : 'SampleWebApp',
          message: 'JS bundler finished running'
        }
      }
    },
    // 'less'-task configuration
    // This task will compile all less files upon saving to create both SampleWebApp.css and SampleWebApp.min.css
    less  : {
      // Development not compressed
      development  : {
        files: {
          // compilation.css  :  source.less
          'assets/dist/css/styles.css' : 'assets/build/less/styles.less'          
        }
      },
      // Production compressed version
      production   : {
        options: {
          compress: true
        },
        files  : {
          // compilation.css  :  source.less
          'assets/dist/css/styles.min.css' : 'assets/build/less/styles.less'          
        }
      }
    },

    // Uglify task info. Compress the js files.
    uglify: {
      options   : {
        mangle          : true,
        preserveComments: 'some'
      },
      production: {
        files: {
          'assets/dist/js/app.min.js': ['assets/build/js/app.js']
        }
      }
    },

    // Concatenate JS Files
    concat: {
      options: {
        separator: '\n\n',
        banner   : '/*! SampleWebApp app.js\n'
        + '* ================\n'
        + '* Main JS application file for SampleWebApp v2. This file\n'
        + '* should be included in all pages. It controls some layout\n'
        + '* options and implements exclusive SampleWebApp plugins.\n'
        + '*\n'
        + '* @Author  Saikat Mahapatra\n'
        + '* @Support \n'
        + '* @Email   <mahapatra.saikat@gmail.com>\n'
        + '* @version <%= pkg.version %>\n'
        + '* @repository <%= pkg.repository.url %>\n'
        + '* @license MIT <http://opensource.org/licenses/MIT>\n'
        + '*/\n\n'
        + '// Make sure jQuery has been loaded\n'
        + 'if (typeof jQuery === \'undefined\') {\n'
        + 'throw new Error(\'SampleWebApp requires jQuery\')\n'
        + '}\n\n'
      },
      dist   : {
        src : ['assets/build/js/app.js'],
        dest: 'assets/dist/js/app.js'
      }
    },

    // Replace image paths in SampleWebApp without plugins
    /*replace: {
      withoutPlugins   : {
        src         : ['assets/dist/css/alt/SampleWebApp-without-plugins.css'],
        dest        : 'assets/dist/css/alt/SampleWebApp-without-plugins.css',
        replacements: [
          {
            from: '../img',
            to  : '../../img'
          }
        ]
      },
      withoutPluginsMin: {
        src         : ['assets/dist/css/alt/SampleWebApp-without-plugins.min.css'],
        dest        : 'assets/dist/css/alt/SampleWebApp-without-plugins.min.css',
        replacements: [
          {
            from: '../img',
            to  : '../../img'
          }
        ]
      }
    },*/

    // Build the documentation files
    /*includes: {
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

    // Optimize images
    image: {
      dynamic: {
        files: [
          {
            expand: true,
            cwd   : 'assets/build/img/',
            src   : ['**/*.{png,jpg,gif,svg,jpeg}'],
            dest  : 'assets/dist/img/'
          }
        ]
      }
    },

    // Validate JS code
    jshint: {
      options: {
        jshintrc: 'assets/build/js/.jshintrc'
      },
      grunt  : {
        options: {
          jshintrc: 'assets/build/grunt/.jshintrc'
        },
        src    : 'Gruntfile.js'
      },
      core   : {
        src: 'assets/build/js/*.js'
      }      
    },

    jscs: {
      options: {
        config: 'assets/build/js/.jscsrc'
      },
      core   : {
        src: '<%= jshint.core.src %>'
      }
    },

    // Validate CSS files
    csslint: {
      options: {
        csslintrc: 'assets/build/less/.csslintrc'
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
      build: ['assets/build/img/*']
    }
  })

  // Load all grunt tasks

  // LESS Compiler
  grunt.loadNpmTasks('grunt-contrib-less')
  // Watch File Changes
  grunt.loadNpmTasks('grunt-contrib-watch')
  // Compress JS Files
  grunt.loadNpmTasks('grunt-contrib-uglify')
  // Include Files Within HTML
  grunt.loadNpmTasks('grunt-includes')
  // Optimize images
  grunt.loadNpmTasks('grunt-image')
  // Validate JS code
  grunt.loadNpmTasks('grunt-contrib-jshint')
  grunt.loadNpmTasks('grunt-jscs')
  // Delete not needed files
  grunt.loadNpmTasks('grunt-contrib-clean')
  // Lint CSS
  grunt.loadNpmTasks('grunt-contrib-csslint')
  // Lint Bootstrap
  grunt.loadNpmTasks('grunt-bootlint')
  // Concatenate JS files
  grunt.loadNpmTasks('grunt-contrib-concat')
  // Notify
  grunt.loadNpmTasks('grunt-notify')
  // Replace
  grunt.loadNpmTasks('grunt-text-replace')

  // Linting task
  grunt.registerTask('lint', ['jshint', 'csslint', 'bootlint'])
  // JS task
  grunt.registerTask('js', ['concat', 'uglify'])
  // CSS Task
  grunt.registerTask('css', ['less:development', 'less:production', 'replace'])

  // The default task (running 'grunt' in console) is 'watch'
  grunt.registerTask('default', ['watch'])
}
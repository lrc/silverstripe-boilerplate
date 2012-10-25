/*
 * Setup options for grunt to work with.
 */
module.exports = function(grunt) {
  // Project configuration.
  grunt.initConfig({
    meta: {
      banner: '/*! Copyright (c) <%= grunt.template.today("yyyy") %> Left, Right & Centre */'
    },
    min: {
      main: {
        src: ['<banner>', 'javascript/src/main.js'],
        dest: 'javascript/build/main.js'
      },
	  forms: {
		  src: ['<banner>', 'javascript/src/jquery.validate.js'],
		  dest: 'javascript/build/forms.js'
	  }
    },
    watch: {
      files: 'javascript/src/*',
      tasks: 'min'
    },
	lint: {
		files: 'javascript/src/*'
	},
    uglify: {}
  });
};

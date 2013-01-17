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
      require: {
        src: ['<banner>', 'javascript/require-jquery.js'],
        dest: '../javascript/require-jquery.js'
      },
      main: {
        src: ['<banner>', 'javascript/main.js'],
        dest: '../javascript/main.js'
      },
	  forms: {
		  src: ['<banner>', 'javascript/jquery.validate.js'],
		  dest: '../javascript/forms.js'
	  }
    },
    watch: {
      files: 'javascript/*',
      tasks: 'min'
    },
	lint: {
		files: 'javascript/*'
	},
    uglify: {}
  });
};

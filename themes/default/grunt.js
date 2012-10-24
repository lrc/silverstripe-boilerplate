/*
 * Setup options for grunt to work with.
 */
module.exports = function(grunt) {
  // Project configuration.
  grunt.initConfig({
    meta: {
      banner: '/*! Copyright © <%= grunt.template.today("yyyy") %> Left, Right & Centre */'
    },
    min: {
      dist: {
        src: ['<banner>', 'javascript/src/main.js'],
        dest: 'javascript/build/main.js'
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

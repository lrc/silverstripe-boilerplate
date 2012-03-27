<?php

/**
 * Add some utility functions to the ContentController class to facilitate
 * output of Stack contents.
 */
class StackContentControllerDecorator extends Extension {
	
	/**
	 * Give templates a function to get JS stacks.
	 * @param string $stack The name of the stack to output as JS.
	 * @return string The HTML
	 */
	public function StackJS($stack) {
		return Stack::get( $stack, array('StackFormat', 'scripts') );
	}

	/**
	 * Give templates a function to get CSS stacks.
	 * @param string $stack The name of the stack to output as CSS.
	 * @return string The HTML
	 */
	public function StackCSS($stack) {
		return Stack::get( $stack, array('StackFormat', 'styles') );
	}
	
}
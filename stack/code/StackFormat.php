<?php
/**
 * A collection of formatting funcitons for the stack class.
 * 
 * @author Simon
 */
class StackFormat {
	

	/**
	 * A callback for Stack::get() that outputs scripts as reference or inline depending on their content
	 *
	 * @param string $element The script element in the stack
	 * @return string The resulting script tag
	 */
	public static function scripts( $element )
	{
		if ( self::is_url($element) && strpos( $element, "\n" ) === false ) {
			$output = sprintf( '<script src="%s" type="text/javascript"></script>'."\r\n", $element );
		}
		else {
			$output = sprintf( '<script type="text/javascript">%s</script>'."\r\n", $element );
		}
		return $output;
	}

	/**
	 * A callback for Stack::get() that outputs styles as link or inline style tags depending on their content
	 *
	 * @param string $element The style element in the stack
	 * @param string $typename The media disposition of the content
	 * @return string The resulting style or link tag
	 */
	public static function styles( $element, $typename )
	{
		if ( self::is_url($element) ) {
			$output = sprintf( '<link rel="stylesheet" type="text/css" href="%s" media="%s">'."\r\n", $element, $typename );
		}
		else {
			$output = sprintf( '<style type="text/css" media="%s">%s</style>'."\r\n", $typename, $element );
		}
		return $output;
	}
	
	public static function combine_styles (  ) {
		
	}
	
	/**
	 * Utility function to test if a given string looks like a URL.
	 * 
	 * @param string $url The string to test
	 * @return boolean ULR or not.
	 */
	private static function is_url( $url ) {
		return ( ( strpos( $url, 'http://' ) === 0 || strpos( $url, 'https://' ) === 0 || strpos( $url, '//' ) === 0 ) && strpos( $url, "\n" ) === false );
	}
}

?>

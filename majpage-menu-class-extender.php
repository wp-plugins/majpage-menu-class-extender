<?php
/*
Plugin Name: MAJpage Menu Class Extender
Description: Adds classes to first, last, parent, even and odd elements of wp_nav_menu to support recognizing it in older browsers without :first-child, :last-child and :nth-child supporting.
Author: Wiktor Maj
Version: 1.2
Author URI: http://majpage.com
*/

if( class_exists( 'SimpleXMLElement' ) ) {

 function majpage_mce( $output ) {
  libxml_use_internal_errors( false );
  try {
   $xml = new SimpleXMLElement( preg_replace( '#>([^<]+)<#i', '><![CDATA[\\1]]><', $output ), LIBXML_NOWARNING );
  }
  catch(Exception $e) {
   return $output;
  }
  if( $xml->li ) $item = $xml;
   else list( , $item ) = each( $xml->xpath( 'ul' ) );
  if( count( $item ) ) return preg_replace( '#<\?[^>]*\?>#', '<!-- Menu modified by MAJpage Menu Class Extender -->', preg_replace( '#<!\[CDATA\[([^<]+)\]\]>#', '\\1', majpage_mce_level( $item )->asXML() ) );
   else return $output;
 }

 function majpage_mce_level( $xml ) {
  if( 0 < $count = count( $xml->li ) ) {
   $i = 1;
   foreach( $xml->li as $item ) {
    $attributes = $item->attributes();
    if( $i % 2 ) $attributes['class'] = 'odd-menu-item ' . $attributes['class'];
     else $attributes['class'] = 'even-menu-item ' . $attributes['class'];
    if( $item->ul ) {
	 $attributes['class'] = 'parent-menu-item ' . $attributes['class'];
	 majpage_mce_level( $item->ul );
	}
    if( $i == $count ) $attributes['class'] = 'last-menu-item ' . $attributes['class'];
    if( $i == 1 ) $attributes['class'] = 'first-menu-item ' . $attributes['class'];
    $i ++;
   }
  }
  return $xml;
 }

 add_filter( 'wp_nav_menu', 'majpage_mce' );

}

?>
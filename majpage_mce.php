<?php
/*
Plugin Name: MAJpage Menu Class Extender
Description: Adds classes to first, last, even and odd elements of wp_nav_menu to support recognizing it in older browsers without :first-child, :last-child and :nth-child supporting.
Author: Wiktor Maj
Version: 1.0
Author URI: http://majpage.com
*/

if( class_exists( 'SimpleXMLElement' ) ) {

 function majpage_mce( $output ) {
  return preg_replace( '#<\?[^>]*\?>#', '', majpage_mce_level( new SimpleXMLElement( $output ) )->asXML() );
 }

 function majpage_mce_level( $xml ) {
  $i = 1;
  $count = count( $xml->li );
  foreach( $xml->li as $item ) {
   $attributes = $item->attributes();
   if( $i % 2 ) $attributes['class'] = 'odd-menu-item ' . $attributes['class'];
    else $attributes['class'] = 'even-menu-item ' . $attributes['class'];
   if( $i == $count ) $attributes['class'] = 'last-menu-item ' . $attributes['class'];
   if( $i == 1 ) $attributes['class'] = 'first-menu-item ' . $attributes['class'];
   if( $item->ul ) majpage_mce_level( $item->ul );
   $i ++;
  }
  return $xml;
 }

 add_filter( 'wp_nav_menu', 'majpage_mce' );

}

?>
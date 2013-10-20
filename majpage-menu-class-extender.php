<?php
/*
Plugin Name: MAJpage Menu Class Extender
Description: Adds classes to first, last, parent, even and odd elements of wp_nav_menu to support recognizing it in older browsers without :first-child, :last-child and :nth-child supporting.
Author: Wiktor Maj
Version: 1.3
Author URI: http://majpage.com
*/

class MAJpageMCE
{

 public static function add( $output )
 {
  $xmlInternalErrors = libxml_use_internal_errors( false );
  try {
   $xml = new SimpleXMLElement( preg_replace( '#>([^<]+)<#i', '><![CDATA[\\1]]><', $output ), LIBXML_NOWARNING );
  } catch( Exception $e ) {
   return $output;
  }
  $container = array();
  if( ! $xml->li ) {
   list( , $item ) = each( $xml->xpath( 'ul' ) );
   if( ! $item ) {
    list( , $item ) = each( $xml->xpath( 'menu' ) );
   }
   if( $item ) {
	$container = array( '<' . $xml->getName(), '</' . $xml->getName() . '>' );
	foreach( $xml->attributes() as $key => $value ) {
     $container[0] .= ' ' . $key . '="' . $value . '"';
    }
	$container[0] .= '>';
   }
  } else {
   $item = $xml;
  }
  libxml_use_internal_errors( $xmlInternalErrors );
  return count( $item ) > 0 ? '<!-- Menu modified by MAJpage Menu Class Extender -->' . $container[0]. preg_replace( '#<\?[^>]*\?>#', '', preg_replace( '#<!\[CDATA\[([^<]+)\]\]>#', '\\1', self::_nextLevel( $item )->asXML() ) ) . $container[1] : $container[0] . $output . $container[1];
 }

 private static function _nextLevel( $xml )
 {
  $count = count( $xml->li );
  if( $count > 0 ) {
   $i = 1;
   foreach( $xml->li as $item ) {
    $attributes = $item->attributes();
    $attributes['class'] = ( $i % 2 == 1 ? 'odd' : 'even' ) . '-menu-item ' . $attributes['class'];
    if( $item->ul || $item->menu ) {
	 $attributes['class'] = 'parent-menu-item ' . $attributes['class'];
	 self::_nextLevel( $item->ul ? $item->ul : $item->menu );
	}
    if( $i == $count ) {
     $attributes['class'] = 'last-menu-item ' . $attributes['class'];
    }
    if( $i == 1 ) {
     $attributes['class'] = 'first-menu-item ' . $attributes['class'];
    }
    $i++;
   }
  }
  return $xml;
 }

}

if( class_exists( 'SimpleXMLElement' ) ) {

 add_filter( 'wp_nav_menu', array( 'MAJpageMCE', 'add' ) );
 add_filter( 'wp_page_menu', array( 'MAJpageMCE', 'add' ) );

}
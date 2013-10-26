<?php
/*
Plugin Name: MAJpage Menu Class Extender
Description: Adds classes to first, last, parent, even and odd elements of wp_page_menu and wp_nav_menu to support recognizing it in older browsers without :first-child, :last-child and :nth-child supporting.
Author: Wiktor Maj
Version: 1.4
Author URI: http://www.majpage.com
*/

class MAJpageMCE
{

 public static function init()
 {
  if( class_exists( 'SimpleXMLElement' ) ) {
   add_filter( 'wp_nav_menu', array( __CLASS__, 'extend' ) );
   add_filter( 'wp_page_menu', array( __CLASS__, 'extend' ) );
  }
 }

 public static function extend( $output )
 {
  $xmlInternalErrors = libxml_use_internal_errors( false );
  try {
   $xml = new SimpleXMLElement( preg_replace( '#>([^<]+)<#i', '><![CDATA[\\1]]><', $output ), LIBXML_NOWARNING );
  } catch( Exception $e ) {
   return $output;
  }
  $container = array();
  if( ! $xml->li ) {
   $items = $xml->xpath( 'ul' );
   list( , $item ) = each( $items );
   if( ! $item ) {
    $items = $xml->xpath( 'menu' );
    list( , $item ) = each( $items );
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
  return count( $item ) > 0 ? '<!-- Menu modified by MAJpage Menu Class Extender -->' . $container[0]. preg_replace( '#<\?[^>]*\?>#', '', preg_replace( '#<!\[CDATA\[([^<]+)\]\]>#', '\\1', self::_extendLevel( $item )->asXML() ) ) . $container[1] : $container[0] . $output . $container[1];
 }

 private static function _extendLevel( $xml )
 {
  $count = count( $xml->li );
  if( $count > 0 ) {
   $i = 1;
   foreach( $xml->li as $item ) {
    $attributes = $item->attributes();
    $attributes['class'] = ( $i % 2 == 1 ? 'odd' : 'even' ) . '-menu-item ' . $attributes['class'];
    if( $item->ul || $item->menu ) {
	 $attributes['class'] = 'parent-menu-item ' . $attributes['class'];
	 self::_extendLevel( $item->ul ? $item->ul : $item->menu );
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

MAJpageMCE::init();
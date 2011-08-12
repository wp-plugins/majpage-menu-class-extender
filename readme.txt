=== MAJpage Menu Class Extender ===
Contributors: duzymaju
Tags: menu, wp_nav_menu, classes, tags, first, last, even, odd
Requires at least: 3.0.0
Tested up to: 3.2.1
Stable tag: trunk

Adds classes to first, last, even and odd elements of wp_nav_menu.

== Description ==

    This plugin was written to add classes to first, last, even and odd elements of wp_nav_menu to support recognizing it in older browsers without :first-child, :last-child and :nth-child supporting.

Plugin adds the following classes to &lt;li&gt; tags:

*   "first-menu-item" to every first child of &lt;ul&gt; tag,
*   "last-menu-item" to every last child of &lt;ul&gt; tag,
*   "odd-menu-item" to every odd child of &lt;ul&gt; tag, including first and/or last child,
*   "even-menu-item" to every even child of &lt;ul&gt; tag, including first and/or last child.

    Above classes are added separately to each menu level.

== Installation ==

1. Upload 'majpage_mce.php' to the '/wp-content/plugins/' directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. That's all - plugin is fully operational and adds specified classes in every wp_nav_menu element.

== Changelog ==

= 1.0 =
* First version of plugin.

== Upgrade Notice ==

= 1.0 =
This is the first version of plugin.
=== MAJpage Menu Class Extender ===
Contributors: duzymaju
Tags: menu, wp_page_menu, wp_nav_menu, classes, tags, first, last, parent, even, odd, :first-child, :last-child, :nth-child
Requires at least: 3.0.0
Tested up to: 4.1
Stable tag: 1.4

Adds classes to first, last, parent, even and odd elements of wp_page_menu and wp_nav_menu.

== Description ==

    This simple plugin was written to add classes to first, last, parent, even and odd elements of wp_page_menu and wp_nav_menu to support recognizing it in older browsers without :first-child, :last-child and :nth-child supporting.

Plugin adds the following classes to menu &lt;li&gt; tags:

*   "first-menu-item" to every first child of &lt;ul&gt; or &lt;menu&gt; tag,
*   "last-menu-item" to every last child of &lt;ul&gt; or &lt;menu&gt; tag,
*   "parent-menu-item" to every child of &lt;ul&gt; or &lt;menu&gt; tag that has another &lt;ul&gt; or &lt;menu&gt; tag inside (a parent to another menu level),
*   "odd-menu-item" to every odd child of &lt;ul&gt; or &lt;menu&gt; tag, including first and/or last child,
*   "even-menu-item" to every even child of &lt;ul&gt; or &lt;menu&gt; tag, including first and/or last child.

    Above classes are added separately to each menu level. Plugin use SimpleXML extension and requires PHP 5 or higher. Menu should have valid XHTML code.

== Installation ==

1. Upload "majpage-menu-class-extender.php" to the "/wp-content/plugins/" directory.
2. Activate the plugin through the "Plugins" menu in WordPress.
3. That's all - plugin is fully operational and adds specified classes in every wp_page_menu and wp_nav_menu element with menu defined in "Menus" tab.

== Changelog ==

= 1.4 =
* Plugin functions changed into MAJpageMCE class static methods.
* wp_page_menu container support added thanks to Dinesh Kesarwani's notice.
* Cause of the strict standards warning corrected thanks to flynsarmy's notice.

= 1.3 =
* HTML5 &lt;menu&gt; tag support added thanks to Tomas Kapler's notice.
* wp_nav_menu container tag support included.

= 1.2 =
* Bug fixed with correct working in case of wp_nav_menu container absence.
* "parent-menu-item" class added.

= 1.1 =
* Bug fixed with HTML special chars existence.
* Improved menu list searching inside a container.

= 1.0 =
* First version of plugin.

== Upgrade Notice ==

= 1.4 =
Plugin now supports wp_page_menu as well as wp_nav_menu. It's functions has been changed into MAJpageMCE class static methods.

= 1.3 =
Changes were made to add suport for HTML5 &lt;menu&gt; tag.

= 1.2 =
Changes were made due to instability in case of menu container absence.

= 1.1 =
Changes were made due to instability in case of HTML special chars existence.

= 1.0 =
This is the first version of plugin.
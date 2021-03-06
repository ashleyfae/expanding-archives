=== Expanding Archives ===
Contributors: NoseGraze
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=L2TL7ZBVUMG9C
Tags: widget, sidebar, posts, archives, navigation, menu, collapse, expand, collapsing, collapsible, expanding, expandable
Requires at least: 3.0
Tested up to: 5.3
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin adds a new widget where you can view your old posts by expanding certain years and months.

== Description ==

Expanding Archives adds a widget that shows your old posts in an expandable/collapsible format. Each post is categorized under its year and month, so you can expand all the posts in a given month and year.

This plugin comes with very minimal CSS styling so you can easily customize it to match your design.

Expanding Archives uses Font Awesome icons in a few places, so having that installed is recommended. However, the widget still functions perfectly fine without them.

JavaScript is required.

== Installation ==

1. Upload `expanding-archives` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Go to Appearance -> Widgets and drag the Expanding Archives widget into your sidebar.

== Frequently Asked Questions ==

= How can I change the appearance of the widget? =

The plugin does not come with a settings panel so you have to do this with your own custom CSS. Here are a few examples:

Change the year background colour:

`.expanding-archives-title {
    background: #000000;
}`

Change the year font colour:

`.expanding-archives-title a {
    color: #ffffff;
}`

== Screenshots ==

1. The widget on my blog. This version has custom CSS applied.
2. The widget on the Twenty Fifteen theme, with only the default styles applied.
3. No widget settings - just add and save!

== Changelog ==

= 1.1.1 =
* Added filters that allow developers to easily modify the archive list.

= 1.1.0 =
* Added a new option in the widget where you can choose to auto expand the current month or not.

= 1.0.5 =
* Use transient for database query that fetches all the months.

= 1.0.4 =
* Added `xhrFields: { withCredentials: true }` to ajax call.

= 1.0.3 =
* Changed the month URLs to use get_month_link() instead of building them manually.
* Tested the plugin with WordPress 4.4 beta.

= 1.0.2 =
* Tested with WordPress version 4.3.

= 1.0.1 =
* Month names are now displayed using date_i18n() instead of date() so they will translate.

= 1.0.0 =
* Initial release.

== Upgrade Notice ==

= 1.1.1 =
* Added filters that allow developers to easily modify the archive list.
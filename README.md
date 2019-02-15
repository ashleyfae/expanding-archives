# Expanding Archives

A widget showing old posts that you can expand by year and month.

## Installation

1. Upload `expanding-archives` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to Appearance -> Widgets and drag the Expanding Archives widget into your sidebar.

## Frequently Asked Questions

**How can I change the appearance of the widget?**

The plugin does not come with a settings panel so you have to do this with your own custom CSS. Here are a few examples:

Change the year background colour:

`.expanding-archives-title {
    background: #000000;
}`

Change the year font colour:

`.expanding-archives-title a {
    color: #ffffff;
}`

## Changelog

**1.1.1**
* Added filters that allow developers to easily modify the archive list.

**1.1.0**
* Added a new option in the widget where you can choose to auto expand the current month or not.

**1.0.5**
* Use transient for database query that fetches all the months.

**1.0.4**
* Added `xhrFields: { withCredentials: true }` to ajax call.

**1.0.3**
* Changed the month URLs to use get_month_link() instead of building them manually.
* Tested the plugin with WordPress 4.4 beta.

**1.0.2**
* Tested with WordPress version 4.3.

**1.0.1**
* Month names are now displayed using date_i18n() instead of date() so they will translate.

**1.0.0**
* Initial release.
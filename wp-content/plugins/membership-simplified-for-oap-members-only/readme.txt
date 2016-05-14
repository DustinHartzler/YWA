=== Membership Simplified ===
Contributors: william.deangelis, OfficeAutopilot
Tags: Membership Plugin, Membership, OfficeAutopilot, Moonray, Ontraport, Membership Simplified
Requires at least: 3.0
Tested up to: 4.5
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Membership Simplified allows you to generate membership lessons with templated content to create a unified look and feel throughout your courses.


== Description ==

Membership Simplified allows you to generate membership lessons with templated content to create a unified look and feel throughout your courses. It also provides the inner workings such as navigation options, a login widget, and editor buttons to use when protecting any post or page content. It sits on top of PilotPress, thus allowing you to use videos from the video manager, downloadable files from the file manager, and much more. Here is a list of the features:

* Disable the plugin on the front end while you work on creating and adding your content. Simply turn everything on with a click of a button as soon as you are ready to go!
* Use the styling that comes with your current theme, use our default styling, or customize every single bit till your heart is content. You have the option to control the colors, font type, font size, link colors, border colors and size, and much more!
* Apply your custom styling to all of your membership content pages or just to individual ones. Its up to you.
* Easily integrate social media sharing and even facebook comments with your membership content. When your users share the content on the page, it will show a snippet of your content on their social media profiles. Then, when one of their friends click the link, they will be prompted to join before they get access! (You must have PilotPress installed and configured properly for this to happen)
* Add lessons / modules to a specific 'Membership Content' area in the backend so that you can keep your membership content organized. Then, simply drag and drop your lessons into the order you would like them to appear in. Want to add categories for your content? Great! You can do that too.
* Choose between two overview layouts to display your content differently. (See Overview Templates below.)
* Choose between two membership content layouts to display your membership content differently. (See Text / Media Templates below)
* Easily add info about your lesson as well as pertinent download materials into your membership content pages. You can either upload your downloads to your site or pull them directly from your OfficeAutopilot file manager.
* Easily add a main media item to your membership content pages. You can either upload your image to your site, pull an image from your OfficeAutopilot Image library, add the url of a video you would like to stream (supports Youtube, Vimeo, or other self hosted video links), or pull a video from your OfficeAutopilot Video Manager (The preferred way to make you look more professional.)
* Add custom HTML code to your membership content pages so that you can easily add banner images, links, or anything else you might want!
* OAP Membership Plugin also comes with a sidebar widget for your membership content menu items, so that you can allow your members to easily get to your content even when they arent on a content page!


Please visit http://membership.officeautopilot.com for more info.

(This plugin requires PilotPress (http://wordpress.org/extend/plugins/pilotpress/) and an active OfficeAutopilot account to work.)


== Installation ==

1. Unzip the downloaded oapmembership zip file
2. Upload the `oapmembership` folder and its contents into the `wp-content/plugins/` directory of your WordPress installation
3. Activate OAP Membership from Plugins page
4. Configure the OAP Membership settings from the OAP Membership option in the Settings menu.


== Frequently Asked Questions ==
For more help, please visit the help section under 'Membership Content' on the WordPress side menu or visit http://membership.officeautopilot.com.



== Changelog ==
= Beta 1.58 =
* Minor fix to address reordering of downloadable items.

= Beta 1.57 =
* Minor fix to address missing bullet points.

= Beta 1.56 =
* Minor change to fix issues with ONTRAPORT download links

= Beta 1.55 =
* Added basic Wistia Video support (More advanced options to come soon)
* Add a new Video & Comments only template (Can also use info text just above the video for a bit of header text.)
* Added better functionality to the Video Manager. You can now see details about the videos you uploaded.
* Added a new HTML5 responsive video player for the Video & Comments only template. (Will be upgrading the old player that gets used in the other templates soon.)
* Upgraded the styling of the old video player with tabs
* Made an assortment of stylings tweaks
* Added tabs to the membership lesson's settings sections in the admin section of each lesson
* Enhanced the admin sections styling

= Beta 1.54 =
* Renamed the function content() to limitContent and then commented it out since its no longer in use. Will remove in future versions.

= Beta 1.53 =
* Removed line 2 from style.php where it was requiring wp-config unnecessarily

= Beta 1.52 =
* Removed the color picker in the Advanced Settings as it was preventing an issue with being able to click enter in the HTML text area. Will readd a new color picker for this item in a later release.

= Beta 1.51 =
* Minor style change to fix bug where page content was getting stuck behind videos when a youtube or vimeo video was displayed

= Beta 1.50 =
* Removing unneeded scripts and reformatting code
* Removed fancybox to stay compliant with WordPress and wrote a custom script to mimic its behavior (This will only be seen in the admin area with the help button popups.)
* Fixed a bunch of mysql issues that were potentially causing save errors due to old non MYSQLi code on a newer version of WP
* Updated all sections to make sure that the plugin is compliant and can be re-hosted on the WP repo

= Beta 1.49 =
* Minor style change to fix bug when video is set to 720 by 420 and the video buttons overlap the bottom line

= Beta 1.48 =
* Minor change to how the sidebar items scroll

= Beta 1.47 =
* Rebuilt how downloads work to fix a bug when adding external download links etc. 

= Beta 1.46 =
* Adding an option to update the varchar length of the amazon s3 file names to ensure long filename will work properly.
* Added a missing class to fix an issue with tab display under videos
* Added minor styling updates to the backend settings area

= Beta 1.45 =
* Fixes the new errors that happen when $wpdb->prepare isn't formed correctly and is missing the variables to pass in. This was resulting in errors in Membership Content > Settings.

= Beta 1.44 =
* Fixes a styling error on the text templates where it causes the sidebar to become 100% width and push the content below it.

= Beta 1.43 =
* Fixes a minor error that was causing widgets not to load on lessons. Fix was adding '= false' to the widget function on line 1309 of oapmembership.php

= Beta 1.42 =
* Fixes minor php notices in functions.php

= Beta 1.41 =
* Fixes the error in the membership plugin when the twentyfourteen theme is enabled that completely takes down a site.
* Fixes the styling issues where the lessons do not display properly in the twentyfourteen default theme
* Updates the way that widgets get called and displayed
* Updated the membership widgets to use responsive design.
* Removed the jQuery scrolling and replaced it with a regular scroll bar on hover for more stability
* Updated the theme so that it works properly with WordPress 3.8
* Reworked the code so that lessons will show up responsively and work nicely on mobile devices
* Removed jQuerytools plugin
* Updated the way the scripts get called so that there are no conflicts with versions previous to 3.5

= Beta 1.40 =
* Adding the class "entry-content" to all text areas within the membership plugin so that the styling takes on the default WordPress text styling

= Beta 1.39 =
* Upgrading jQuery UI which fixes the issue with Appearance > Menu Items not working properly

= Beta 1.38 =
* Making all Ontraport, Amazon, and custom videos playable on iOS.
* Upgrading flowplayer to 3.2.8

= Beta 1.37 =
* Updated $wpdb->prepare so that it no longer throws an error when trying to add videos
* Minor styling tweaks to the sidebar menu title and lesson number to lock down the spacing between h2's and h6's.
* Minor styling tweaks to the video tabs and downloads

= Beta 1.36 =
* Added the class 'entry-content' to the main div's that contains the main post content so that the font picks up WordPress's default styling in their 2012 theme.

= Beta 1.35 =
* Minor change to the way that the layout's get set. Added box-sizing to ensure that all themes have a properly centered layout with padding.

= Beta 1.34 =
* Minor change to the way that the Membership Menu height is calculated. It now sets a default when none is present. It also adds in px if px is not added.


= Beta 1.33 =
* Minor change to the way that lesson numbers are displayed. This should fix a bug where there was no space between the word lesson, module, etc. and the actual number.


= Beta 1.32 =
* Changing WP_PLUGIN_URL to plugins_url()
* Cleaning up spacing issues that occured with line endings when going from windows to UNIX
* Changed the method that is used to retrieve download items and videos


= Beta 1.31 =
* Minor change adding shortcode buttons to the third row of the tinymce editor


= Beta 1.30 =
* Fixed a bug where users were unable to search pages / posts.
* Fixed an issue that was causing a 'headers already sent' warning message
* Add a fade in / out effect between videos
* Fixed an error when downloading manually uploaded downloadable files
* Fixed an error with the scrollbars not working with the scrollwheel


= Beta 1.29 =
* Added theme support for Thesis
* Minor change to style.css where we changed #content li from 18px!important to 1.5!important.


= Beta 1.28 =
* Completely recoded the video player to fix the sizing bugs that were occuring on OAP hosted videos
* Added an option to add video thumbnails for OAP hosted videos.
* Fixed a bug where the lesson menu items in the sidebar still appeared when the global post setting was disabled.
* Added an option in the Settings menu > Menu Items (Sidebar & Overview section) titled Sidebar Menu Item - Bottom Spacing. This allows you to specify the amount of spacing between menu items.
* Added an option in the Settings menu > Menu Items (Sidebar & Overview section) titled Overview Item - Bottom Spacing. This allows you to specify the amount of spacing between overview items.
* Add the ability to add comments to lesson pages.
* Removed OAP jquery and tinyscrollbar scripts as well as oapmembership.css from loading multiple times within the body of the page and used the wp_enqueue_scripts / styles function to hook them into the header.
* Fixed a bug where the WordPress image uploader would not work because it was conflicting with the image uploaders included with this plugin.
* Fixed a bug where the lesson title and lesson number positioning was not working for text templates.
* Fixed a styling issue on the bottom spacing of squared overview sections


= Beta 1.27 =
* Changed the name from OAP Membership Content to Membership Simplified
* Fixes the issue where the plugin fails activation if the plugin 'duplicate posts' or a built in theme version of 'duplicate-posts' is installed.
* Adds additional shortcode buttons to the visual editor to make it easy to add the PilotPress 'Show If' tags in your content.
* Fixes the issue where the plugin fails activation if OptimizePress is the current theme.
* Changed the custom post type url 'oaplesson' in the lesson url's to 'm'.
* Fixes the 720 by 420 left alignment issue on some themes.
* Fixes the video size issue on the shared template.
* Added Support for Vimeo https (secure) videos
* Added Support for Youtube youtu.be videos
* Added Support for Youtube https videos
* Added Support for Optimize Press
* Removed Support for Embedding Video code (Will come back out in a later release.)
* Updated the styling for the two widgets
* Made a fix to functions.php where oap_posts was defined instead of wp_posts
* Fixed the text template where the Info Box was getting displayed even when it was turned off when using the text template.
* Fixed a bug where upon adding apostrophes, a slash was getting added next to them.
* Changed the name of the shortcode functions to prevent conflicts between other tinymce shortcode button functions.
* Made changes to style.css to fix issues where sub menu items were not displaying.
* Fixed global overrides for video positioning
* Fixed the ability to add and remove menu items
* Fixes the randomly added slashes that were being added to the names of download and video items
* Made a spelling fix in the 'Settings' screen. Changed Infox to Info Box.
* Fixed a bug with the image uploader for the lesson icons


= Beta 1.26c =
* Fixes the strange spacing issue below videos and above the main text and sidebar.
* Increases the amount of videos that display by default on the membership overview pages from 6 to 20 at a time.
* Fixes the issue where the membership plugin installs jquery without first checking to see if jquery already exists.
* Adds support for 'bullet points' on all list items within the main lesson text area.
* Fixes the issue where the membership lesson icons were not displaying the proper text field to add images in the backend.


= Beta 1.26b =
* Includes a fix for Installation Problems with Optimize Press


= Beta 1.26 =
* Initial public release of beta. Please visit membership.officeautopilot.com for more info.


= Beta 1.24 =
Major Update will list all new features since 1.05 in the next release.


= Beta 1.12 =
* 4-4-12 - Bug Fixes and New Feature
* Merging code in from Pin
* Fixing layout issues
* Fixing Bugs


= Beta 1.09 =
* 3-27-12 - Bug Fixes and New Additions
* New Help Menu
* All items are now under the membership content section
* More...


= Beta 1.08 =
* 3-26-12 - Bug Fixes and New Additions


= Beta 1.07p =
* -20-12 - Bug Fixes
* PilotPress and other shortcodes now work properly. Feature patched by Pin.
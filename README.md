# Custom Bootstrap Website Base
https://dev.gznetwork.com/websitebase

Base structure for web sites with reusable parts of source code or functions mainly based on Bootstrap and another libraries. You can visit the website above for a running example.

# Resources
- Standalone Support *(PHP 5.6+)*
- Wordpress Support *(Ver 4.9.4)*
- Laravel Support *(Ver 5.2, only CSS, JS, Home & Layout)*
- Bootstrap 3 *(Ver 3.3.7)*
- BootBox JS
- Bootstrap
- Clipboard JS
- Data Tables
- Font Awesome
- Holder JS
- Hover CSS
- HTML5 Shiv
- ImgLiquid JS
- jQuery
- jQuery Browser
- jQuery Cookie
- jQuery Fullscreen
- jQuery Rotate
- jQuery UI
- Light Gallery
- Masonry JS
- Moment JS
- REM Unit Polyfill
- Respond JS
- Tempus Dominus
- Touch Swipe
- PHP Mailer

# Functions & Code Snippets
- HTML header data class
- PHP main utility class
- CSS & JS files built in PHP (with code minification)
- Custom htaccess file with force HTTPS & WWW options
- PHP Features:
	- Global variables for CSS & JS usage
	- Minify CSS, JS and HTML
	- PHP error handle & warnings
	- Get Website part with cURL
	- Send E-Mails with PHPMailer
	- Check ends/start of string
	- Check string contains another string
	- Strip all witespaces to string
	- Convert string to boolean
	- Remove accents
	- Sanitize Strings
	- Convert to slug
	- Limit character/words
	- Get main url, protocol, https, current page, and more...
	- Convert string to UTF-8
	- Custom show date format
	- Get YouTube, Vimeo and Facebook ID and embed code URL
	- Custom paginator
- JS Features:
	- Custom language support
	- Check attr function
	- Check outer width & height with padding/margin
	- Remove whitespaces between elements
	- Form validate
	- Convert string to boolean
	- Get max height from elements
	- Responsive code detection
	- LightGallery destroy & load functions/events
	- ImgLiquid auto-fill background function
	- Get element height changes
	- Text cut function
	- Text auto size function
	- Show alert modal box using BootBox plugin (plain text, html content & ajax)
	- Video launch modal box function for YouTube, Vimeo and Facebook
	- Capitalize first function
	- Convert to slug function
	- Auto scroll function
	- Disable right click menu
	- Get URL parameter from URL (PHP $_GET like)
	- Get URL parameter from Script SRC (PHP $_GET like)
	- Convert strings to links function
	- Remove HTML tags function
	- Check hasthag disabled links function
	- Window pop-up function
	- Map launch function for Google Maps and Waze
	- Check validations for home page, mobile and navigators
- CSS Features:
	- Some features from Bootstrap 4
	- Custom Bootstrap's carousel classes
	- Custom Datepicker colors
	- Custom Bootstrap's tooltip colors
	- Custom loading classes for ajax purposes
	- Custom form validation classes
	- Collection of CSS3 hover effects
	- Included "BebasNeue" example font face
- Wordpress Features:
	- A bunch of Wordpress functions and snippets
	- Custom database configuration for wp-config
	- Cron and error reporting enable/disable
	- Admin Panel CSS & JS injection
	- Admin Menu Editor (Plugin)
	- Advanced Custom Fields (Plugin)
	- Anything Order (Plugin)
	- Custom Contextual Help (Plugin)
	- Custom Post Type UI (Plugin)
	- Simple History (Plugin)
	- TinyMCE (Plugin)
	- Mail SMTP (Plugin)
	- User Role Editor (Plugin)

# Questions & Answers
1. Why Bootstrap 3.3.7 instead the newer **Bootstrap 4**?
   - In a few words, BS4 dropped the compatibility in **Internet Explorer 8 and 9**. Some people is still using **Windows 7** and this comes with **IE8** by default.
   
2. There's some stuff still not working on **Internet Explorer 8 and 9**, what about that?
   - I am aware of that, but i don't intend to get website working completely 100% in **IE8** or **IE9**, but at least i want to show website "navigable" and not destroyed.

3. Can i use this stuff in plain **HTML** instead the **PHP** Standalone?
   - Yes, but you need to remove all the **PHP** stuff. Just copy the *Standalone* structure in **HTML** Files, remove **PHP** stuff, and call the **CSS / JS** files manually.

# Recommended Tools for editing
- [Visual Studio Code](https://code.visualstudio.com/)
- [NetBeans](https://netbeans.org/)
- [Atom](https://atom.io/)
- [Brackets](http://brackets.io/)
- [Notepad++](https://notepad-plus-plus.org/download/v7.5.6.html)
- [Adobe Dreamweaver](https://www.adobe.com/dreamweaver)

# Recommended Tools for server
- [MAMP Server (Mac OSX & Windows)](https://www.mamp.info/en/)
- [WAMP Server (Windows)](http://www.wampserver.com/)
- [LAMP Server (Linux)](https://bitnami.com/stack/lamp)
- [XAMP Server (All)](https://www.apachefriends.org/)

# About
I coded the most of the code snippets and functions *(from scratch or searching the whole internet)*. About the included libraries im not the author, but i try to let other people find the best way to use them *(original authors are linked in the demo page)*. If you have any question feel free to contact me at triforce@gznetwork.com
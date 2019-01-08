# Custom Bootstrap Website Base
https://websitebase.github.io

Base structure for websites with reusable parts of source code or functions mainly based on Bootstrap + PHP and another libraries. You can visit the website above for a running example.

# Base
Name | Version
------------ | ------------
Standalone | PHP 5.4+
WordPress  | 5.0.2
Bootstrap | 4.2.1
jQuery | 3.3.1

# Functions & Code Snippets
- HTML header data through PHP
- PHP main utility class
- CSS & JS built in PHP with minify & mix features
- Custom .htaccess file with force HTTPS & WWW options
- **PHP Features:**
	- CSS & JS template generator
	- Minify CSS, JS and HTML
	- Send E-Mails with PHPMailer
	- Check ends/start of string
	- Check string contains another string
	- Compare strings
	- Strip all whitespaces to string
	- Convert string to boolean
	- Remove accents
	- Sanitize Strings
	- Convert to slug
	- Limit character/words
	- Get main url, protocol, https, current url, and more...
	- Array index access
	- Add & remove URL query argument
	- Convert string to UTF-8
	- Custom show date format
	- Custom paginator
	- Get YouTube, Vimeo and Facebook ID and embed code URL
	- Get website parts with cUrl
	- Get external functions
	- Remove directory (recursively)
- **JS Features:**
	- Custom console log for websitebase functions (JSconsole)
	- Custom language support
	- Browser detection
	- Mobile detection
	- Custom modal trigger function
	- Check attr function
	- Check outer width & height with padding/margin
	- Remove whitespaces between elements
	- Custom form validation
	- Convert string to boolean
	- Get max width & height between elements
	- Custom responsive code event
	- LightGallery improved functions/events
	- Image auto-fill background images
	- Detect element height changes
	- Text cut one line function
	- Text cut multi line function
	- Text auto size function
	- Custom modal box using BootBox plugin (plain text, html content & ajax)
	- Video launch modal box function for YouTube, Vimeo and Facebook
	- Capitalize first character function
	- Convert to slug function
	- Auto scroll function
	- Disable right click menu on elements
	- Get URL parameter from URL (PHP $_GET like)
	- Get URL parameter from script SRC (PHP $_GET like)
	- Convert strings to links function
	- Remove HTML tags function
	- Check hashtag links function
	- Custom window pop-up function
	- Map launch function for Google Maps and Waze
	- Custom paginator function
	- Table painter & cleaner
	- Anchor tag functionallity for any HTML tag
	- Easy Masonry JS usage
	- Remove accents from strings
- **CSS Features:**
	- Some Bootstrap modified classes to resemble its previous version
	- Custom modal extra large size
	- Custom modal alignment (top bottom center left and right)
	- Custom modal alternative fade effect
	- Custom dropdown overflow
	- Custom file input button language
	- Custom card overflow
	- Custom textarea overflow disable
	- Custom form warning validation
	- Custom rounded carousel indicators
	- Custom carousel controls hidden on mobile
	- Custom gradient text truncate
	- Collection of CSS3 hover effects
	- Included "BebasNeue" example font face
- **Wordpress Features:**
	- Custom setup for localhost & production enviroments
	- Custom htaccess with force HTTPS & WWW options
	- Custom WordPress functions and snippets (see also wiki)
	- Admin Panel CSS & JS injections
	- Akismet Anti-Spam (Plugin)
	- Admin Menu Editor (Plugin)
	- Advanced Custom Fields (Plugin)
	- Classic Editor (Plugin)
	- Custom Post Type UI (Plugin)
	- Enhaced Context Help (Plugin)
	- Gutenberg Editor (Plugin)
	- Loco Translate (Plugin)
	- Login reCaptcha (Plugin)
	- Mail SMTP (Plugin)
	- Migrate DB (Plugin)
	- Resize Image After Upload (Plugin)
	- Simple Custom Post Order (Plugin)
	- Simple History (Plugin)
	- TinyMCE (Plugin)
	- User Role Editor (Plugin)

# Resources
Name | Source
------------ | ------------
BootBox JS | [Visit](http://bootboxjs.com/)
Clipboard JS | [Visit](https://clipboardjs.com/)
Data Tables | [Visit](https://datatables.net/examples/styling/bootstrap4)
Font Awesome | [Visit](https://fontawesome.com/start)
Holder JS | [Visit](http://holderjs.com/)
Hover CSS | [Visit](http://ianlunn.github.io/Hover/)
Images Loaded | [Visit](https://imagesloaded.desandro.com)
jQuery Browser | [Visit](https://github.com/pupunzi/jquery.mb.browser)
jQuery Cookie | [Visit](https://github.com/js-cookie/js-cookie)
jQuery Fullscreen | [Visit](https://github.com/kayahr/jquery-fullscreen-plugin)
jQuery Rotate | [Visit](http://jqueryrotate.com/)
jQuery UI | [Visit](https://jqueryui.com/)
Light Gallery | [Visit](http://sachinchoolur.github.io/lightGallery/)
Masonry JS | [Visit](https://masonry.desandro.com/)
Moment JS | [Visit](https://momentjs.com/)
PHP Mailer | [Visit](https://github.com/PHPMailer/PHPMailer/)
Popper JS | [Visit](https://popper.js.org/)
Tempus Dominus | [Visit](https://tempusdominus.github.io/bootstrap-4/)
TinyMCE | [Visit](https://www.tiny.cloud/)
Touch Swipe | [Visit](http://labs.rampinteractive.co.uk/touchSwipe/demos/)

# Questions & Answers
1. How i can use the functions described above?
   - I will try to add all the explanation in the **Wiki** page. To access it [click here](https://github.com/TriForceX/WebsiteBase/wiki). 
   
2. What about **Bootstrap 3.3.7** and its **Internet Explorer 8 & 9** compatibility?
   - **Bootstrap 4** dropped **IE8**, **IE9**, and **iOS 6** support. Is now only **IE10+** and **iOS 7+**. Anyway if you want to give support, you can access the lastest _Website Base_ commit for **Bootstrap 3.3.7** [here](https://github.com/TriForceX/WebsiteBase/tree/v3.3.7).
   
3. What happen if an **Internet Explorer 8 & 9** or **iOS 6** user access a website which uses this project?
   - A screen will appear with a message with an advice to update his navigator to a newer one.

4. How can i use this stuff in plain **HTML** instead the **PHP** standalone?
   - I left a compiled demo in the **html** folder, you can take a look there. Also you can download it [here](https://github.com/WebsiteBase/WebsiteBase.GitHub.io/archive/master.zip).

# Recommended Tools for editing
- [Visual Studio Code](https://code.visualstudio.com)
- [NetBeans](https://netbeans.org)
- [Atom](https://atom.io)
- [Brackets](http://brackets.io)
- [Notepad++](https://notepad-plus-plus.org/download)
- [Adobe Dreamweaver](https://www.adobe.com/dreamweaver)

# Recommended Tools for server
- [MAMP Server (Mac OSX & Windows)](https://www.mamp.info/en)
- [WAMP Server (Windows)](http://www.wampserver.com)
- [LAMP Server (Linux)](https://bitnami.com/stack/lamp)
- [XAMP Server (All)](https://www.apachefriends.org)

# About
I coded the most of the code snippets and functions *(from scratch or searching the whole internet)*. About the included libraries im not the author, but i try to let other people find the best way to use them *(original authors are linked in the demo page)*. If you have any question feel free to contact me at triforce@gznetwork.com
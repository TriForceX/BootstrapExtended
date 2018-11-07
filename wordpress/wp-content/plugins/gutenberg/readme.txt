=== Gutenberg ===
Contributors: matveb, joen, karmatosed
Requires at least: 4.9.8
Tested up to: 4.9
Stable tag: 4.1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A new editing experience for WordPress is in the works, with the goal of making it easier than ever to make your words, pictures, and layout look just right. This is the beta plugin for the project.

== Description ==

Gutenberg is more than an editor. While the editor is the focus right now, the project will ultimately impact the entire publishing experience including customization (the next focus area).

<a href="https://wordpress.org/gutenberg">Discover more about the project</a>.

= Editing focus =

> The editor will create a new page- and post-building experience that makes writing rich posts effortless, and has “blocks” to make it easy what today might take shortcodes, custom HTML, or “mystery meat” embed discovery. — Matt Mullenweg

One thing that sets WordPress apart from other systems is that it allows you to create as rich a post layout as you can imagine -- but only if you know HTML and CSS and build your own custom theme. By thinking of the editor as a tool to let you write rich posts and create beautiful layouts, we can transform WordPress into something users _love_ WordPress, as opposed something they pick it because it's what everyone else uses.

Gutenberg looks at the editor as more than a content field, revisiting a layout that has been largely unchanged for almost a decade.This allows us to holistically design a modern editing experience and build a foundation for things to come.

Here's why we're looking at the whole editing screen, as opposed to just the content field:

1. The block unifies multiple interfaces. If we add that on top of the existing interface, it would _add_ complexity, as opposed to remove it.
2. By revisiting the interface, we can modernize the writing, editing, and publishing experience, with usability and simplicity in mind, benefitting both new and casual users.
3. When singular block interface takes center stage, it demonstrates a clear path forward for developers to create premium blocks, superior to both shortcodes and widgets.
4. Considering the whole interface lays a solid foundation for the next focus, full site customization.
5. Looking at the full editor screen also gives us the opportunity to drastically modernize the foundation, and take steps towards a more fluid and JavaScript powered future that fully leverages the WordPress REST API.

= Blocks =

Blocks are the unifying evolution of what is now covered, in different ways, by shortcodes, embeds, widgets, post formats, custom post types, theme options, meta-boxes, and other formatting elements. They embrace the breadth of functionality WordPress is capable of, with the clarity of a consistent user experience.

Imagine a custom “employee” block that a client can drag to an About page to automatically display a picture, name, and bio. A whole universe of plugins that all extend WordPress in the same way. Simplified menus and widgets. Users who can instantly understand and use WordPress  -- and 90% of plugins. This will allow you to easily compose beautiful posts like <a href="http://moc.co/sandbox/example-post/">this example</a>.

Check out the <a href="https://wordpress.org/gutenberg/handbook/reference/faq/">FAQ</a> for answers to the most common questions about the project.

= Compatibility =

Posts are backwards compatible, and shortcodes will still work. We are continuously exploring how highly-tailored metaboxes can be accommodated, and are looking at solutions ranging from a plugin to disable Gutenberg to automatically detecting whether to load Gutenberg or not. While we want to make sure the new editing experience from writing to publishing is user-friendly, we’re committed to finding  a good solution for highly-tailored existing sites.

= The stages of Gutenberg =

Gutenberg has three planned stages. The first, aimed for inclusion in WordPress 5.0, focuses on the post editing experience and the implementation of blocks. This initial phase focuses on a content-first approach. The use of blocks, as detailed above, allows you to focus on how your content will look without the distraction of other configuration options. This ultimately will help all users present their content in a way that is engaging, direct, and visual.

These foundational elements will pave the way for stages two and three, planned for the next year, to go beyond the post into page templates and ultimately, full site customization.

Gutenberg is a big change, and there will be ways to ensure that existing functionality (like shortcodes and meta-boxes) continue to work while allowing developers the time and paths to transition effectively. Ultimately, it will open new opportunities for plugin and theme developers to better serve users through a more engaging and visual experience that takes advantage of a toolset supported by core.

= Contributors =

Gutenberg is built by many contributors and volunteers. Please see the full list in <a href="https://github.com/WordPress/gutenberg/blob/master/CONTRIBUTORS.md">CONTRIBUTORS.md</a>.

== Frequently Asked Questions ==

= How can I send feedback or get help with a bug? =

We'd love to hear your bug reports, feature suggestions and any other feedback! Please head over to <a href="https://github.com/WordPress/gutenberg/issues">the GitHub issues page</a> to search for existing issues or open a new one. While we'll try to triage issues reported here on the plugin forum, you'll get a faster response (and reduce duplication of effort) by keeping everything centralized in the GitHub repository.

= How can I contribute? =

We’re calling this editor project "Gutenberg" because it's a big undertaking. We are working on it every day in GitHub, and we'd love your help building it.You’re also welcome to give feedback, the easiest is to join us in <a href="https://make.wordpress.org/chat/">our Slack channel</a>, `#core-editor`.

See also <a href="https://github.com/WordPress/gutenberg/blob/master/CONTRIBUTING.md">CONTRIBUTING.md</a>.

= Where can I read more about Gutenberg? =

- <a href="http://matiasventura.com/post/gutenberg-or-the-ship-of-theseus/">Gutenberg, or the Ship of Theseus</a>, with examples of what Gutenberg might do in the future
- <a href="https://make.wordpress.org/core/2017/01/17/editor-technical-overview/">Editor Technical Overview</a>
- <a href="https://wordpress.org/gutenberg/handbook/reference/design-principles/">Design Principles and block design best practices</a>
- <a href="https://github.com/Automattic/wp-post-grammar">WP Post Grammar Parser</a>
- <a href="https://make.wordpress.org/core/tag/gutenberg/">Development updates on make.wordpress.org</a>
- <a href="https://wordpress.org/gutenberg/handbook/">Documentation: Creating Blocks, Reference, and Guidelines</a>
- <a href="https://wordpress.org/gutenberg/handbook/reference/faq/">Additional frequently asked questions</a>


== Changelog ==

= Latest =

* Introduce the Formatting API for extending RichText.
* Use default Inserter for sibling block insertion.
* Support adding and updating entities in data module.
* Update block descriptions for added clarity and consistency.
* Add support for displaying icons in new block categories.
* Append registered toolbar buttons in RichText.
* Optimize SlotFill rendering to avoid props destructuring.
* Optimize Inserter props generation and reconciliation.
* Improve writing flow by unsetting typing flag if Escape pressed.
* Add support for non-Latin inputs in slash autocomplete block inserter.
* Use an animated WP logo for preview screen.
* Add “img” as a keyword for the Image block.
* Delay TinyMCE initialisation to focus.
* Announce number of filtered results from block inserter to screen readers.
* Add audible feedback for link editing.
* Avoid focus loss on active tab change within the Sidebar.
* Add Alt + F10 (navigate to the nearest toolbar) to the shortcut docs and modal.
* Add some more URL helpers to the url package.
* Add has-dates class to Latest Posts block if applicable.
* Improve mobile display of “options” modal.
* Add “link target” option in Image block.
* Use currentcolor as border-color for outline button style.
* Introduce a new middleware to the api-fetch package which adds ?_locale=user to every REST API request.
* Refactor and optimize withSelect, withDispatch handling of registry change.
* Refactor and update DropZone context API.
* Rephrase description of responsive toggle.
* Ensure buttons on end of row in media-placeholder have no margin on the right.
* Include implicit core styles in SelectControl.
* Use better help text for ALT text input.
* Flatten Inserter mapSelectToProps to optimize rendering.
* Cleanup Embed code and add better test coverage.
* Add space above exit code editor button.
* Return 0 in WordCount if text is empty.
* Avoid setting a value on the File block download attribute.
* Set download attribute on File block as empty.
* Remove Cover block ‘strong’ style.
* Reduce frequency of actions updating isCaretWithinFormattedText.
* Add a function to unregister a block style variation.
* Add lodash deburr to autocomplete so that is works with diacritics.
* Avoid making WordPress post embeds responsive.
* Improve handling of centered 1-column galleries with small images.
* Make pre-publish prompts more generic.
* Improve the style variation control aria-label.
* Improve preloading request code.
* Add missing context to various i18n strings.
* Add post saving lock APIs so plugins can add and remove locks.
* Take the viewport size into account when it comes to decide whether to show the button or toggle logic for “submit for review”.
* Improve accessibility of settings sidebar tabs.
* Improve the header toolbar aria-label.
* Add styles to stop Classic block buttons from inheriting italics from themes.
* Add aria-label to links that open in new windows.
* Add more descriptive aria-labels for the open and closed states of sidebar settings.
* Add key event handler to activate block styles with keyboard.
* Add field that allows changing image alt text from the sidebar in Media & Text.
* Add aria-label to describe action of featured image update button.
* Restore displaying formatting shortcuts in toolbar.
* Add i18n context to “Resolve” button for invalid blocks.
* Update the editor styles wrapper to avoid specificity issues.
* Fix converting a reusable block with nested blocks into a static block.
* Fix regression with mobile toolbar spacing.
* Fix size regression in block icon.
* Fix multi-selected warning block highlight.
* Fix: Show resizer on “Media & Text” block on unified toolbar mode
* Fix some RichText shortcuts and add e2e tests.
* Fix issue with tertiary button hit areas.
* Fix issue with unified toolbar not always fitting in smaller viewports.
* Fix issue with “remove tag” button in long tag names.
* Fix rich text value for nested lists.
* Use color function for defining the background in DateTimePicker.
* Fix usage of preg_quote() in block parsing.
* Fix flow of scheduling and then publishing.
* Fix focus issue on Gallery remove button.
* Fix keyboard interaction (up/down arrow keys) causing focus to transfer out of the default block’s insertion menu.
* Fix regression causing dynamic blocks not rendering in the frontend.
* Fix vertical alignment issue on Media & Text block.
* Fix some linter errors in master branch.
* Fix dash line in More/Next-Page blocks.
* Fix missing Categories block label.
* Fix embedding and demo tests.
* Fix issue with vanilla stylesheet.
* Fix documentation for openModal() and closeModal().
* Fix blocks navigation menu SVG icon size.
* Fix link popover keyboard accessibility.
* Fix issue with multiselect using shift + arrow.
* Fix issue with format placeholder.
* Fix Safari issue where hover outlines sometimes linger.
* Resolve an issue where the “Copy Post Text” button in the error boundary would not actually copy post text, since it used a legacy retrieval method for post content.
* Make preview placeholder text translatable.
* Load translations in the reusable block listing page.
* Avoid adding isDirty prop to DOM.
* Improve translation string and replace placeholder handling for MediaPlaceholder instructions.
* Refactor rich text package to avoid using blocks packages as a dependency.
* Handle 204 response code in API Fetch.
* Remove HTML source string normalization.
* Normalize function arguments in Block API.
* Remove unused code path.
* Deprecate layout attribute.
* Add class for -dropdown/-list in Archives block.
* Update registration method signature of RichText.
* Add filter for preloading API paths.
* Add missing @return tag to gutenberg_meta_box_save_redirect() function.
* Rename id attribute to tipId in DotTip.
* Only silence REST errors if the REST server is present
* Use consistent help text in DatePicker.
* Export both the DropZone and MediaPlaceholder editor components with the withFilters HOC.
* Remove “half” keyword from Media & Text block.
* Remove redundant hooks initialization.
* Mark getSettings in Date package as experimental.
* Remove unused variable fallbacks in RichText.
* Improve the Toggle Control elements DOM order for better accessibility.
* Mark Reusable blocks API as experimental pending future refactor.
* Set correct media type for video poster image and manage focus properly.
* Avoid PHP notices due to non-available meta boxes.
* Implement fetchAllMiddleware to handle per_page=-1 through pagination in wp.apiFetch.
* Add do’s and don’ts to block design documentation.
* Update creating-dynamic-blocks.md.
* Update editor package changelog.
* Add notices package.
* Add styles property to block-api.md.
* Add documentation for responsive-embeds theme option.
* Add missing e2e tests for Plugins API.
* Add an eslint rule to use cross-environment SVG primitives.
* Use turbo-combine-reducers in place of Redux
* Update react-click-outside to 3.0.
* Update @wordpress/hooks README to include namespace mention.
* Fix Heading blocks validation errors after block splitting
* Expose setUnregisteredTypeHandlerName / getUnregisteredTypeHandlerName for mobile.
* Fix a refresh issue with iOS when splitting blocks.
* Simplify onEnter handling.
* Hook onBackSpace in RichText component.
* Introduce the ability to merge two blocks together on Backspace.
* Properly refresh blocks when merging them under iOS.
* Port nextpage block to the ReactNative mobile app.
* RichText: fix buggy enter/delete behaviour (Extra br elements).
* Fix showing categories for contributors.

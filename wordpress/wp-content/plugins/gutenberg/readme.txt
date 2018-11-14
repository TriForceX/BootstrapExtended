=== Gutenberg ===
Contributors: matveb, joen, karmatosed
Requires at least: 4.9.8
Tested up to: 4.9
Stable tag: 4.2.0
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

* Allow toggling the core custom fields meta box.
* Introduce Annotations API across Block and Formatting.
* Allow using a YouTube URL (or other sources) in the Video block and transparently convert it to Embed.
* Allow Alt+F10 keyboard shortcut to navigate to block toolbar regardless of the toolbar visibility (isTyping, etc).
* Return focus to element that opened the post publish panel after it is closed.
* Avoid unnecessary re-renders when navigating between blocks.
* Improve interactions around Columns block.
* Improve keyboard navigation through the Gallery block.
* Use full parser in do_blocks with nested block support. This switch will allow dynamic blocks which contain nested blocks inside of them and it will pave the way for a filtering API to structurally process blocks.
* Refactor contextual toolbar to work better with floats.
* Auto-refresh Popovers position but only refresh if the anchor position changes.
* Add min-width to audio block.
* Avoid auto-saving with empty post content.
* Display correct Taxonomy labels.
* Fix incorrect import name.
* Fix styling issue with checkboxes.
* Add full set of reusable block post type labels (addresses “no blocks found” state).
* Fix right to left block alignment.
* Fix “updating failed” notices showing on long-open tabs.
* Fix default PHP parser to cast inner blocks as arrays.
* Fix JS/PHP inconsistencies with empty attributes on parsing.
* Link to the source image in the media block.
* Fix select all keyboard shortcut for Safari and Firefox.
* Create multiple blocks when multiple files are drag and dropped.
* Fixes potential theme syle.css clash.
* Makes preview button a link (a11y).
* Stop re-rendering all blocks on arrow navigation.
* Add constraint tabbing to post publish panel (a11y).
* Fix image uploading bug (incorrect JSON in apiFetch).
* Fix taxonomy visibility for contributors.
* Adds aria labels to images in gallery blocks during editing (a11y).
* Formatting fix for blockquotes.
* Hide custom fields when meta box is disabled.
* Limits blockquote color auto-selection to solid color blocks for readability.
* Fixes announcement on multi-selection of blocks (a11y).
* Display upload errors in the image block.
* Fixes selection of embed type blocks.
* Fixes JSON attribute parsing.
* Fixes post publish focus (a11y).
* Resolve macOS Firefox / Safari sibling inserter behavior.
* Fix visibility of sibling inserter on tab focus.
* Fix issue with pasting from Word where an image would be created instead of text.
* Fix multi-selection for float elements.
* Fetch all tag terms, not just first 100.
* Correctly displays media on the right.
* Only show named image sizes.
* Improves handling of paste action.
* Updates displayed permalink after permalink is edited.
* Adjust font size for contrast warning (a11y).
* Better handles formatting – nested and Google Docs.
* Fixes suggestion list scrolling when using keyboard (a11y).
* Fixes block and menu navigation a11y.
* Click to close dropdown popover.
* Fix save lock control.
* Timezone handling fix.
* Improve a11y of empty text blocks.
* Fix states for publish buttons.
* Fix backspace behavior.
* Change aria labels for paragraph blocks (a11y).
* Add support for prepare RichText tree.
* With this change we force the browser to treat the textarea for the
* code editor as auto when handling direction for its display to preserve the ability to interact with the block delimiters.
* Rename parentClientId to rootClientId.
* Remove deprecated findDOMNode call from Tooltip component.
* Remove unused ref assignment to RichText.
* Remove redundant onClickOutside handler from Dropdown.
* Refactor block state.
* Remove Cloudflare warning for blocked API calls.
* Remove _wpGutenbergCodeEditorSettings (dead code).
* Adds periods to block a11y descriptions.
* Refactor embed block.
* Handle metabox warning exceptions.
* Refactor RichText to update formatting bar on format availability changes.
* Rename wp-polyfill-ecmascript.
* Update translator comments for quote and pullquote.
* Remove findDOMNode useage from NavigableToolbar.
* Changes handling of dates to properly handling scheduling.
* Remove findDomNode from withHoverAreas.
* Fixes missing translator comments.
* Refactor to import Format API components.
* Refactor of change detection: initial edits.
* Adds better translation comments to “resolve” and “resolve block”.
* Adds option for blocks with child blocks to change selection behavior.
* Allows blocks to disable being converted to reusable blocks.
* Improve undo/redo states.
* Updates parsing to better handle nested content.
* Remove undefined className argument from save().
* Use different tooltips for different alignment buttons.
* Improve performance and handling of autosave.
* Improve gallery upload for multiple images: load one by one.
* Adds context variable to RichText component.
* Avoid calling missing get_current_screen function.
* Make cssnano remove all style comments.
* Refactor normalizeBlockType.
* Shows icon in block toolbar.
* Makes kitchensink button removable from plugins.
* Fix popover sizing on screen change (autorefresh)
* Improvement to Columns block.
* Update block description for consistency.
* Refactor block styles registration.
* Use apostrophe instead of single-quote character in strings.
* Add transformations between video and media and text block.
* Version update for NPM packages.
* Update Lerna to latest version.
* Validates link format in RichText.
* Refactor contextual toolbar to work better with floats.
* Move wp-polyfill-ecmascript override to scripts registration.
* Improves consistency of parser tests.
* Remove code coverage.
* Adds mocking helpers for E2E tests.
* Runs E2E tests with the user in author role.
* Adds tests for Format API.
* Adds E2E test for rapid enter presses.
* Fix typo in documentation.
* Fix typos in block API documentation.
* Improved documentation and examples for withFilters.
* Fix some broken links in documentation.
* Fix typo and quote consistency.
* Remove duplicated word.
* Adds custom block icon instructions.
* Update documentation on keyboard shortcuts.
* Updates isSelectionEnabledDocumentation.
* Update FontSizePicker component documentation.
* Export `switchToBlockType` function.
* Remove mobile RN test suite (temporary measure).
* Improve styling of next page block.
* Removes fixed cover on iOS (unsupported in mobile Safari).
* Adds support for native media picker.
* Remove onChange delay.
* Exposes slot/fill pattern to mobile.
* Expose @wordpress/editor to mobile.
* Refreshes native post block merge.
* Properly handle cancel on the media picker.
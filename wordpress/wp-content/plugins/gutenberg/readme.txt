=== Gutenberg ===
Contributors: matveb, joen, karmatosed
Requires at least: 4.9.8
Tested up to: 4.9
Stable tag: 4.3.0
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

#  Changelog

* Improves discoverability of permalinks by adding permalink panel to the document sidebar.
* Improves margins, column child block, and mobile display of columns.
* Allow for programmatically removing editor document panels.
* Replaces the uploading indicator of images and galleries with a spinner and faded out image.
* Toolbar for floats was a little offset beyond the mobile breakpoint, now fixed.
* Text and code editing blocks did not have width set, now set to fill the space.
* Correctly align URL input autocomplete.
* Improve animations: new, consistent naming convention, adds editor prefix, and moves keyframe animations (which don’t work well with mixins) into the edit post style.
* Hover styles were showing on mobile, where hover is not available – now disabled.
* Click and drag was incorrectly triggering a selection event in the block list under the popover, resulting in the popover dismissing. This was causing blocks to be selected when trying to set links to open in a new tab, for example. Fixed by preventing the mouse down event from propagating.
* Adds some padding to the block inserter so that it never overlaps text in nested contexts or mobile views.
* Better handle images larger than the editor by allowing a 2.5x buffer. Allows images inserted in TwentyNineteen and other themes that have a wider than 580px editor width, to look as expected, but prevents infinite resizing of images.
* Stop mousedown event propagating through the toolbar, fixing problem of unexpectedly selecting blocks.
* Improve the way that long words are broken on multiple lines, using word-break: keep-all;
* Preserve the ratio of video backgrounds in cover blocks, videos may be cropped to fit but will keep their original ratio.
* It was not possible to scroll a long menu on first load of Gutenberg, fixed by removing sticky-menu.
* Properly check for allowed types of Media in Media Placeholder components.
* “Resolve” and “Convert to HTML” buttons were not clickable (regression), now resolved.
* Exclude HTML editing from Columns and Column blocks.
* Better handle links without href, which were showing as `undefined`.
* Renders block appender after the template is processed, to prevent incorrectly inserting new paragraphs.
* Parent pages were being lost when draft pages were autosaved, fixed by removing parent pages from autosave requests and refactoring to stop using “parent” as the path argument name.
* Adding line breaks in formatted content in quote blocks were not working correctly, fixed by persisting formats when new lines are added.
* Prevent users in the contributor role from using blocks that require upload privileges.
* Fix block selection in removing blocks, correct typo in comparison.
* Japanese text (double byte characters) was not usable in the list block, fixed by changing handling of composition events.
* Better handles different text encodings (e.g. emoji) within a block in block validation.
* Use a query argument instead of data to prevent error being thrown on post refresh.
* Keyboard navigation was not working as expected in Firefox, added extra key binding.
* Adds missing alt values to images when editing.
* Better communicate block nesting level by using unordered lists.
* Fix sidebar icons being incorrectly announced in NVDA by adding a span with `aria-hidden=”true”`.
* Fixes block toolbar aria label to announce “block tools toolbar” rather than “block toolbar (a11y).
* Adjusts focus on media and text blocks to select the overall block, not the child paragraph block.
* Refactors i18n module to replaces Jed with Tannin for significant performance improvements.
* Replace `getSelectedBlock` and `getMultiSelectedBlocks` with more performant `getSelectedBlockClientId` and a `getBlocks` selectors in copy handler.
* Replace `getBlock` selector in favor of the more performant `getBlockName`.
* Replace `getSelectedBlock` with more performant `getSelectedBlockClientId` and new `isBlockValid` selectors in the BlockToolbar.
* Replace `getSelectedBlock` with more performant `getSelectedBlockClientId` and new `isBlockValid` selectors in the Block Inspector.
* Replaces `getInserterItems` with a new `hasInserterItems` selector which is more performant, and makes some adjustments to memorization.
* Avoid using the `getSelectedBlock` selector in autocompleters.
* Remove use of `getBlock` selector in the DefaultBlockAppender and EditorKeyboardShortcuts components.
* Move undo handling out of TinyMCE and into the RichText component.
* `is_gutenberg_page` incorrectly assumes `get_current_screen` exists, add check.
* Brings code inline with CSS standards by switching font weight to numeric values.
* Wrapped component would not the most up-to-date store values if it incurred a store state change during its own mount (e.g. dispatching during its own constructor), resolved by rerunning selection.
* Display an error message if Javascript is disabled.
* Update to React 16.6.3.
* Adds missing components dependency for RichText.
* Refactors list block to remove previously exposed RichText/TinyMCE logic.
* Removes `focusOnMount` prop from NavigableToolbar components, which was generating a warning.
* Refactor checks for upload permissions, removing unnecessary checks for store permissions.
* Use the large image size when inserting images in both galleries and image blocks.
* Fixes dependency of `wp-polyfill` which needs to be registered before React and React-Dom when plugins (like Yoast) rely on Gutenberg’s React.
* Mark `onSplit` as unstable as it is pending refactor.
* Remove 4.4 deprecated features.
* Fix SCSS syntax error.
* Remove export of previously removed function.
* Add an E2E test for unsupported blocks.
* Refactor E2E utility functions.
* Formatting updates to copy guidelines.
* Makes headings consistent in the dropdown documentation.
* Removes outdated documentation referring to function support in `registerBlockType`.
* Fixes some typos and line breaks in block design documentation.
* Fixes some typos and improves readability of README.
* Adds toolbar to the editing block, and edit button.
* Passes the `isSelected` prop down to the implementation of RichText components to make them respond properly to focus changes.

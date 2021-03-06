# Change Log

## [1.2.0] - 2019-05-23

### Fixed

- Running `array_map()` over customizer settings and controls when it can be done once.
- Fixed bottom margin for the Pullquote block when it has a solid background.
- Correct font CSS for item author in RSS block.
- Corrected the vertical alignments not working in the editor for the Columns block.
- Fixed Pullquote font size, line height, and margins in editor.
- Removed rounded corners from wide-aligned Image and Cover blocks so that the edges are flush with the container.

### Added

- Core `custom-background` support.
- Layouts features that allows the selection between the following layouts:
	- Wide (default)
	- Boxed
	- Boxed Content
- New color options:
	- Footer: Text
	- Footer: Background
	- Footer: Border
	- Footer: Link
	- Footer: Link Hover
- Support for background and text colors with the Heading block.
- Early version of theme manager via Appearance > Exhale Settings > Themes, which will primarily be used for showcasing new child themes.
- Added `block-styles` and `wide-blocks` to the theme tags list.

### Changed

- Gutenberg 5.6+ is now required.
- Overhaul of the CSS block system. Primarily, this made the `.entry__content` container a full-width block container.  This is so that we can avoid a lot of negative margin hacks and better prep blocks to work within any block container in the future with little addition of code.
- New screenshot.
- Reordered the customizer sections under Theme Options to better control them.

### Removed

- Took out `config/settings-font-family.php`, which falls back to `config/_settings-font-family.php`.

## [1.1.0] - 2019-05-07

### Fixed

- Corrected bottom margins of elements within the Columns block.
- Fixed center alignment of images not working.
- Removed top margin of headings when following a `</div>`.
- Clear floats when using a wide or full-aligned block.
- Fixed a fatal error on PHP 5.6 when importing the `Hybrid\Tools\Collection` class from Hybrid Core under the `Exhale\Tools` namespace instead of the `Exhale\Tools\Collection` class.
- Fall back to `transparent` when a color is set to nothing.
- Lowered the padding for `<code>` elements, which was bumping into before/after lines when used inline.
- Fixed weird white panel over editor when using an unaligned image within a full-width columns block.

### Added

- New block styles:
	- Borderless style for the image block.
	- Highlight style for the paragraph block.
	- Dashed and Double styles for the separator block.
- Created a new system for child themes to override config files while merging with the defaults:
	- `config/editor-colors.php`
	- `config/settings-color.php`
	- `config/settings-font-family.php`
- Google fonts integration with the font settings.  Brings in 106 new fonts that are suitable for body copy (includes Regular, Regular Italic, Bold, and Bold Italic styles).
- Added a `CssCustomProperty` interface use alongside the `CustomProperties` collection.

## Changed

- Unregister the core block styles on the `enqueue_block_assets` hook. This stopped working on `enqueue_block_editor_assets` at some point. See: https://github.com/WordPress/gutenberg/issues/15007

## Removed

- Removed old `classic.css` file that's no longer in use (got renamed to `screen-classic.css`).

## [1.0.2] - 2019-04-22

### Fixed

- Use font size for the post title input in editor.
- Use correct color when post title input in editor is focused.
- Removed unnecessary padding from Media & Text block content area.
- Adds max width to "content" area of Media & Text block for better alignment on mobile.
- Added left/right padding to footer area to fix mobile spacing.
- Contains the margin for paragraph blocks with backgrounds inside of the Columns block.
- Target only direct descendants on the no post header/footer template when using negative margin.
- Several alignment and width fixes for the Columns block.

### Added

- Support for the Group block in Gutenberg 5.5.0.
- Support for vertical alignment with the Media & Text block in Gutenberg 5.5.0.
- Support for the image fill option in the Media & Text block added to Gutenberg 5.5.0.

## [1.0.1] - 2019-04-04

### Fixed

- Fixed the theme mod colors not showing correctly within the editor for those that are also editor colors.

## [1.0.0] - 2019-04-03

### Added

- Theme launch.  Everything's new!

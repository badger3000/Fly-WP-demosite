# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a WordPress installation with a **BlockTheme** as the primary development theme. BlockTheme is a modern block-based WordPress starter theme that uses Tailwind CSS and @wordpress/scripts for the build process.

## Key Directories

- **WordPress Core**: Root directory contains standard WordPress files
- **Active Theme**: `wp-content/themes/block-theme/` - Modern block-based WordPress theme
- **Other Themes**: `wp-content/themes/` contains additional themes
- **Plugins**: `wp-content/plugins/` (currently minimal)
- **Uploads**: `wp-content/uploads/` for media files

## Development Commands

All development commands should be run from the BlockTheme directory: `wp-content/themes/block-theme/`

### Build & Development
- `npm run start` - Start development server with file watching (@wordpress/scripts)
- `npm run build` - Build production assets
- `npm install` - Install Node.js dependencies
- `composer install` - Install PHP dependencies for development tools

### Block Creation
- `npm run create-block [block-name]` - Create a new static custom block
- `npm run create-block:dynamic [block-name]` - Create a new dynamic custom block

### Code Quality
- `composer phpcs` - Run PHP CodeSniffer to check coding standards
- `composer phpcs-fix` - Automatically fix PHP coding standards issues
- `composer php-lint` - Run PHP syntax checking

## Architecture

### BlockTheme Structure
- **Theme Setup**: `inc/` - Core theme functionality
  - `inc/setup.php` - Theme configuration and WordPress hooks
  - `inc/enqueue.php` - General scripts and styles enqueuing
  - `inc/enqueue-blocks.php` - Block-specific styles and scripts

- **Source Files**: `src/` - Source files for compilation
  - `src/scss/` - SCSS source files including block-specific styles
  - `src/js/` - JavaScript source files
  - `src/blocks/` - Custom block source files

- **Compiled Assets**: `css/` and `js/` - Built CSS and JavaScript files
- **Custom Blocks**: `blocks/` - Compiled custom blocks (auto-registered)
- **Templates**: `templates/` - Block template files for site editor
- **Template Parts**: `parts/` - Reusable template parts
- **Block Patterns**: `patterns/` - Custom block patterns

### Technology Stack
- **Build Tool**: @wordpress/scripts (webpack-based)
- **CSS Framework**: Tailwind CSS v4
- **CSS Preprocessor**: SCSS
- **Block Development**: @wordpress/create-block
- **PHP Standards**: WordPress Coding Standards via PHP_CodeSniffer

### WordPress Integration
- Full Site Editing (FSE) theme with theme.json
- Block-specific CSS files automatically enqueued per block
- Custom block registration and compilation
- Modern WordPress development with block editor focus

## Block-Specific Features

### Block CSS System
BlockTheme automatically enqueues block-specific CSS files. Create SCSS files in `src/scss/blocks/` following the pattern `namespace/block-name.scss` (e.g., `src/scss/blocks/core/paragraph.scss` for core/paragraph block).

### Custom Block Development
- Blocks are created in `src/blocks/` and compiled to `blocks/`
- Use WordPress block development patterns with `@wordpress/scripts`
- Supports both static and dynamic blocks
- Automatic registration of compiled blocks

### Theme Configuration
- `theme.json` defines design tokens and block editor settings
- `functions.php` loads theme setup from `inc/` directory
- Tailwind CSS configuration in `tailwind.config.js`

## Environment Notes

### Local Development
- **Environment Type**: Local development
- **Database**: Local MySQL (configured via wp-config.php)
- **Node Version**: Compatible with @wordpress/scripts requirements
- **PHP Version**: Requires PHP >= 7.4

### File Structure
```
wp-content/themes/block-theme/
├── bin/                    # Build scripts
├── blocks/                 # Compiled custom blocks
├── css/                    # Compiled CSS files
├── fonts/                  # Theme fonts
├── inc/                    # PHP includes
├── js/                     # Compiled JavaScript files
├── parts/                  # Template parts
├── patterns/               # Block patterns
├── src/                    # Source files
│   ├── blocks/            # Custom block source
│   ├── js/                # JavaScript source
│   └── scss/              # SCSS source
├── templates/              # FSE templates
├── functions.php           # Main theme file
├── theme.json             # FSE configuration
└── style.css              # Theme metadata
```

## Important Commands

### Theme Development
```bash
cd wp-content/themes/block-theme/
npm install                       # Install dependencies
npm run start                     # Development with file watching
npm run build                     # Production build
composer install                  # Install PHP dev tools
```

### Code Quality
```bash
composer phpcs                    # Check PHP coding standards
composer phpcs-fix               # Fix PHP coding standards
composer php-lint                # Check PHP syntax
```

### Block Development
```bash
npm run create-block my-block    # Create new static block
npm run create-block:dynamic my-block  # Create new dynamic block
```

## Troubleshooting

### Build Issues
- Run `npm install` if build fails with missing dependencies
- Restart `npm run start` if new files aren't detected
- Check `css/` and `js/` directories for compiled assets

### Block Issues
- Compiled blocks appear in `blocks/` directory
- Check browser console for JavaScript errors
- Verify block registration in WordPress admin

### Styling Issues
- Block-specific styles should be in `src/scss/blocks/`
- Global styles are in `src/scss/` and compiled to `css/`
- Tailwind classes are processed through PostCSS
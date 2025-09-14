#!/bin/bash

# Build all themes that have package.json files
echo "🔍 Scanning for buildable themes..."

for theme_dir in wp-content/themes/*/; do
    # Skip if not a directory
    [ -d "$theme_dir" ] || continue

    # Check if theme has package.json
    if [ -f "${theme_dir}package.json" ]; then
        theme_name=$(basename "$theme_dir")
        echo "🏗️  Building theme: $theme_name"

        # Enter theme directory
        cd "$theme_dir"

        # Install npm dependencies
        echo "📦 Installing npm dependencies for $theme_name..."
        npm ci --production=false

        # Install composer dependencies if composer.json exists
        if [ -f "composer.json" ]; then
            echo "🎼 Installing composer dependencies for $theme_name..."
            composer install --no-dev --optimize-autoloader
        fi

        # Run build if build script exists
        if npm run | grep -q "build"; then
            echo "🚀 Building assets for $theme_name..."
            npm run build
        else
            echo "⚠️  No build script found for $theme_name, skipping..."
        fi

        # Clean up node_modules to save space
        echo "🧹 Cleaning up node_modules for $theme_name..."
        rm -rf node_modules

        # Remove source files if they exist (keep built assets)
        rm -rf resources/css resources/js resources/images resources/fonts src

        # Return to root directory
        cd - > /dev/null

        echo "✅ Completed building $theme_name"
        echo ""
    else
        theme_name=$(basename "$theme_dir")
        echo "⏭️  Skipping $theme_name (no package.json)"
    fi
done

echo "🎉 All themes built successfully!"
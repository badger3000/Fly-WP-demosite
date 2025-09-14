#!/bin/bash

# Start Apache in the background
apache2-foreground &

# Wait for Apache to start
sleep 5

# Check if Apache is running
while ! curl -f http://localhost/health.php > /dev/null 2>&1; do
    echo "Waiting for Apache to start..."
    sleep 2
done

echo "✅ Apache is running and ready!"

# Keep the container running
wait
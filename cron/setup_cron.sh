#!/bin/bash

# Setup script for monthly email cron job
# This script will help you set up the cron job for automatic email sending

echo "=== Monthly Email Cron Job Setup ==="
echo ""

# Get the absolute path of the project
PROJECT_PATH="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
CRON_SCRIPT="$PROJECT_PATH/cron/monthly_email.php"
LOG_FILE="$PROJECT_PATH/cron/logs/monthly_email.log"

echo "Project path: $PROJECT_PATH"
echo "Cron script: $CRON_SCRIPT"
echo "Log file: $LOG_FILE"
echo ""

# Create logs directory if it doesn't exist
mkdir -p "$(dirname "$LOG_FILE")"
echo "✅ Created logs directory"

# Make the cron script executable
chmod +x "$CRON_SCRIPT"
echo "✅ Made cron script executable"

# Check if PHP is available
if ! command -v php &> /dev/null; then
    echo "❌ PHP is not installed or not in PATH"
    exit 1
fi
echo "✅ PHP is available: $(php --version | head -n1)"

# Test the cron script
echo ""
echo "🧪 Testing the cron script..."
php "$CRON_SCRIPT" --test

# Create the cron entry
CRON_ENTRY="15 18 11 * * /usr/bin/php $CRON_SCRIPT >> $LOG_FILE 2>&1"

echo ""
echo "📅 Recommended cron entry:"
echo "$CRON_ENTRY"
echo ""

# Ask user if they want to install the cron job
read -p "Do you want to install this cron job? (y/n): " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]; then
    # Check if the cron entry already exists
    if crontab -l 2>/dev/null | grep -q "monthly_email.php"; then
        echo "⚠️  Cron job already exists. Removing old entry..."
        crontab -l 2>/dev/null | grep -v "monthly_email.php" | crontab -
    fi
    
    # Add the new cron entry
    (crontab -l 2>/dev/null; echo "$CRON_ENTRY") | crontab -
    echo "✅ Cron job installed successfully!"
else
    echo "❌ Cron job installation cancelled"
    echo ""
    echo "To install manually, run:"
    echo "crontab -e"
    echo ""
    echo "And add this line:"
    echo "$CRON_ENTRY"
fi

echo ""
echo "=== Setup Complete ==="
echo ""
echo "📋 Summary:"
echo "- Cron script: $CRON_SCRIPT"
echo "- Schedule: 15th minute of 18th hour (6:15 PM) on the 11th day of every month"
echo "- Log file: $LOG_FILE"
echo ""
echo "🔧 To test the cron job manually:"
echo "php $CRON_SCRIPT --force"
echo ""
echo "📊 To view logs:"
echo "tail -f $LOG_FILE"
echo ""
echo "⚠️  Important:"
echo "- Make sure the SMTP credentials are correct in the cron script"
echo "- Ensure your server can send emails (firewall, ports, etc.)"
echo "- Check the logs if emails are not being sent"

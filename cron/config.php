<?php
// Configuration file for monthly email cron job
// This file contains all the settings for the automated email system

return [
    // SMTP Configuration
    'smtp' => [
        'host' => 'smtp.gmail.com',
        'port' => 465,
        'secure' => 'PHPMailer::ENCRYPTION_SMTPS', // or 'PHPMailer::ENCRYPTION_STARTTLS'
        'username' => 'manuesteban1990@gmail.com',
        'password' => 'ipwvkliwipobedeh',
        'from_email' => 'mailer1990@gmail.com',
        'from_name' => 'Monthly Newsletter System',
        'to_email' => 'manuesteban1990@gmail.com',
        'to_name' => 'Manuel User'
    ],
    
    // Schedule Configuration
    'schedule' => [
        // Day of month (1-31) - 11 means the 11th day of each month
        'day_of_month' => 11,
        
        // Hour in 24-hour format (0-23) - 18 means 6 PM
        'hour' => 18,
        
        // Minute (0-59) - 15 means 15 minutes past the hour
        'minute' => 15,
        
        // Timezone for scheduling
        'timezone' => 'UTC'
    ],
    
    // Email Content Configuration
    'email' => [
        'subject_prefix' => 'Monthly Newsletter',
        'template_style' => 'professional', // or 'casual', 'minimal'
        'include_signature' => true,
        'signature_name' => 'Automated Newsletter System',
        'signature_title' => 'PHP Mail Cron Job Service',
        'company_name' => 'Your Company Name',
        'company_website' => 'https://yourwebsite.com'
    ],
    
    // Logging Configuration
    'logging' => [
        'enabled' => true,
        'log_file' => __DIR__ . '/logs/monthly_email.log',
        'max_file_size' => '10MB', // Maximum log file size before rotation
        'backup_count' => 5 // Number of backup log files to keep
    ],
    
    // Security Configuration
    'security' => [
        'allowed_ips' => [], // Array of IPs allowed to run the script, empty means any IP
        'require_auth' => false, // Set to true to require authentication
        'auth_token' => 'your_secure_token_here' // Token for authentication if required
    ],
    
    // Development/Testing Configuration
    'development' => [
        'test_mode' => false, // Set to true to enable test mode
        'test_email' => 'test@example.com', // Email to use in test mode
        'debug_mode' => false, // Enable detailed debugging
        'dry_run' => false // Set to true to simulate sending without actually sending
    ]
];
?>

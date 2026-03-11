<?php
// Monthly email sender cron job
// This script sends automatic emails once per month at the specified time

require_once __DIR__ . '/../libs/vendor/autoload.php';
require_once __DIR__ . '/../components/lang.php';

// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Configuration
$config = [
    'smtp_host' => 'smtp.gmail.com',
    'smtp_port' => 465,
    'smtp_secure' => PHPMailer::ENCRYPTION_SMTPS,
    'smtp_username' => 'manuesteban1990@gmail.com',
    'smtp_password' => 'ipwvkliwipobedeh',
    'from_email' => 'mailer1990@gmail.com',
    'from_name' => 'Monthly Newsletter',
    'to_email' => 'manuesteban1990@gmail.com',
    'to_name' => 'Manuel User'
];

// Email content with signature
function getEmailContent() {
    $currentMonth = date('F');
    $currentYear = date('Y');
    
    $content = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .header { background-color: #2c3e50; color: white; padding: 20px; text-align: center; }
            .content { padding: 20px; background-color: #f9f9f9; }
            .footer { background-color: #34495e; color: white; padding: 15px; text-align: center; }
            .signature { border-top: 1px solid #bdc3c7; padding-top: 15px; margin-top: 20px; }
        </style>
    </head>
    <body>
        <div class='header'>
            <h2>📧 Monthly Newsletter - {$currentMonth} {$currentYear}</h2>
        </div>
        
        <div class='content'>
            <h3>Hello!</h3>
            <p>Welcome to your monthly newsletter for <strong>{$currentMonth} {$currentYear}</strong>.</p>
            
            <h4>This Month's Highlights:</h4>
            <ul>
                <li>✅ System performance has been excellent</li>
                <li>📊 All services are running smoothly</li>
                <li>🔒 Security updates have been applied</li>
                <li>🚀 New features are being developed</li>
            </ul>
            
            <p>This is an automated message sent through our monthly cron job system. 
            If you have any questions or need assistance, please don't hesitate to contact us.</p>
        </div>
        
        <div class='signature'>
            <p><strong>Best regards,</strong></p>
            <p><em>Automated Newsletter System</em><br>
            PHP Mail Cron Job Service<br>
            <small>📅 Sent on " . date('Y-m-d H:i:s') . "</small></p>
        </div>
        
        <div class='footer'>
            <p><small>This is an automated message. Please do not reply to this email.</small></p>
        </div>
    </body>
    </html>";
    
    return $content;
}

// Logging function
function logMessage($message) {
    $logFile = __DIR__ . '/logs/monthly_email.log';
    $timestamp = date('Y-m-d H:i:s');
    $logEntry = "[{$timestamp}] {$message}" . PHP_EOL;
    
    // Create logs directory if it doesn't exist
    $logDir = dirname($logFile);
    if (!file_exists($logDir)) {
        mkdir($logDir, 0755, true);
    }
    
    file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);
}

// Main email sending function
function sendMonthlyEmail($config) {
    try {
        // Create PHPMailer instance
        $mail = new PHPMailer(true);
        
        // Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF; // Disable debug for cron
        $mail->isSMTP();
        $mail->Host = $config['smtp_host'];
        $mail->SMTPAuth = true;
        $mail->Username = $config['smtp_username'];
        $mail->Password = $config['smtp_password'];
        $mail->SMTPSecure = $config['smtp_secure'];
        $mail->Port = $config['smtp_port'];
        
        // Recipients
        $mail->setFrom($config['from_email'], $config['from_name']);
        $mail->addAddress($config['to_email'], $config['to_name']);
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = "Monthly Newsletter - " . date('F Y');
        $mail->Body = getEmailContent();
        $mail->AltBody = strip_tags(getEmailContent());
        
        // Send email
        $mail->send();
        
        logMessage("SUCCESS: Monthly email sent successfully to " . $config['to_email']);
        return true;
        
    } catch (Exception $e) {
        $errorMessage = "ERROR: Failed to send monthly email. Mailer Error: " . $mail->ErrorInfo;
        logMessage($errorMessage);
        return false;
    }
}

// Check if this is the right time to run (additional safety check)
function shouldRunNow() {
    $currentDay = (int)date('d');
    $currentHour = (int)date('H');
    $currentMinute = (int)date('i');
    
    // Run on the 11th day of the month at 18:15 (6:15 PM)
    return ($currentDay === 11 && $currentHour === 18 && $currentMinute === 15);
}

// Main execution
if (shouldRunNow() || isset($argv[1]) && $argv[1] === '--force') {
    logMessage("INFO: Starting monthly email sender script");
    
    if (sendMonthlyEmail($config)) {
        logMessage("INFO: Monthly email process completed successfully");
        echo "Monthly email sent successfully!\n";
    } else {
        logMessage("ERROR: Monthly email process failed");
        echo "Failed to send monthly email. Check logs for details.\n";
        exit(1);
    }
} else {
    logMessage("INFO: Script executed but not scheduled time - skipping email send");
    echo "Not the scheduled time for monthly email. Use --force to override.\n";
}
?>

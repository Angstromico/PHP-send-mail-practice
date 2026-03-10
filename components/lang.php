<?php
function getLanguage() {
    // Check if language is set in session
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // Get language from session, cookie, or browser preference
    $lang = $_SESSION['lang'] ?? $_COOKIE['lang'] ?? null;
    
    if (!$lang) {
        // Detect browser language
        $browserLang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? 'en', 0, 2);
        $lang = in_array($browserLang, ['en', 'es']) ? $browserLang : 'en';
    }
    
    return $lang;
}

function setLanguage($lang) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // Validate language
    if (in_array($lang, ['en', 'es'])) {
        $_SESSION['lang'] = $lang;
        setcookie('lang', $lang, time() + (86400 * 30), "/"); // 30 days
        return true;
    }
    
    return false;
}

function t($key) {
    static $translations = null;
    
    if ($translations === null) {
        $lang = getLanguage();
        $translations = require __DIR__ . "/../lang/{$lang}.php";
    }
    
    return $translations[$key] ?? $key;
}

function changeLanguage($lang) {
    if (setLanguage($lang)) {
        // Redirect to remove language parameter from URL
        $redirect = $_SERVER['PHP_SELF'];
        header("Location: {$redirect}");
        exit();
    }
}

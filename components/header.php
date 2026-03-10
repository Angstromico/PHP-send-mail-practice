<?php
require_once 'lang.php';
?>

<header class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom border-secondary">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">
            <i class="bi bi-envelope-fill me-2"></i><?php echo t('contact_form'); ?>
        </a>
        
        <div class="ms-auto d-flex align-items-center">
            <div class="dropdown">
                <button class="btn btn-outline-light btn-sm dropdown-toggle d-flex align-items-center" 
                        type="button" 
                        id="languageDropdown" 
                        data-bs-toggle="dropdown" 
                        aria-expanded="false">
                    <i class="bi bi-globe me-1"></i>
                    <?php echo t('language'); ?>
                    <span class="ms-1 badge bg-primary"><?php echo strtoupper(getLanguage()); ?></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                    <li>
                        <a class="dropdown-item d-flex align-items-center <?php echo getLanguage() === 'en' ? 'active' : ''; ?>" 
                           href="?lang=en">
                            <span class="flag-icon flag-icon-us me-2">🇺🇸</span>
                            English
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center <?php echo getLanguage() === 'es' ? 'active' : ''; ?>" 
                           href="?lang=es">
                            <span class="flag-icon flag-icon-es me-2">🇪🇸</span>
                            Español
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>

<?php
// Handle language change
if (isset($_GET['lang'])) {
    changeLanguage($_GET['lang']);
}
?>

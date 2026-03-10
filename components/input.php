<?php
function renderInput($props) {
    $label = $props['label'] ?? 'Field';
    $name  = $props['name'] ?? 'field';
    $id    = $props['id'] ?? $name;
    $type  = $props['type'] ?? 'text';
    $placeholder = $props['placeholder'] ?? '';
    
    $isTextArea = $props['isTextArea'] ?? false;
    $rows = $props['rows'] ?? 3;

    echo "<div class='mb-3'>";
    echo "<label for='{$id}' class='form-label'>{$label}:</label>";

    if ($isTextArea) {
        echo "
        <textarea
            class='form-control'
            name='{$name}'
            id='{$id}'
            rows='{$rows}'
            placeholder='{$placeholder}'
        ></textarea>";
    } else {
        echo "
        <input
            type='{$type}'
            class='form-control'
            name='{$name}'
            id='{$id}'
            placeholder='{$placeholder}'
        />";
    }

    echo "</div>";
}
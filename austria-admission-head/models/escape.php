<?php
function e($s) {
    if ($s === null) return '';
    return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
}

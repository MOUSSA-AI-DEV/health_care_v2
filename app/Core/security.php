<?php
namespace App\Core;

final class Security {
    public static function e(?string $v): string {
        return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8');
    }
}

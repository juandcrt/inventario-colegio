<?php

namespace App\Helpers;

class Permissions
{
    public static function canEdit(): bool
    {
        $user = auth()->user();
        if (!$user) return false;

        return in_array($user->role, ['admin', 'directiva']);
    }

    public static function canViewLibrary(): bool
    {
        $user = auth()->user();
        if (!$user) return false;

        return in_array($user->role, ['admin', 'directiva', 'bibliotecario']);
    }

    public static function canViewTic(): bool
    {
        $user = auth()->user();
        if (!$user) return false;

        return in_array($user->role, ['admin', 'directiva', 'tic']);
    }

    public static function canViewInventory(): bool
    {
        $user = auth()->user();
        if (!$user) return false;

        return in_array($user->role, ['admin', 'directiva', 'bibliotecario', 'tic']);
    }

    public static function canExport(): bool
    {
        return self::canEdit();
    }
}
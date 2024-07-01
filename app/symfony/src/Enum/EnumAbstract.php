<?php

namespace App\Enum;

class EnumAbstract
{
    public static function getTypesLabels(): array
    {
        return static::PRIORITIES_TRANS_KEYS;
    }

    public static function getTypeLabel(string $type): string
    {
        return static::PRIORITIES_TRANS_KEYS[$type] ?? '';
    }

    public static function getStyleLabel(string $type): string
    {
        return static::PRIORITIES_STYLE_KEYS[$type];
    }
}
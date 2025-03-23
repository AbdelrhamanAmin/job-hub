<?php

namespace App\Constants;

interface FilterOperators
{
    public const EQUAL = '=';
    public const NOT_EQUAL = '!=';
    public const GREATER_THAN = '>';
    public const LESS_THAN = '<';
    public const GREATER_THAN_OR_EQUAL = '>=';
    public const LESS_THAN_OR_EQUAL = '<=';
    public const LIKE = 'like';
    public const IN = 'in';

    public const ALL_OPERATORS = [
        self::EQUAL,
        self::NOT_EQUAL,
        self::GREATER_THAN,
        self::LESS_THAN,
        self::GREATER_THAN_OR_EQUAL,
        self::LESS_THAN_OR_EQUAL,
        self::LIKE,
        self::IN,
    ];
}

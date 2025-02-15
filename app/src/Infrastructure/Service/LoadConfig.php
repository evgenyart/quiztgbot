<?php

declare(strict_types=1);

namespace App\Infrastructure\Service;

class LoadConfig
{
    public static function loadConfigParam($paramName)
    {

        if (!isset($_ENV[$paramName])) {
            throw new \DomainException("No isset {$paramName} in .env");
        }
        return $_ENV[$paramName];
    }
}

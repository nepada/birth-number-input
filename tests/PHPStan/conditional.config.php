<?php
declare(strict_types = 1);

use Composer\InstalledVersions;
use Composer\Semver\VersionParser;

$config = ['parameters' => ['ignoreErrors' => []]];

if (InstalledVersions::satisfies(new VersionParser(), 'nepada/birth-number', '<=1.1.0')) {
    $config['parameters']['ignoreErrors'][] = [
        'message' => '~Dead catch \\- Nepada\\\\BirthNumber\\\\InvalidBirthNumberException is never thrown in the try block\\.~',
        'path' => __DIR__ . '/../../src/BirthNumberInput/Validator.php',
        'count' => 1,
    ];
}

return $config;

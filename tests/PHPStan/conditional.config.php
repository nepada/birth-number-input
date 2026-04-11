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

if (! InstalledVersions::satisfies(new VersionParser(), 'nette/forms', '<=3.2.8')) {
    $config['parameters']['ignoreErrors'][] = [
        'message' => '~^Parameter \\#2 \\$callback of static method Nette\\\\Forms\\\\Container\\:\\:extensionMethod\\(\\) expects callable\\(Nette\\\\Forms\\\\Container\\)\\: mixed, Closure\\(Nette\\\\Forms\\\\Container, int\\|string, Nette\\\\Utils\\\\Html\\|string\\|null\\=\\)\\: Nepada\\\\BirthNumberInput\\\\BirthNumberInput given\\.$~',
        'path' => __DIR__ . '/../../src/Bridges/BirthNumberInputForms/ExtensionMethodRegistrator.php',
        'count' => 1,
    ];
}

return $config;

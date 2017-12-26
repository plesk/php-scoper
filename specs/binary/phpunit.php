<?php

declare(strict_types=1);

/*
 * This file is part of the humbug/php-scoper package.
 *
 * Copyright (c) 2017 Théo FIDRY <theo.fidry@gmail.com>,
 *                    Pádraic Brady <padraic.brady@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    'meta' => [
        'title' => 'PHPUnit binary file',
        // Default values. If not specified will be the one used
        'prefix' => 'Humbug',
        'whitelist' => [],
    ],

    '' => <<<'PHP'
#!/usr/bin/env php
<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

if (version_compare('7.0.0', PHP_VERSION, '>')) {
    fwrite(
        STDERR,
        sprintf(
            'This version of PHPUnit is supported on PHP 7.0 and PHP 7.1.' . PHP_EOL .
            'You are using PHP %s (%s).' . PHP_EOL,
            PHP_VERSION,
            PHP_BINARY
        )
    );

    die(1);
}

if (!ini_get('date.timezone')) {
    ini_set('date.timezone', 'UTC');
}

foreach (array(__DIR__ . '/../../autoload.php', __DIR__ . '/../vendor/autoload.php', __DIR__ . '/vendor/autoload.php') as $file) {
    if (file_exists($file)) {
        define('PHPUNIT_COMPOSER_INSTALL', $file);

        break;
    }
}

unset($file);

if (!defined('PHPUNIT_COMPOSER_INSTALL')) {
    fwrite(
        STDERR,
        'You need to set up the project dependencies using Composer:' . PHP_EOL . PHP_EOL .
        '    composer install' . PHP_EOL . PHP_EOL .
        'You can learn all about Composer on https://getcomposer.org/.' . PHP_EOL
    );

    die(1);
}

require PHPUNIT_COMPOSER_INSTALL;

PHPUnit\TextUI\Command::main();

----
#!/usr/bin/env php
<?php 
declare (strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
if (\version_compare('7.0.0', \PHP_VERSION, '>')) {
    \fwrite(\STDERR, \sprintf('This version of PHPUnit is supported on PHP 7.0 and PHP 7.1.' . \PHP_EOL . 'You are using PHP %s (%s).' . \PHP_EOL, \PHP_VERSION, \PHP_BINARY));
    die(1);
}
if (!\ini_get('date.timezone')) {
    \ini_set('date.timezone', 'UTC');
}
foreach (array(__DIR__ . '/../../autoload.php', __DIR__ . '/../vendor/autoload.php', __DIR__ . '/vendor/autoload.php') as $file) {
    if (\file_exists($file)) {
        \define('PHPUNIT_COMPOSER_INSTALL', $file);
        break;
    }
}
unset($file);
if (!\defined('PHPUNIT_COMPOSER_INSTALL')) {
    \fwrite(\STDERR, 'You need to set up the project dependencies using Composer:' . \PHP_EOL . \PHP_EOL . '    composer install' . \PHP_EOL . \PHP_EOL . 'You can learn all about Composer on https://getcomposer.org/.' . \PHP_EOL);
    die(1);
}
require \PHPUNIT_COMPOSER_INSTALL;
\Humbug\PHPUnit\TextUI\Command::main();

PHP
    ,
];

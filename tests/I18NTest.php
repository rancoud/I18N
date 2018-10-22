<?php

declare(strict_types=1);

namespace Rancoud\I18N\Test;

use PHPUnit\Framework\TestCase;
use Rancoud\I18N\I18N;

/**
 * Class I18NTest.
 */
class I18NTest extends TestCase
{
    public function testConstruct()
    {
        new I18N();
        static::assertTrue(true);
    }
}

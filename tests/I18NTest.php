<?php

declare(strict_types=1);

namespace Rancoud\I18N\Test;

use PHPUnit\Framework\TestCase;
use Rancoud\I18N\I18NException;
use Rancoud\I18N\I18N;

/**
 * Class I18NTest.
 */
class I18NTest extends TestCase
{
    public function testDefaultsNotSet()
    {
        static::expectException(I18NException::class);
        static::expectExceptionMessage('Defaults not set');

        I18N::get('aaa');
    }

    public function testDefaultsWrongDirectory()
    {
        static::expectException(I18NException::class);
        static::expectExceptionMessage('Directory aaa not found');

        I18N::setDefaults('aaa', 'bbb');
    }

    public function testDefaultsWrongLanguage()
    {
        static::expectException(I18NException::class);
        static::expectExceptionMessage('Language bbb not found');

        I18N::setDefaults(__DIR__, 'bbb');
    }

    public function testDefaults()
    {
        I18N::setDefaults(__DIR__, 'en');
        $a = I18N::get('a');
        static::assertSame('a', $a);
    }

    public function testEchoDefault()
    {
        I18N::setDefaults(__DIR__, 'en');
        ob_start();
        I18N::echo('start');
        $a = ob_get_contents();
        ob_end_clean();
        static::assertSame('Hello', $a);
    }

    public function testGetDefault()
    {
        I18N::setDefaults(__DIR__, 'en');
        $a = I18N::get('stop');
        static::assertSame('Goodbye', $a);
    }

    public function testEchoFr()
    {
        I18N::setDefaults(__DIR__, 'en');
        ob_start();
        I18N::echo('start', 'fr');
        $a = ob_get_contents();
        ob_end_clean();
        static::assertSame('Bonjour', $a);
    }

    public function testGetFr()
    {
        I18N::setDefaults(__DIR__, 'en');
        $a = I18N::get('stop', 'fr');
        static::assertSame('Au revoir', $a);
    }

    public function testEchoMissingLang()
    {
        static::expectException(I18NException::class);
        static::expectExceptionMessage('Language jp not found');

        I18N::setDefaults(__DIR__, 'en');
        I18N::echo('a', 'jp');
    }

    public function testGetMissingLang()
    {
        static::expectException(I18NException::class);
        static::expectExceptionMessage('Language jp not found');

        I18N::setDefaults(__DIR__, 'en');
        I18N::get('a', 'jp');
    }
}

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
    public function testDefaultsNotSet(): void
    {
        $this->expectException(I18NException::class);
        $this->expectExceptionMessage('Defaults not set');

        I18N::get('aaa');
    }

    public function testDefaultsWrongDirectory(): void
    {
        $this->expectException(I18NException::class);
        $this->expectExceptionMessage('Directory aaa not found');

        I18N::setDefaults('aaa', 'bbb');
    }

    public function testDefaultsWrongLanguage(): void
    {
        $this->expectException(I18NException::class);
        $this->expectExceptionMessage('Language bbb not found');

        I18N::setDefaults(__DIR__, 'bbb');
    }

    /**
     * @throws I18NException
     */
    public function testDefaults(): void
    {
        I18N::setDefaults(__DIR__, 'en');
        static::assertSame('a', I18N::get('a'));
    }

    /**
     * @throws I18NException
     */
    public function testEchoDefault(): void
    {
        I18N::setDefaults(__DIR__, 'en');
        ob_start();
        I18N::echo('start');
        static::assertSame('Hello', ob_get_clean());
    }

    /**
     * @throws I18NException
     */
    public function testGetDefault(): void
    {
        I18N::setDefaults(__DIR__, 'en');
        static::assertSame('Goodbye', I18N::get('stop'));
    }

    /**
     * @throws I18NException
     */
    public function testEchoFr(): void
    {
        I18N::setDefaults(__DIR__, 'en');
        ob_start();
        I18N::echo('start', 'fr');
        static::assertSame('Bonjour', ob_get_clean());
    }

    /**
     * @throws I18NException
     */
    public function testGetFr(): void
    {
        I18N::setDefaults(__DIR__, 'en');
        $a = I18N::get('stop', 'fr');
        static::assertSame('Au revoir', $a);
    }

    public function testEchoMissingLang(): void
    {
        $this->expectException(I18NException::class);
        $this->expectExceptionMessage('Language jp not found');

        I18N::setDefaults(__DIR__, 'en');
        I18N::echo('a', 'jp');
    }

    public function testGetMissingLang(): void
    {
        $this->expectException(I18NException::class);
        $this->expectExceptionMessage('Language jp not found');

        I18N::setDefaults(__DIR__, 'en');
        I18N::get('a', 'jp');
    }
}

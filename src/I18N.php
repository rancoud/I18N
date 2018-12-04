<?php

declare(strict_types=1);

namespace Rancoud\I18N;

/**
 * Class I18N.
 */
class I18N
{
    protected static $defaultDirectory = null;

    protected static $defaultLanguage = null;

    protected static $langs = [];

    /**
     * @param string $directory
     * @param string $language
     *
     * @throws I18NException
     */
    public static function setDefaults(string $directory, string $language): void
    {
        if (!\file_exists($directory) || !\is_dir($directory)) {
            throw new I18NException(\sprintf('Directory %s not found', $directory));
        }
        static::$defaultDirectory = $directory;

        static::getLangContent($language);
        static::$defaultLanguage = $language;
    }

    /**
     * @param string      $key
     * @param string|null $language
     *
     * @throws I18NException
     */
    public static function echo(string $key, string $language = null): void
    {
        echo static::getKey($key, $language);
    }

    /**
     * @param string      $key
     * @param string|null $language
     *
     * @throws I18NException
     *
     * @return string
     */
    public static function get(string $key, string $language = null): string
    {
        return static::getKey($key, $language);
    }

    /**
     * @param string $language
     *
     * @throws I18NException
     */
    protected static function getLangContent(string $language): void
    {
        if (isset(static::$langs[$language])) {
            return;
        }

        $filepath = static::$defaultDirectory . \DIRECTORY_SEPARATOR . $language . '.php';
        if (!\file_exists($filepath)) {
            throw new I18NException(\sprintf('Language %s not found', $language));
        }

        static::$langs[$language] = include $filepath;
    }

    /**
     * @throws I18NException
     */
    protected static function checkDefaults(): void
    {
        if (static::$defaultDirectory === null || static::$defaultLanguage === null) {
            throw new I18NException('Defaults not set');
        }
    }

    /**
     * @param string      $key
     * @param string|null $language
     *
     * @throws I18NException
     *
     * @return string
     */
    protected static function getKey(string $key, string $language = null): string
    {
        static::checkDefaults();

        if ($language === null) {
            $language = static::$defaultLanguage;
        } else {
            static::getLangContent($language);
        }

        return isset(static::$langs[$language][$key]) ? static::$langs[$language][$key] : $key;
    }
}

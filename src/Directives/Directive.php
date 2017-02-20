<?php
/**
 * Copyright (c) 2017. Robin Radic.
 *
 * The license can be found in the package and online at https://radic.mit-license.org.
 *
 * @copyright Copyright 2017 (c) Robin Radic
 * @license https://radic.mit-license.org The MIT License
 */

namespace Radic\BladeExtensions\Directives;

//use Composer\Semver\Semver;

use Composer\Semver\Semver;

abstract class Directive
{
    protected $pattern = '/(?<!\\w)(\\s*)@NAME(\\s*)/';

    protected $replace;

    protected $name;

    public static $compatibility = '5.*';

    public static function isCompatibleWithVersion($version)
    {
        return Semver::satisfies($version, static::$compatibility);
    }

    public static function isCompatible()
    {
        return static::isCompatibleWithVersion(\Illuminate\Foundation\Application::VERSION);
    }

    public function handle($value)
    {
        return preg_replace($this->getProcessedPattern(), $this->replace, $value);
    }



    protected function getProcessedPattern()
    {
        return str_replace('NAME', $this->name, $this->pattern);
    }

    /**
     * @return string
     */
    public function getPattern()
    {
        return $this->pattern;
    }

    /**
     * Set the pattern value.
     *
     * @param string $pattern
     *
     * @return Directive
     */
    public function setPattern($pattern)
    {
        $this->pattern = $pattern;

        return $this;
    }

    /**
     * @return string
     */
    public function getReplace()
    {
        return $this->replace;
    }

    /**
     * Set the replace value.
     *
     * @param string $replace
     *
     * @return Directive
     */
    public function setReplace($replace)
    {
        $this->replace = $replace;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the name value.
     *
     * @param string $name
     *
     * @return Directive
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}

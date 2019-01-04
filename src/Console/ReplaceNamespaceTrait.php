<?php

/*
 * This file is part of the Sericode package.
 *
 * (c) Nguyễn Xuân Quỳnh <nguyen.xuan.quynh@sericode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sericode\Laravel\Console;

trait ReplaceNamespaceTrait
{
    /**
     * Replaces interface name and parent name for given stub
     *
     * @param  string  $stub
     * @param  string  $name
     * @return self
     */
    public function replaceNamespace(&$stub, $name)
    {
        if (!$parent = $this->option('extends')) {
            return parent::replaceNamespace($stub, $name);
        }

        $namespace = $this->getNamespace($name);
        $name = trim(substr($name, strrpos($name, '\\')), '\\');
        $parentName = trim(substr($parent, strrpos($parent, '\\')), '\\');

        $stub = str_replace(
            [
                'DummyNamespace',
                'DummyClass',
                'DummyParentFullName',
                'DummyParentName',
            ],
            [
                $namespace,
                $name,
                $parent,
                $parentName,
            ],
            $stub
        );

        return $this;
    }
}

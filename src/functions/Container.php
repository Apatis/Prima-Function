<?php
/**
 * MIT License
 *
 * Copyright (c) 2017 Pentagonal Development
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NON INFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 */

namespace Apatis\Container;

use function Apatis\Container;

/**
 * @param string $name
 * @param mixed|callable $value
 */
function Set($name, $value)
{
    /**
     * @var Container
     */
    $container = Container();
    $container[$name] = $value;
}

/**
 * @param string $name
 *
 * @return mixed
 * @throws \Psr\Container\ContainerExceptionInterface
 * @throws \Psr\Container\NotFoundExceptionInterface
 */
function Get($name)
{
    return Container()->get($name);
}

/**
 * @param string $name
 */
function Remove($name)
{
    $container = Container();
    unset($container[$name]);
}

/**
 * @param string $name
 *
 * @return bool
 */
function Exist($name) : bool
{
    return Container()->has($name);
}

/**
 * @param string $name
 *
 * @return bool
 */
function Has($name) : bool
{
    return exist($name);
}

/**
 * @param callable $callable
 *
 * @return callable
 * @throws \Psr\Container\ContainerExceptionInterface
 */
function Protect(callable $callable) : callable
{
    return Container()->protect($callable);
}

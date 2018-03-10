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

namespace Apatis\Route;

use function Apatis\Service;

/**
 * @param string $pattern
 * @param $callable
 *
 * @return RouteGroupInterface
 */
function Group(string $pattern, $callable) : RouteGroupInterface
{
    return Service()->group($pattern, $callable);
}

/**
 * @param array $methods
 * @param string $pattern
 * @param $callable
 *
 * @return RouteInterface
 */
function Map(array $methods, string $pattern, $callable) : RouteInterface
{
    return Service()->map($methods, $pattern, $callable);
}

/**
 * @param string $pattern
 * @param $callable
 *
 * @return RouteInterface
 */
function Get(string $pattern, $callable) : RouteInterface
{
    return Map(['GET'], $pattern, $callable);
}

/**
 * @param string $pattern
 * @param $callable
 *
 * @return RouteInterface
 */
function Post(string $pattern, $callable) : RouteInterface
{
    return Map(['POST'], $pattern, $callable);
}

/**
 * @param string $pattern
 * @param $callable
 *
 * @return RouteInterface
 */
function Put(string $pattern, $callable) : RouteInterface
{
    return Map(['PUT'], $pattern, $callable);
}

/**
 * @param string $pattern
 * @param $callable
 *
 * @return RouteInterface
 */
function Delete(string $pattern, $callable) : RouteInterface
{
    return Map(['DELETE'], $pattern, $callable);
}

/**
 * @param string $pattern
 * @param $callable
 *
 * @return RouteInterface
 */
function Patch(string $pattern, $callable) : RouteInterface
{
    return Map(['PATCH'], $pattern, $callable);
}

/**
 * @param string $pattern
 * @param $callable
 *
 * @return RouteInterface
 */
function Options(string $pattern, $callable) : RouteInterface
{
    return Map(['OPTIONS'], $pattern, $callable);
}

/**
 * @param string $pattern
 * @param $callable
 *
 * @return RouteInterface
 */
function Head(string $pattern, $callable) : RouteInterface
{
    return Map(['HEAD'], $pattern, $callable);
}

/**
 * @param string $pattern
 * @param $callable
 *
 * @return RouteInterface
 */
function Trace(string $pattern, $callable) : RouteInterface
{
    return Map(['TRACE'], $pattern, $callable);
}

/**
 * @param string $pattern
 * @param $callable
 *
 * @return RouteInterface
 */
function Connect(string $pattern, $callable) : RouteInterface
{
    return Map(['CONNECT'], $pattern, $callable);
}

/**
 * @param string $pattern
 * @param $callable
 *
 * @return RouteInterface
 */
function Any(string $pattern, $callable) : RouteInterface
{
    return Map(Service()->getStandardHttpRequestMethods(), $pattern, $callable);
}

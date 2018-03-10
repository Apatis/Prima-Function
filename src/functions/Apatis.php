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
 */

namespace Apatis;

use Apatis\Config\Config;
use Apatis\Config\ConfigInterface;
use Apatis\Container\Container;
use Apatis\Http\Message\Response;
use Apatis\Http\Message\Stream;
use Apatis\Prima\Service;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * @param array|ConfigInterface|null $args
 *
 * @return ConfigInterface
 */
function &Config($args = null) : ConfigInterface
{
    static $config;
    if (!isset($config)) {
        $config = new Config();
    }

    if (is_array($args)) {
        $config->replace($args);
    } elseif ($args instanceof ConfigInterface) {
        $config->merge($args);
    }

    return $config;
}

/**
 * @return Service
 */
function &Service() : Service
{
    static $service;
    if (!isset($service)) {
        $service = new Service(Config());
    }

    return $service;
}

/**
 * @return ContainerInterface|Container
 */
function Container() : ContainerInterface
{
    return Service()->getContainer();
}

/**
 * Create Stream by Stream Definition Use Memory Or Not
 *
 * @return Stream
 */
function CreateStream() : Stream
{
    $target = defined('STREAM_USE_MEMORY') && STREAM_USE_MEMORY
        ? 'php://memory'
        : 'php://temp';
    $stream = new Stream(fopen($target, 'r+'));
    return $stream;
}

/**
 * @param bool $run true if serve into client
 * @param ResponseInterface|null $responseOverride
 *
 * @return ResponseInterface|Response|null
 */
function Response(ResponseInterface $responseOverride = null, $run = false)
{
    static $response = null;

    if ($response === null && $run) {
        $response = Service()->serve(false, CreateStream());
    }

    if ($responseOverride) {
        $response = $responseOverride;
    }

    return $response;
}

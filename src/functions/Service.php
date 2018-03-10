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

namespace Apatis\Service;

use function Apatis\Response;
use function Apatis\Service;
use Apatis\Handler\Response\ErrorHandlerInterface;
use Apatis\Handler\Response\ExceptionHandlerInterface;
use Apatis\Handler\Response\NotAllowedHandlerInterface;
use Apatis\Handler\Response\NotFoundHandlerInterface;
use Apatis\Prima\Service;
use Psr\Http\Message\ResponseInterface;

/**
 * @return ResponseInterface
 */
function Serve() : ResponseInterface
{
    $response = Response(null, true);
    if (Service()->getServedResponseCount() === 0) {
        Service()->serveResponse($response);
    }

    return $response;
}

/**
 * @param ResponseInterface $response
 */
function ServeResponse(ResponseInterface $response)
{
    Service()->serveResponse($response);
}

/**
 * @param NotFoundHandlerInterface $notFound
 *
 * @return Service
 */
function SetNotFoundHandler(NotFoundHandlerInterface $notFound) : Service
{
    return Service()->setNotFoundHandler($notFound);
}

/**
 * @return NotFoundHandlerInterface
 */
function GetNotFoundHandler() : NotFoundHandlerInterface
{
    return Service()->getNotFoundHandler();
}

/**
 * @param NotAllowedHandlerInterface $notAllowed
 *
 * @return Service
 */
function SetNotAllowedHandler(NotAllowedHandlerInterface $notAllowed) : Service
{
    return Service()->setNotAllowedHandler($notAllowed);
}

/**
 * @return NotAllowedHandlerInterface
 */
function GetNotAllowedHandler() : NotAllowedHandlerInterface
{
    return Service()->getNotAllowedHandler();
}

/**
 * @param ExceptionHandlerInterface $exception
 *
 * @return Service
 */
function SetExceptionHandler(ExceptionHandlerInterface $exception) : Service
{
    return Service()->setExceptionHandler($exception);
}

/**
 * @return ExceptionHandlerInterface
 */
function GetExceptionHandler() : ExceptionHandlerInterface
{
    return Service()->getExceptionHandler();
}

/**
 * @param ErrorHandlerInterface $error
 *
 * @return Service
 */
function SetErrorHandler(ErrorHandlerInterface $error) : Service
{
    return Service()->setErrorHandler($error);
}

/**
 * @return ErrorHandlerInterface
 */
function GetErrorHandler() : ErrorHandlerInterface
{
    return Service()->getErrorHandler();
}

/**
 * Add middleware
 *
 * @param callable $middleware
 *
 * @return Service
 */
function Add(callable $middleware) : Service
{
    return Service()->addMiddleware($middleware);
}

/**
 * Add middleware
 *
 * @param callable $middleware
 *
 * @return Service
 */
function AddMiddleware(callable $middleware) : Service
{
    return Add($middleware);
}

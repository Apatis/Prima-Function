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

namespace Apatis\Response;

use Apatis\Http\Message\Response;
use function Apatis\Response;
use Psr\Http\Message\ResponseInterface;

/**
 * Implement JSON Response
 *
 * @param ResponseInterface $response
 * @param $data
 * @param int $options
 * @param bool $override override existing Response global
 *      note: the header (application/json on current function) is not changed
 *
 * @return Response|ResponseInterface
 * @internal \RuntimeException
 */
function Json($data, $options = 0, ResponseInterface $response = null, bool $override = false) : ResponseInterface
{
    if (!$response) {
        $response = Response();
    } elseif ($override) {
        $response = Response($response);
    }
    $options = !is_numeric($options) || !is_int(abs($options))
        ? 0
        : abs($options);

    $data = json_encode($data, $options);
    if ($data === false) {
        throw new \RuntimeException(
            json_last_error_msg(),
            json_last_error()
        );
    }

    $response->getBody()->write($data);
    return $response->withHeader('Content-Type', 'application/json');
}

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

namespace {

    use Apatis\Config;
    use Apatis\Container;
    use Apatis\Http\Cookie\CookiesInterface;
    use Apatis\Response;
    use Apatis\Service;
    use Apatis\Route;
    use Apatis\Http\Cookie\Cookies;
    use Psr\Http\Message\ResponseInterface;
    use Psr\Http\Message\ServerRequestInterface;

    require_once __DIR__ .'/../vendor/autoload.php';

    // define use memory to make stream use php://memory
    define('STREAM_USE_MEMORY', true);

    /* ----------------------------------
     * EXAMPLE TO SET CONFIG
     * ----------------------------------
     */
    // use instance config , set with array value
    Apatis\Config([
        'httpVersion' => '1.1',
        // or any
    ]);
    // set config
    Config\Set('displayErrors', true);

    /* ----------------------------------
     * EXAMPLE TO SET CONTAINER
     * ----------------------------------
     */
    Container\Set('cookie', function () : CookiesInterface {
        return new Cookies($_COOKIE);
    });

    // example to override function response
    Service\Add(function (ServerRequestInterface $request, ResponseInterface $response, callable $next) {
        return $next($request, Apatis\Response($response));
    });

    Route\Get(
        '/[{name: .+}]',
        function (ServerRequestInterface $request, ResponseInterface $response, array $params) {
            /**
             * Example get cookies
             *
             * @var CookiesInterface $cookie
             */
            $cookie = Container\Get('cookie');
            // if cookie does not exists set cookie
            if (!$cookie->exist('test-cookie')) {
                $cookie->set('test-cookie', 'value');
            }
            return Response\Json(
                [
                    "RouteParams"    => $params,
                    "QueryString"    => $request->getQueryParams(),
                    "RouteInfo"      => $request->getAttribute('routeInfo'),
                    "Cookies"         => $cookie->toCookieParams()
                ],
                JSON_PRETTY_PRINT,
                // set response
                $response->withHeader('Set-Cookie', $cookie->toHeaders()),
                // override global response
                true
            );
        }
    );

    // Serve
    return Service\Serve();
}

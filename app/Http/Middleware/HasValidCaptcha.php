<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class HasValidCaptcha
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next): Response
    {
        $turnstileCode = $request->input('cf-turnstile-response') ?? abort(400);

        dd($request->all(),  $turnstileCode, $next($request), $this->turnstileCodeIsValid($turnstileCode), config('services.cloudflare.turnstile.site_secret'));
        if (!$this->turnstileCodeIsValid($turnstileCode)) {
            abort(400);
        }

        return $next($request);
    }

    /**
     * Make an HTTP call to the Turnstile API to verify the code.
     */
    private function turnstileCodeIsValid(string $turnstileCode): bool
    {
        return Http::post(
            url: 'https://challenges.cloudflare.com/turnstile/v0/siteverify',
            data: [
                'secret' => config('services.cloudflare.turnstile.site_secret'),
                'response' => $turnstileCode,
            ]
        )->json('success');
    }
}

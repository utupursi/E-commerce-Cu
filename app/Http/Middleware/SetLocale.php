<?php

namespace App\Http\Middleware;

use App\Models\Localization;
use Closure;
use Illuminate\Http\RedirectResponse;


class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = $request->segment(1);
        $segments = $request->segments();

        $localization = Localization::where('abbreviation', $locale)->first();
        $defaultLocale = Localization::where('default', true)->first();

        if ($localization == null) {
            if (strlen($locale) === 2) {
                array_shift($segments);
            }
            array_unshift($segments, $defaultLocale->abbreviation);
            return $this->redirectTo($segments);
        }
        if (!$localization->status) {
            array_shift($segments);
            return $this->redirectTo($segments);
        }
        app()->setLocale($locale);
        return $next($request);
    }


    /**
     * Redirect to default localization.
     *
     * @param array $segments
     *
     * @return RedirectResponse
     */
    protected function redirectTo(array $segments)
    {
        return redirect()->to(implode('/', $segments));
    }
}

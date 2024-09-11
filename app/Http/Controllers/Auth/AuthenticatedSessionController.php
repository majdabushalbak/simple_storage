<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        // Validate the 'name' and 'password' fields instead of 'email'
        $request->validate([
            'name' => ['required', 'string'],
            'password' => ['required'],
        ]);

        // Attempt authentication using 'name' and 'password'
        if (Auth::attempt($request->only('name', 'password'))) {
            $request->session()->regenerate();

            // Redirect to a custom route after login (e.g., 'products.index')
            return redirect()->intended('products');
        }

        // Return errors if credentials do not match
        return back()->withErrors([
            'name' => __('auth.failed'),
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

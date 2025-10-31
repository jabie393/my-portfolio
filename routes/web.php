<?php

use Illuminate\Support\Facades\Route;
use App\Models\Project;
use Illuminate\Http\Request;


Route::get('/', function (Request $request) {
    $query = Project::query();

    // Optional filter by tools keyword (e.g. ?tool=Laravel)
    if ($request->filled('tool')) {
        $query->where('tools', 'like', '%' . $request->tool . '%');
    }

    $projects = $query->orderBy('created_at', 'desc')->paginate(6)->withQueryString();

    return view('welcome', compact('projects'));
})->name('home');

Route::get('/projects/partial', function (Request $request) {
    $query = Project::query();

    if ($request->filled('tool')) {
        $query->where('tools', 'like', '%' . $request->tool . '%');
    }

    $projects = $query->orderBy('created_at', 'desc')->paginate(6);

    return view('projects.partial', compact('projects'));
})->name('projects.partial');


// Auth routes for the custom login page
Route::get('/login', function (Request $request) {
    if (\Illuminate\Support\Facades\Auth::check()) {
        return redirect()->intended('/admin');
    }
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    $remember = $request->boolean('remember');

    if (\Illuminate\Support\Facades\Auth::attempt($credentials, $remember)) {
        $request->session()->regenerate();
        return redirect()->intended('/admin');
    }

    return back()->withErrors(['email' => __('auth.failed')])->onlyInput('email');
})->name('login.store');

Route::post('/logout', function (Request $request) {
    \Illuminate\Support\Facades\Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

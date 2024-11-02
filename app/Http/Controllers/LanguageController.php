<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function toggleLanguage()
    {
        $currentLocale = App::getLocale();
        $newLocale = $currentLocale === 'hu' ? 'en' : 'hu';

        // Set the new locale in the session
        session(['locale' => $newLocale]);

        // Redirect back to the previous page
        return redirect()->back();
    }
}

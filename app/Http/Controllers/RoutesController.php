<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RoutesController extends Controller
{
    public function redirectToWelcome() {
        return redirect()->route('welcome-route');
    }
}

<?php

namespace SoftC\Persons\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function index(Request $request) {
        return view('softc::person.index');
    }
}
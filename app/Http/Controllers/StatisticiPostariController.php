<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class StatisticiPostariController extends Controller
{
   
        public function index()
        {
            
            $utilizatori = User::where('role', 'client')->withCount('animale')->get();
    
            return view('statistici_postari.index', compact('utilizatori'));
        }
    }
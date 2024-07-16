<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\User;
    use App\Models\Cerere;

    class StatisticiCereriController extends Controller
    {
        public function index()
        {
            
            $statistici = User::where('role', 'client')->withCount('cereri')->get();
    
            return view('statistici_cereri.index', compact('statistici'));
        }
    }

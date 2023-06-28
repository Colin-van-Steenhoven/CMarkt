<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function create() {
        return view('create');
    }

    public function addtask() {
        return view('create');
    }

    public function save(Request $request)
    {
        $userId = Auth::id();
        $newTask = new Task();
        $newTask->userId = $userId;
        $newTask->titel = $request->titel;
        $newTask->description = $request->description;
        $newTask->points = $request->points;
        $newTask->places = $request->places;
        $newTask->image = $request->image;
        
    
        if($request->file('image')){
            $file= $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);
            $newTask['image'] = $filename;
            $newTask->save();
            }
    
        return redirect()->route('home');
    }
}
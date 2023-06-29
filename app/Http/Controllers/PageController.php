<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\Tag;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class PageController extends Controller
{
    public function create() {
        $tags = Tag::All();
        return view('create',['tags' => $tags]);
    }

    public function index() {
        $tasks = Task::All();

        //tasks met tag coding
        $codingTasks = Task::whereHas('tags', function ($query) {
            $query->where('name', 'coding');
        })->get();
        //tasks met tag help
        $helpTasks = Task::whereHas('tags', function ($query) {
            $query->where('name', 'help');
        })->get();
        //tasks met tag bijles
        $bijlesTasks = Task::whereHas('tags', function ($query) {
            $query->where('name', 'bijles');
        })->get();

        return view('home', ['tasks' => $tasks], ['codingTasks' => $codingTasks], ['helpTasks' => $helpTasks], ['bijlesTasks' => $bijlesTasks]);
     }
    public function mytasks(){
         $userId = Auth::id();

         $tasks = Task::where('userId', $userId)->get();
     
         return view('my-tasks', ['tasks' => $tasks]);
     }
     public function details($id) {
        $tasks = Task::findOrFail($id);

        return view('details', ['tasks' => $tasks]);
    }


    public function addtask() {
        return view('create');
    }

    public function save(Request $request)
    {
        $request->validate([
            'titel' => 'required',
            'description' => 'required',
            'points' => 'required',
            'places' => 'required',
            'image' => 'mimes:jpg,png,jpeg|max:5048'
        ], [
            'titel.required' => 'Please enter a title.',
            'description.required' => 'Please enter a description.',
            'points.required' => 'Please enter the number of points.',
            'places.required' => 'Please enter the number of places.',
            'image.mimes' => 'Only JPG, PNG, and JPEG files are allowed.',
            'image.max' => 'The image size must not exceed 5048 kilobytes (5MB).'
        ]);

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
        
        $tagIds = $request->input('tag_ids'); 
        $newTask->tags()->sync($tagIds);

        return redirect()->route('home')
            ->with('message', 'Je taak is geupload!');
    }

    public function eddit($id) {
        $tasks = Task::findOrFail($id);

        return view('eddit-tasks', ['tasks' => $tasks]);
    }

    public function edditsave($id, Request $request)
    {
        $request->validate([
            'titel' => 'required',
            'description' => 'required',
            'points' => 'required',
            'places' => 'required',
        ], [
            'titel.required' => 'Please enter a title.',
            'description.required' => 'Please enter a description.',
            'points.required' => 'Please enter the number of points.',
            'places.required' => 'Please enter the number of places.',
        ]);
        $tasks = Task::where("id", $id)->first();
        $tasks->titel = $request->input('titel');
        $tasks->points = $request->input('points');
        $tasks->places = $request->input('places');
        $tasks->description = $request->input('description');
        $tasks->save();

        return redirect()->route('my-tasks')
            ->with('message', 'Je taak is geupdate!');
    }

    public function deletetask($id){
        $tasks = Task::findOrFail($id);
        $tasks->delete();

        return redirect()->route('home');
    }

    public function assign_to_task($id){
        $task = Task::findOrFail($id);
        $user = auth()->user();
        $task->users()->attach($user->id);

        return back()->withInput()
            ->with('message', 'Je staat ingeschreven!');
    }
    
}
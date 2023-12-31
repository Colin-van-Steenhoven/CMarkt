<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\User;
use App\Models\Tag;
use Carbon\Carbon;
use App\Models\Task_User;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function create() {
        $tags = Tag::All();
        return view('create',['tags' => $tags]);
    }



    public function index() {
        $tasks = Task::whereDate('enddate', '>=', now())->get();
        $tags = Tag::All();
        $tasktags = [];
        foreach ($tasks as $task) {
            $tasktags[$task->id] = $task->tags()->get();
        }
    
        return view('home', compact('tasks', 'tasktags'),['tags' => $tags]);
     }
    public function mytasks(){
         $userId = Auth::id();

         $tasks = Task::where('userId', $userId)->get();

     
         return view('my-tasks', ['tasks' => $tasks]);
     }
     public function details($id) {
        $tasks = Task::findOrFail($id);
        $assignedUsers = $tasks->users;

        return view('details', ['tasks' => $tasks, 'assignedUsers' => $assignedUsers]);
    }
    public function taskusers($id) {
        $tasks = Task::findOrFail($id);
        $assignedUsers = $tasks->users;

        foreach ($assignedUsers as $user) {
            $taskUser = Task_User::where('user_id', $user->id)
            ->where('task_id', $id)
            ->first();
            $user->points = $taskUser ? $taskUser->points : null;
        }
        

        return view('task-users', ['tasks' => $tasks, 'assignedUsers' => $assignedUsers]);
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
            'image' => 'mimes:jpg,png,jpeg|max:5048',
            'enddate' => 'required|date'
        ], [
            'titel.required' => 'Please enter a title.',
            'description.required' => 'Please enter a description.',
            'points.required' => 'Please enter the number of points.',
            'places.required' => 'Please enter the number of places.',
            'image.mimes' => 'Only JPG, PNG, and JPEG files are allowed.',
            'enddate.required' => 'Please enter an end date.',
            'enddate.date' => 'Please enter a valid end date.',
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
        $newTask->enddate = $request->enddate;
        
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
            'enddate' => 'required|date'
        ], [
            'titel.required' => 'Please enter a title.',
            'description.required' => 'Please enter a description.',
            'points.required' => 'Please enter the number of points.',
            'places.required' => 'Please enter the number of places.',
            'enddate.date' => 'Please enter a valid end date.',
        ]);
        $tasks = Task::where("id", $id)->first();
        $tasks->titel = $request->input('titel');
        $tasks->points = $request->input('points');
        $tasks->places = $request->input('places');
        $tasks->description = $request->input('description');
        $tasks->enddate = $request->input('enddate');
        $tasks->save();

        return redirect()->route('my-tasks')
            ->with('message', 'Je taak is geupdate!');
    }

    public function deletetask($id){
        $tasks = Task::findOrFail($id);
        $tasks->delete();

        return redirect()->route('my-tasks');
    }

    public function assign_to_task($id){

        $task = Task::findOrFail($id);
        if (!$task->users->contains(Auth::user())) {
            $user = auth()->user();
            $task->users()->attach($user->id);
            $task->decrement('places', 1);
        } 


        return back()->withInput()
            ->with('message', 'Je staat ingeschreven!');
    }
    public function remove_from_task($id)
    {
        $task = Task::findOrFail($id);
        $user = auth()->user();

        if ($task->users->contains($user)) {
            $task->users()->detach($user->id);
            $task->increment('places', 1);
        }

        return back()->with('message', 'Je bent afgemeld!');
    }
    public function addpoints($id, Request $request)
    {
        $userId = $request->input('user_id');
        $points = $request->input('points');

        
        $task = Task::findOrFail($id);
        $task->users()->updateExistingPivot($userId, ['points' => $points]);

        return back()->with('message','Punten toegevoegd');

    }
    public function filtered(Request $request)
    {
        $selectedTags = $request->input('tags');
        $endDate = $request->input('enddate');

        $tasks = Task::when($selectedTags, function ($query) use ($selectedTags) {
            foreach ($selectedTags as $tag) {
                $query->whereHas('tags', function ($subQuery) use ($tag) {
                    $subQuery->where('name', $tag);
                });
            }
        })
        ->when($endDate, function ($query) use ($endDate) {
            $query->whereDate('enddate', '>=', $endDate);
        })
        ->whereDate('enddate', '>=', Carbon::now())
        ->get();
        

        $tags = Tag::all();
        $tasktags = [];
        foreach ($tasks as $task) {
            $tasktags[$task->id] = $task->tags()->get();
        }
        return view('home', compact('tasks', 'tags','tasktags'));
    }

    
}
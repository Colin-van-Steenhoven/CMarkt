<?php
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PageController;
use App\Http\Middleware\Teacher;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/login', function(){
    return redirect('/amoclient/redirect');
})->name('login');

Route::get('/amoclient/ready', function(){
<<<<<<< Updated upstream
	return redirect('/');
});

Route::get('/filtered', [PageController::class, 'filtered'])->name('filtered');
=======
    return redirect('/');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/assign_to_task/{id}', [PageController::class, 'assign_to_task'])
        ->name('assign_to_task');

    Route::get('/remove_from_task/{id}', [PageController::class, 'remove_from_task'])
        ->name('remove_from_task');

    Route::middleware('teacher')->group(function () {
        Route::get('/my-tasks', [PageController::class, 'mytasks'])
            ->name('my-tasks');

        Route::get('/create', [PageController::class, 'create'])
            ->name('create-task');

        Route::post('/create', [PageController::class, 'save'])
            ->name('save-task');

        Route::get('/eddit-tasks/{id}', [PageController::class, 'eddit'])
            ->name('eddit-tasks');

        Route::post('/eddit-tasks/{id}', [PageController::class, 'edditsave'])
            ->name('eddit-tasks');

        Route::get('/delete-task{id}', [PageController::class, 'deletetask'])
            ->name('delete-task');

        Route::get('/task-users{id}', [PageController::class, 'taskusers'])
            ->name('task-users');

        Route::post('/add-points/{id}', [PageController::class, 'addpoints'])
            ->name('add-points');
    });
});

Route::get('/', [PageController::class, 'index'])
    ->name('home');

Route::get('/details{id}', [PageController::class, 'details'])
    ->name('details');
?>
>>>>>>> Stashed changes

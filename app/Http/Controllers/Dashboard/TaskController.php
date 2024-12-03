<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\TaskRequest;
use App\Models\User;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(protected TaskService $service) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = $this->service->indexHandler();

        $users = User::all();

        return view('Dashboard.Tasks.All', compact(['tasks', 'users']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $this->service->storeHandler($request->validated());

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, string $id)
    {
        $this->service->updateHandler($request->validated(), $id);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->service->destroyHandler($id);

        return redirect()->back();
    }
}

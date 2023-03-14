<?php

namespace App\Http\Controllers;

use App\Helpers\TaskHelper;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    private TaskHelper $helper;

    public function __construct(TaskHelper $helper)
    {
        $this->helper = $helper;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\Response
     */
    public function index()
    {
        return TaskResource::collection(Task::with('subtasks')->where('user_id', Auth::id())->orderBy('id', 'DESC')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return TaskResource|\Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        $task = Task::create($request->validated());

        return new TaskResource($task);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return TaskResource|\Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        if(!$this->helper->checkUserToTask($task->user_id, Auth::id())) abort(404);
        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return TaskResource|\Illuminate\Http\Response
     */
    public function update(TaskRequest $request, Task $task)
    {
        if(!$this->helper->checkUserToTask($task->user_id, Auth::id())) abort(404);
        $task->update($request->validated());

        return new TaskResource($task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        if(!$this->helper->checkUserToTask($task->user_id, Auth::id())) abort(404);
        $task->delete();

        return response()->noContent();
    }
}

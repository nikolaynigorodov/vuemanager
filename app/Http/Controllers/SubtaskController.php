<?php

namespace App\Http\Controllers;

use App\Helpers\TaskHelper;
use App\Http\Requests\SubtaskRequest;
use App\Http\Requests\SubtaskUpdateRequest;
use App\Http\Resources\SubtaskResource;
use App\Models\Subtask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubtaskController extends Controller
{

    private TaskHelper $helper;

    public function __construct(TaskHelper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubtaskRequest $request)
    {
        $task = Subtask::create($request->validated());

        return new SubtaskResource($task);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subtask  $subtask
     * @return SubtaskResource|\Illuminate\Http\Response
     */
    public function show(Subtask $subtask)
    {
        if(!$this->helper->checkUserToTask($subtask->user_id, Auth::id())) abort(404);
        return new SubtaskResource($subtask);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subtask  $subtask
     * @return \Illuminate\Http\Response
     */
    public function update(SubtaskUpdateRequest $request, Subtask $subtask)
    {
        if(!$this->helper->checkUserToTask($subtask->user_id, Auth::id())) abort(404);
        $subtask->update($request->validated());

        return new SubtaskResource($subtask);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subtask  $subtask
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subtask $subtask)
    {
        if(!$this->helper->checkUserToTask($subtask->user_id, Auth::id())) abort(404);
        $subtask->delete();

        return response()->noContent();
    }
}

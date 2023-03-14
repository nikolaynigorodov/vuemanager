<?php

namespace App\Repository;

use App\Models\Task;

class TaskRepository
{
    public function getAllTasks(int $userId)
    {
        return Task::where('user_id', $userId)->with('subtasks')->orderBy('id', 'DESC')->get();
    }
    public function getTaskById(int $id, int $userId)
    {
        $task = Task::where('id', $id)->where('user_id', $userId)->with('subtasks')->first();
        if($task) return $task;
        return false;
    }

    public function create(array $request)
    {
        return Task::create([
            'title' => $request['title'],
            'description' => $request['description'],
            'end_date' => $request['end_date'],
            'status' => $request['status'],
            'user_id' => $request['user_id'],
        ]);
    }

    public function update(int $idTask, array $request)
    {
        $updateTask = Task::where('id',$idTask)->update($request);
        if($updateTask) return Task::find($idTask);
        return false;
    }

    public function delete(int $userId, int $taskId)
    {
        return Task::where('id', $taskId)->where('user_id',$userId)->delete();
    }
}

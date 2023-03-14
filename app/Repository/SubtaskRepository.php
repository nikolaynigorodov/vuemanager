<?php

namespace App\Repository;

use App\Models\Subtask;

class SubtaskRepository
{
    public function getSubtaskById(int $id, int $userId)
    {
        $subtask = Subtask::where('id', $id)->where('user_id', $userId)->first();
        if($subtask) return $subtask;
        return false;
    }

    public function create(array $request)
    {
        return Subtask::create([
            'title' => $request['title'],
            'description' => $request['description'],
            'end_date' => $request['end_date'],
            'status' => $request['status'],
            'user_id' => $request['user_id'],
            'task_id' => $request['task_id'],
        ]);
    }

    public function update(int $idTask, array $request)
    {
        $updateTask = Subtask::where('id',$idTask)->update($request);
        if($updateTask) return Subtask::find($idTask);
        return false;
    }

    public function delete(int $userId, int $subtaskId)
    {
        return Subtask::where('id', $subtaskId)->where('user_id',$userId)->delete();
    }
}

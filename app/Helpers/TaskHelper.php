<?php

namespace App\Helpers;

class TaskHelper
{
    public function checkUserToTask(int $taskId, int $userId): bool
    {
        if($taskId != $userId) {
            return false;
        }
        return true;
    }
}

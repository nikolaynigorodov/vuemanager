<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiSubtaskResource;
use App\Repository\SubtaskRepository;
use App\Repository\TaskRepository;
use App\Repository\UserRepository;
use App\Validate\ApiSubtaskValidate;
use App\Validate\Validate;
use Illuminate\Http\Request;

class SubtaskController extends Controller
{
    private TaskRepository $taskRepository;
    private UserRepository $userRepository;
    private Validate $validate;
    private SubtaskRepository $subtaskRepository;

    public function __construct(
        TaskRepository $taskRepository,
        UserRepository $userRepository,
        SubtaskRepository $subtaskRepository,
        Validate $validate
    )
    {
        $this->taskRepository = $taskRepository;
        $this->userRepository = $userRepository;
        $this->validate = $validate;
        $this->subtaskRepository = $subtaskRepository;
    }

    public function show(string $token, int $subtask)
    {
        $user = $this->userRepository->returnUserByToken($token);
        if($user) {
            $result = $this->subtaskRepository->getSubtaskById($subtask, $user->id);
            if($result) {
                return response()->json([
                    'success' => true,
                    'data' => new ApiSubtaskResource($result)
                ]);
            }
            return response()->json([
                'success' => false,
                'data' => 'Error check subtask id'
            ]);
        }
        return response()->json([
            'success' => true,
            'data' => 'Error check token'
        ]);
    }

    public function store(Request $request, ApiSubtaskValidate $rules, string $token, int $task_id)
    {
        $user = $this->userRepository->returnUserByToken($token);
        if($user) {
            $task = $this->taskRepository->getTaskById($task_id, $user->id);
            if(!$task) {
                return response()->json([
                    'success' => false,
                    'data' => 'Error check task id'
                ]);
            }
            $request->request->add(['user_id' => $user->id]);
            $request->request->add(['task_id' => $task->id]);
            $valid = $this->validate->validate($request, $rules);

            if(!empty($valid)) {
                return response()->json($valid, 422);
            }

            $task = $this->subtaskRepository->create($request->all());

            return response()->json([
                'success' => true,
                'data' => new ApiSubtaskResource($task)
            ]);

        }
        return response()->json([
            'success' => true,
            'data' => 'Error check token'
        ]);
    }

    public function update(Request $request, ApiSubtaskValidate $rules, string $token, int $subtask)
    {
        $user = $this->userRepository->returnUserByToken($token);
        if($user) {
            $returnSubtask = $this->subtaskRepository->getSubtaskById($subtask, $user->id);

            if($returnSubtask) {
                $request->request->add(['user_id' => $user->id]);
                $request->request->add(['task_id' => $returnSubtask->task_id]);
                $valid = $this->validate->validate($request, $rules);
                if(!empty($valid)) {
                    return response()->json($valid, 422);
                }

                $saveSubtask = $this->subtaskRepository->update($returnSubtask->id, $request->all());
                return response()->json([
                    'success' => true,
                    'data' => new ApiSubtaskResource($saveSubtask)
                ]);
            }
            return response()->json([
                'success' => false,
                'data' => 'Error check Subtask id'
            ]);
        }
        return response()->json([
            'success' => true,
            'data' => 'Error check token'
        ]);
    }

    public function destroy(string $token, int $subtask)
    {
        $user = $this->userRepository->returnUserByToken($token);
        if($user) {
            $task = $this->subtaskRepository->getSubtaskById($subtask, $user->id);

            if($task) {
                $this->subtaskRepository->delete($user->id, $task->id);
                return response()->json([
                    'success' => true,
                    'data' => 'Your Subtask has been successfully deleted'
                ]);
            }
            return response()->json([
                'success' => false,
                'data' => 'Error check Subtask id'
            ]);
        }
        return response()->json([
            'success' => true,
            'data' => 'Error check token'
        ]);
    }
}

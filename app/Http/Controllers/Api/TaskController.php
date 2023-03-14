<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApiTaskResource;
use App\Repository\TaskRepository;
use App\Repository\UserRepository;
use App\Validate\ApiTaskValidate;
use App\Validate\Validate;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private TaskRepository $taskRepository;
    private UserRepository $userRepository;
    private Validate $validate;

    public function __construct(
        TaskRepository $taskRepository,
        UserRepository $userRepository,
        Validate $validate
    )
    {
        $this->taskRepository = $taskRepository;
        $this->userRepository = $userRepository;
        $this->validate = $validate;
    }

    public function index($token)
    {
        $user = $this->userRepository->returnUserByToken($token);
        if($user) {
            $tasks = $this->taskRepository->getAllTasks($user->id);
            return response()->json([
                'success' => true,
                'data' => ApiTaskResource::collection($tasks)
            ]);
        }
        return response()->json([
            'success' => false,
            'data' => 'Error check token'
        ]);
    }

    public function show(string $token, int $task)
    {
        $user = $this->userRepository->returnUserByToken($token);
        if($user) {
            $task = $this->taskRepository->getTaskById($task, $user->id);
            if($task) {
                return response()->json([
                    'success' => true,
                    'data' => new ApiTaskResource($task)
                ]);
            }
            return response()->json([
                'success' => false,
                'data' => 'Error check task id'
            ]);
        }
        return response()->json([
            'success' => true,
            'data' => 'Error check token'
        ]);
    }

    public function store(Request $request, ApiTaskValidate $rules, string $token)
    {
        $user = $this->userRepository->returnUserByToken($token);
        if($user) {
            $request->request->add(['user_id' => $user->id]);
            $valid = $this->validate->validate($request, $rules);

            if(!empty($valid)) {
                return response()->json($valid, 422);
            }

            $task = $this->taskRepository->create($request->all());
            return response()->json([
                'success' => true,
                'data' => new ApiTaskResource($task)
            ]);

        }
        return response()->json([
            'success' => true,
            'data' => 'Error check token'
        ]);
    }

    public function update(Request $request, ApiTaskValidate $rules, string $token, int $task)
    {
        $user = $this->userRepository->returnUserByToken($token);
        if($user) {
            $task = $this->taskRepository->getTaskById($task, $user->id);

            if($task) {
                $request->request->add(['user_id' => $user->id]);
                $valid = $this->validate->validate($request, $rules);
                if(!empty($valid)) {
                    return response()->json($valid, 422);
                }

                $task = $this->taskRepository->update($task->id, $request->all());
                return response()->json([
                    'success' => true,
                    'data' => new ApiTaskResource($task)
                ]);
            }
            return response()->json([
                'success' => false,
                'data' => 'Error check task id'
            ]);
        }
        return response()->json([
            'success' => true,
            'data' => 'Error check token'
        ]);
    }

    public function destroy(string $token, int $task)
    {
        $user = $this->userRepository->returnUserByToken($token);
        if($user) {
            $task = $this->taskRepository->getTaskById($task, $user->id);

            if($task) {
                $this->taskRepository->delete($user->id, $task->id);
                return response()->json([
                    'success' => true,
                    'data' => 'Your Task has been successfully deleted'
                ]);
            }
            return response()->json([
                'success' => false,
                'data' => 'Error check task id'
            ]);
        }
        return response()->json([
            'success' => true,
            'data' => 'Error check token'
        ]);
    }
}

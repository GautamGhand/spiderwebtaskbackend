<?php

namespace App\Http\Controllers\Api\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Task\TaskStoreRequest;
use App\Http\Requests\Api\Task\TaskUpdateRequest;
use App\Models\Task;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class TaskController extends Controller
{
    public function tasks()
    {
        $tasks = Task::where('user_id', Auth::id())->get();
        return Response::json([
            'success' => true,
            'message' => 'All Tasks',
            'tasks' => $tasks
        ]);
    }
    public function store(TaskStoreRequest $request)
    {
        try {
            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'due_date' => $request->due_date,
                'user_id' => Auth::id(),
                'status' => $request->status
            ];
            Task::create($data);
            return Response::json([
                'success' => true,
                'message' => 'Task Created Successfully!'
            ]);
        } catch (Exception $e) {
            return Response::json([
                'success' => false,
                'message' => $e->getMessage()
            ], 403);
        }
    }
    public function edit($uuid)
    {
        try {
            $task = Task::where('uuid', $uuid)->firstOrFail();
            return Response::json([
                'success' => true,
                'message' => 'Task fetched successfully.',
                'task' => $task,
            ]);
        } catch (Exception $e) {
            return Response::json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 404);
        }
    }
    public function update(TaskUpdateRequest $request, $uuid)
    {
        try {
            $task = Task::where('uuid', $uuid)->firstOrFail();
            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'due_date' => $request->due_date,
                'status' => $request->status
            ];
            $task->update($data);
            return Response::json([
                'success' => true,
                'message' => 'Task Updated Successfully!'
            ]);
        } catch (Exception $e) {
            return Response::json([
                'success' => false,
                'message' => $e->getMessage()
            ], 403);
        }
    }
    public function delete($uuid){
        try {
            $task = Task::where('uuid', $uuid)->firstOrFail();
            $task->delete();
            return Response::json([
                'success' => true,
                'message' => 'Task Deleted Successfully!'
            ]);
        } catch (Exception $e) {
            return Response::json([
                'success' => false,
                'message' => $e->getMessage()
            ], 403);
        }
    }
}

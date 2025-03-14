<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class TaskService
{
    public function createTask(array $data)
    {
        $data['date'] = DateService::formatToDatabase($data['date']);

        $task = Task::create($data);

        return $task;
    }

    public function getTasks(array $filters): LengthAwarePaginator
    {
        $query = Task::query();

        if (!empty($filters['title'])) {
            $query->where('title', 'like', '%' . $filters['title'] . '%');
        }

        if (!empty($filters['date'])) {
            $query->whereDate('date', Carbon::parse($filters['date'])->format('Y-m-d'));
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        $sortableFields = ['id', 'status', 'date'];
        $sortBy = in_array($filters['sortBy'] ?? 'id', $sortableFields) ? $filters['sortBy'] : 'id';
        $sortOrder = ($filters['sortOrder'] ?? 'asc') === 'desc' ? 'desc' : 'asc';

        $query->orderBy($sortBy, $sortOrder);

        $perPage = isset($filters['perPage']) && is_numeric($filters['perPage']) ? (int) $filters['perPage'] : 10;

        return $query->paginate($perPage);
    }
}

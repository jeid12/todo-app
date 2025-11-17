<?php

namespace App\Services;

use App\Models\Todo;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TodoService
{
    /**
     * List todos for a given user.
     */
    public function list($user, int $perPage = 15): Paginator
    {
        return Todo::where('user_id', $user->id)->orderBy('due_date')->paginate($perPage);
    }

    /**
     * Create a todo for a user.
     */
    public function create($user, array $data): Todo
    {
        $data['user_id'] = $user->id;

        return Todo::create($data);
    }

    /**
     * Update a todo ensuring ownership.
     */
    public function update($user, int $id, array $data): Todo
    {
        $todo = Todo::where('id', $id)->where('user_id', $user->id)->first();

        if (! $todo) {
            throw new ModelNotFoundException('Todo not found');
        }

        $todo->update($data);

        return $todo;
    }

    /**
     * Delete a todo ensuring ownership.
     */
    public function delete($user, int $id): void
    {
        $todo = Todo::where('id', $id)->where('user_id', $user->id)->first();

        if (! $todo) {
            throw new ModelNotFoundException('Todo not found');
        }

        $todo->delete();
    }

    /**
     * Mark todo as complete.
     */
    public function markComplete($user, int $id): Todo
    {
        $todo = Todo::where('id', $id)->where('user_id', $user->id)->first();

        if (! $todo) {
            throw new ModelNotFoundException('Todo not found');
        }

        $todo->is_completed = true;
        $todo->save();

        return $todo;
    }
}

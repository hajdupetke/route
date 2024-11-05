<?php

namespace App\Http\Controllers;

use App\Enums\AssignmentStatus;
use App\Enums\UserRole;
use App\Http\Requests\AssignmentCreateRequest;
use App\Http\Requests\AssignmentUpdateRequest;
use App\Notifications\StatusChange;
use Auth;
use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\User;


class AssignmentController extends Controller
{
    //

    public function index(Request $request) {
        $user = Auth::user();
        $validated = $request->validate(['status' => 'string']);
        $status = isset($validated['status']) && $validated['status'] != 'all' ? $validated['status']: null;
        $query = $user->role == UserRole::Admin ? Assignment::query() : $user->assignments();
        if($status) {
            $query->where('status', $status);
        }
        $assignments = $query->simplePaginate(10);

        return view('assignments.index', ['assignments' => $assignments]);
    }

    public function destroy(Assignment $assignment) {
        $user = Auth::user();

        if($user->role !== UserRole::Admin) {
            return abort(403, 'Not authorized');
        }
        $assignment->delete();

        return redirect()->route('dashboard');
    }

    public function edit(Assignment $assignment) {
        return view('assignments.edit', ['assignment' => $assignment]);
    }

    public function update(Assignment $assignment, AssignmentUpdateRequest $request) {

        $validated = $request->validated();

        // Check if driver changed, and modify assignment if it did.
        if(isset($validated['driver']) && $validated['driver'] != null) {
            $user = User::where('id', $validated['driver'])->get()[0];
            if($assignment->driver != $user) {
                // Update driver
                $user->assignments()->save($assignment);
            }
        }

        // Check if status changed and modify assignment if it did.
        if(isset($validated['status']) && $validated['status'] != null) {
            $status = AssignmentStatus::tryFrom($validated['status']);
            if($assignment->status != $status) {
                $assignment->status = $status;
                //Todo: Send notification to admin user if status changed to failed.

                if($status == AssignmentStatus::Failed) {
                    $admins = User::where('role', UserRole::Admin)->get();
                    foreach ($admins as $admin) {
                        $admin->notify(new StatusChange($assignment));
                    }
                }
            }
        }


        $updates = array_filter($validated, function ($value, $key) use ($assignment) {
            return $value !== null && $value !== $assignment->$key && $key != 'status' && $key != 'driver';
        }, ARRAY_FILTER_USE_BOTH);

        $assignment->update($updates);

        return redirect()->route('assignment.show', $assignment);
    }

    public function create() {
        $user = Auth::user();

        if($user->role !== UserRole::Admin) {
            return abort(403, 'Not authorized');
        }

        return view('assignments.create');
    }

    public function store(AssignmentCreateRequest $request) {
        $validated = $request->validated();
        $user = User::where('id', $validated['driver'])->get()[0];
        $status = AssignmentStatus::tryFrom($validated['status']);
        if ($status === null) {
            dd("Invalid status value:", $validated['status']);
        }

        $assignment = $user->assignments()->create(attributes: [
            'status' => $status,
            'start_address' => $validated['start_address'],
            'delivery_address' => $validated['delivery_address'],
            'recipient_name' => $validated['recipient_name'],
            'recipient_phone_number' => $validated['recipient_phone_number'],

        ]);

        return redirect()->route('assignment.show', $assignment);

    }

    public function show(Assignment $assignment) {
        return view('assignments.show', ['assignment' => $assignment]);
    }
}

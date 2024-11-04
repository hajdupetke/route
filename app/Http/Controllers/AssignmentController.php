<?php

namespace App\Http\Controllers;

use App\Enums\AssignmentStatus;
use App\Enums\UserRole;
use App\Http\Requests\AssignmentCreateRequest;
use App\Http\Requests\AssignmentUpdateRequest;
use Auth;
use App\Models\Assignment;
use App\Models\User;


class AssignmentController extends Controller
{
    //

    public function index() {
        $user = Auth::user();
        $assignments = $user->role == UserRole::Admin ? Assignment::simplePaginate(10) : $user->assignments()->simplePaginate(10);

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
        if($validated['driver'] != null) {
            $user = User::where('id', $validated['driver'])->get()[0];
            if($assignment->driver != $user) {
                // Update driver
                $user->assignments()->save($assignment);
            }
        }

        // Check if status changed and modify assignment if it did.
        if($validated['status'] != null) {
            $status = AssignmentStatus::tryFrom($validated['status']);
            if($assignment->status != $status) {
                $assignment->status = $status;
                //Todo: Send notification to admin user if status changed to failed.
            }
        }


        $updates = array_filter($validated, function ($value, $key) use ($assignment) {
            return $value !== null && $value !== $assignment->$key && $key != 'status' && $key != 'driver';
        }, ARRAY_FILTER_USE_BOTH);

        $assignment->update($updates);

        return redirect()->route('dashboard');
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

        return redirect()->route('dashboard');

    }
}

<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use Auth;
use Illuminate\Http\Request;
use App\Models\Assignment;

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
}

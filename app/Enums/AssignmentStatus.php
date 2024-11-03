<?php

namespace App\Enums;

enum AssignmentStatus: String
{
    case Assigned = 'assigned';
    case InProgress = 'in progress';
    case Finished = 'finished';
    case Failed = 'failed';

    public function label(): string
    {
        return match($this) {
            self::Assigned => __('enums.assignment_status.assigned'),
            self::InProgress => __('enums.assignment_status.in_progress'),
            self::Finished => __('enums.assignment_status.finished'),
            self::Failed => __('enums.assignment_status.failed'),
        };
    }
}

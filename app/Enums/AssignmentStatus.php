<?php

namespace App\Enums;

enum AssignmentStatus: String
{
    case Assigned = 'assigned';
    case InProgress = 'in progress';
    case Finished = 'finished';
    case Failed = 'failed';
}

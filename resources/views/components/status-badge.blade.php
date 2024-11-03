@php

$classes = 'badge' .
(($status == \App\Enums\AssignmentStatus::Assigned) ?
' badge-info' :
($status == \App\Enums\AssignmentStatus::InProgress ?
' badge-warning' :
($status == \App\Enums\AssignmentStatus::Finished ?
' badge-success':
' badge-error')));


@endphp

<span class="{{$classes}}">{{$status->label()}}</span>

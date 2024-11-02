<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\AssignmentStatus;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = ['start_address', 'delivery_address', 'recipient_name', 'recipient_phone_number'];

    protected $casts = ['status' => AssignmentStatus::class];

    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

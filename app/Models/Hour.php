<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Hour extends Model
{
    use HasFactory;
    private $user_id;
    private $date;
    private $hour;
    protected $table = "hours";
    protected $guarded=[];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

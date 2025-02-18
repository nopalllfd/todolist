<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'task_name',
        'description',
        'priority',
        'due_date',
        'status',
    ];

    public function getDaysLeftAttribute()
    {
        $dueDate = Carbon::parse($this->due_date);
        $now = Carbon::now();
        return $dueDate->diffInDays($now);
    }

    public function getDueDayAttribute()
    {
        return Carbon::parse($this->due_date)->format('l');
    }
}
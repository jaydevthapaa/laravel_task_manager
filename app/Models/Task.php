<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    
    // columns we are allowed to dave data into
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'due_date',
        'status',
    ];
    // a task that belongs to one user 
    public function user(){
        return $this-> belongsTo(User::class);
    }

}

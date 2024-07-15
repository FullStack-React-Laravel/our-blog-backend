<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    use HasFactory;

    public $fillable= ['raactionalbe_id' , 'reactionable_type' , 'reaction'];

    public function reactionable(){
        return $this->morphTo();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }


}

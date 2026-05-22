<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name',
        'user_id',
    ];

    /**
     * The user who owns this tag.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The notes that have this tag (many-to-many).
     */
    public function notes()
    {
        return $this->belongsToMany(Note::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Restaurant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'genre',
        'url',
        'takeaway_flag',
        'user_review',
        'google_review',
    ];

    /**
     * Scope a query to fetch restaurants by user_id
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByUserId($query): Builder
    {
        return $query->select(
                'id', 'name', 'genre', 'url', 'takeaway_flag', 'user_review', 'google_review', 'created_at'
            )
            ->where('user_id', '=', Auth::id())
            ;
    }
}

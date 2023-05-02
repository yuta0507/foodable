<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'genre',
        'area',
        'url',
        'takeaway_flag',
        'user_review',
        'google_review',
    ];

    /**
     * Table relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to fetch restaurants by user_id
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByUserId(Builder $query): Builder
    {
        return $query
            ->select(
                'id',
                'name',
                'genre',
                'area',
                'url',
                'takeaway_flag',
                'user_review',
                'google_review'
            )
            ->where('user_id', '=', Auth::id())
            ;
    }

    /**
     * Scope a query to search restaurants by request parameters
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch(Builder $query, array $request): Builder
    {
        if (! empty($request['your_review'])) {
            if ($request['your_review'] === 'desc') {
                $query->orderBy('user_review', 'desc');
            } else {
                $query->orderBy('user_review', 'asc');
            }
        }

        if (! empty($request['google_review'])) {
            if ($request['google_review'] === 'desc') {
                $query->orderBy('google_review', 'desc');
            } else {
                $query->orderBy('google_review', 'asc');
            }
        }

        if (! empty($request['search'])) {
            $query->where(function ($q) use ($request) {
                $q->where('name', '=', $request['search'])
                    ->orWhere('genre', '=', $request['search'])
                    ->orWhere('area', '=', $request['search']);
            });
        }

        return $query;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $guarded = ['id'];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFilter($query)
    {
        $request = request();

        if ($request->title) {
            $query->search($request->title);
        }

        return $query;
    }

    public function scopeSearch($query, $search)
    {
        $searchWords = explode(' ', $search);

        return $query->where(function ($q1) use ($searchWords) {
            foreach ($searchWords as $word) {
                $q1->where('title', 'like', '%' . $word . '%');
            }
        });
    }

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    public function scopeDraft($query)
    {
        return $query->where('published', false);
    }

    public function imageUrl()
    {
        return $this->image ? asset($this->image) : asset('assets/panel/img/no-image.png');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Project extends Model
{
    use HasFactory;
    use HasSlug;

    protected $guarded = ['id'];
    protected $appends = ['image_url'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

     public function scopeSearch($query, $search)
    {
        return $query->where('nama_project', 'like', "%{$search}%");
    }

    public function getImageUrlAttribute(){
        return $this->file_project ? asset('storage/' . $this->file_project) : null;
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nama_project')
            ->saveSlugsTo('slug');
    }
}

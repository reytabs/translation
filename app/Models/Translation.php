<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Translation extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value', 'locale_id'];

    public function locale()
    {
        return $this->belongsTo(Locale::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'translation_tags', 'translation_id', 'tag_id');
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('key', 'like', "%{$search}%")
                    ->orWhere('value', 'like', "%{$search}%");
    }

    public function scopeWithTag($query, $tag)
    {
        return $query->whereHas('tags', function ($q) use ($tag) {
            $q->where('name', $tag);
        });
    }

    public function scopeWithLocale($query, $localeCode)
    {
        return $query->whereHas('locale', function ($q) use ($localeCode) {
            $q->where('code', $localeCode);
        });
    }
}

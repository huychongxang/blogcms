<?php

namespace App;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use function GuzzleHttp\Psr7\str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable = ['title', 'slug', 'excerpt', 'body', 'published_at', 'category_id', 'view_count', 'image'];
    protected $dates = ['published_at', 'created_at', 'updated_at'];
    use Sluggable;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function createTags($tagString)
    {
        $tags = explode(",", $tagString);
        $tagIds = [];

        foreach ($tags as $tag) {
            $newTag = Tag::firstOrCreate(
                ['slug' => str_slug($tag), 'name' => ucwords(trim($tag))]
            );
            $newTag->save();

            $tagIds[] = $newTag->id;
        }

        $this->tags()->sync($tagIds);
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Accessors- Mutators
    public function getImageUrlAttribute($image)
    {
        $imageUrl = "";
        if (!is_null($this->image)) {
            $dicrectory = config('cms.image.directory');
            $imagePath = public_path() . "/{$dicrectory}/" . $this->image;
            if (file_exists($imagePath)) {
                $imageUrl = asset("/{$dicrectory}/" . $this->image);
            }
        }
        return $imageUrl;
    }

    public function getDateAttribute()
    {
        return is_null($this->published_at) ? '' : $this->published_at->diffForHumans();
    }

    public function getImageThumbUrlAttribute()
    {
        $imageUrl = "";
        if (!is_null($this->image)) {
            // lấy extension = cách tìm dấu . cuối cùng trong tên image và lấy từ sau dấu chấm đến hết
            $extenstion = substr(strrchr($this->image, '.'), 1);
            $thumbnail = str_replace(".$extenstion", "_thumb.$extenstion", $this->image);
            $dicrectory = config('cms.image.directory');
            $imagePath = public_path() . "/{$dicrectory}/" . $thumbnail;
            if (file_exists($imagePath)) {
                $imageUrl = asset("/{$dicrectory}/" . $thumbnail);
            }
        }
        return $imageUrl;
    }

    public function getTagsListAttribute()
    {
        return $this->tags->pluck('name');
    }

    public function getTagsHtmlAttribute()
    {
        $anchors = [];
        foreach ($this->tags as $tag) {
            $anchors[] = '<a href="' . route('tag', $tag->slug) . '">' . $tag->name . '</a>';
        }
        return implode(', ', $anchors);
    }

    public function commentsNumber()
    {
        $commentsNumber = $this->comments->count();
        return $commentsNumber . ' ' . str_plural('Comment', $commentsNumber);
    }

    public function setPublishedAtAttribute($value)
    {
        if ($value) {
            $value = date("Y-m-d H:i:s", strtotime($value));
        }
        $this->attributes['published_at'] = $value ?: NULL;
    }

    public function dateFormatted($showTimes = false)
    {
        $format = "d/m/Y";
        if ($showTimes) $format = $format . " H:i:s";
        return $this->created_at->format($format);
    }

    public function publicationLabel()
    {
        if (!$this->published_at) {
            return '<span class="label label-warning">Draft</span>';
        } elseif ($this->published_at && $this->published_at->isFuture()) {
            return '<span class="label label-info">Schedule</span>';
        } else {
            return '<span class="label label-success">Published</span>';
        }
    }

    // Scope
    public function scopeMoiNhat($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopePublished($query)
    {
        return $query->where("published_at", "<=", Carbon::now());
    }

    public function scopeScheduled($query)
    {
        return $query->where("published_at", ">", Carbon::now());
    }

    public function scopeDraft($query)
    {
        return $query->whereNull("published_at");
    }

    public function scopePopular($query)
    {
        return $query->orderBy('view_count', 'desc');
    }

    // Get list Tháng - Năm - Số lượng Post
    public static function archives()
    {
        return static::selectRaw('count(id) post_count, YEAR(published_at) year, MONTHNAME(published_at) month')->published()->groupBy('year', 'month')->orderBy('published_at', 'desc')->get();
    }

    // check if user searched
    public function scopeFilter($query, $filter)
    {
        if (isset($filter['month']) && $month = $filter['month']) {
            $query->whereMonth('published_at', Carbon::parse($month)->month);
        }
        if (isset($filter['year']) && $year = $filter['year']) {
            $query->whereYear('published_at', $year);
        }

        if (isset($filter['term']) && $term = $filter['term']) {
            $query->where(function ($q) use ($term) {
                $q->whereHas('user', function ($qr) use ($term) {
                    $qr->where('name', 'LIKE', "%{$term}%");
                });
                $q->orWhereHas('category', function ($qr) use ($term) {
                    $qr->where('title', 'LIKE', "%{$term}%");
                });
                $q->orWhere('title', 'LIKE', "%{$term}%");
                $q->orWhere('excerpt', 'LIKE', "%{$term}%");
            });
        }
    }
}

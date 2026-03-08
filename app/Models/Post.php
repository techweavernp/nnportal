<?php

namespace App\Models;

use App\Enums\PostStatusEnum;
use App\Helpers\NepaliDateConvertor;
use DB;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class Post extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'published_at_human',
    ];
    protected function casts(): array
    {
        return [
            'status' => PostStatusEnum::class,
            'published_at' => 'datetime',
            'show_in_menu' => 'boolean',
        ];
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    /*
     * Belows are scopes
     */
    #[Scope]
    protected function published(Builder $query): void
    {
        $query->where('status', 1)->where('published_at', '<=', now());
    }
    #[Scope]
    protected function inCategory(Builder $query, string $slug): void
    {
        $query->whereHas('categories', fn ($q) => $q->where('slug', $slug));
    }

    /*
     * Belows are attributes
     */
    protected function excerpt(): Attribute
    {
        return Attribute::make(
            get: fn () => Str::words(strip_tags($this->content ?? ''), 30, '...')
        );
    }

    protected function publishedAtHuman(): Attribute
    {
        return Attribute::get(fn () => NepaliDateConvertor::toHuman($this->published_at));
    }


    /*
     * Belows are helper functions
     */
    public static function popularPosts()
    {
        return Cache::remember('popular_posts', now()->addHour(), function () {
            $idsList = implode(',', range(1, 7));

            $postIds = DB::table(DB::raw("
            (
                SELECT
                    posts.id,
                    ROW_NUMBER() OVER (
                        PARTITION BY categories.id
                        ORDER BY posts.published_at DESC, posts.id DESC
                    ) as rn
                FROM posts
                INNER JOIN category_post ON posts.id = category_post.post_id
                INNER JOIN categories ON category_post.category_id = categories.id
                WHERE categories.id IN ($idsList)
                  AND posts.status = 1
                  AND posts.published_at <= NOW()
            ) as ranked_posts
        "))->where('rn', 1)->pluck('id');

            return Post::select('title', 'slug')
                ->whereIn('id', $postIds)
                ->orderByRaw("FIELD(id, " . implode(',', $postIds->toArray()) . ")")
                ->limit(6)
                ->get();
        });
    }


}

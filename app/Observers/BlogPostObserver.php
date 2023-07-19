<?php

namespace App\Observers;

use App\Models\BlogPost;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BlogPostObserver
{
    /**
     * Handle the BlogPost "created" event.
     */
    public function creating(BlogPost $blogPost): void
    {
        $this->setPublished($blogPost);

        $this->setSlug($blogPost);

        $this->setHtml($blogPost);

        $this->setUser($blogPost);
    }

    /**
     * @param BlogPost $blogPost
     * @return void
     *
     * Якщо дата публікації не встановлена и відбувається установка прапора - Обупліковано,
     * то встановлюжмо дату публікації яка є на даний момент.
     */
    protected function setPublished(BlogPost $blogPost)
    {
        $needSetPublished = empty($blogPost->published_at)
            && $blogPost->is_published;
        if(empty($blogPost->published_at) && $blogPost->is_published){
            $blogPost->published_at = Carbon::now();
        }
    }

    /**
     * Якщо поле slug пусте, то заповнюємо його конвертацією заголовка
     * @param BlogPost $blogPost
     */
    protected function setSlug(BlogPost $blogPost)
    {
        if(empty($blogPost->slug)){
            $blogPost->slug = Str::slug($blogPost->title);
        }
    }

    protected function setHtml(BlogPost $blogPost)
    {
        if($blogPost->isDirty('content_raw')){
            $blogPost->content_html = $blogPost->content_raw;
        }
    }
    /**
     * Handle the BlogPost "deleted" event.
     */

    protected function setUser(BlogPost $blogPost)
    {
        $blogPost->user_id = auth()->id() ?? BlogPost::UNKNOWN_USER;
    }

    /**
     * Обробка ПЕРЕД оновленням запису.
     */
    public function updating(BlogPost $blogPost)
    {
        $this->setPublished($blogPost);

        $this->setSlug($blogPost);
    }

    public function deleted(BlogPost $blogPost): void
    {
        //
    }

    /**
     * Handle the BlogPost "restored" event.
     */
    public function restored(BlogPost $blogPost): void
    {
        //
    }

    /**
     * Handle the BlogPost "force deleted" event.
     */
    public function forceDeleted(BlogPost $blogPost): void
    {
        //
    }
}

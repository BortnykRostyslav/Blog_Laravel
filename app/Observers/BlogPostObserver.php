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
        /*
        $this->setPublished($blogPost);

        $this->setSlug($blogPost);
        */
    }

    /**
     * Обробка ПЕРЕД оновленням запису.
     */
    public function updating(BlogPost $blogPost)
    {
//        $test[] = $blogPost->isDirty();
//        $test[] = $blogPost->isDirty('is_published');
//        $test[] = $blogPost->isDirty('user_id');
//        $test[] = $blogPost->getAttribute('is_published');
//        $test[] = $blogPost->is_published;
//        $test[] = $blogPost->getOriginal('is_published');
//        dd($test);

        $this->setPublished($blogPost);

        $this->setSlug($blogPost);
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
    /**
     * Handle the BlogPost "deleted" event.
     */
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

<?php

namespace App\Observers;

use App\Models\BlogCategory;
use Illuminate\Support\Str;

class BlogCategoryObserver
{
    /**
     * Handle the BlogCategory "created" event.
     */
    public function created(BlogCategory $blogCategory): void
    {
        //
    }

    public function creating(BlogCategory $blogCategory): void
    {
        $this->setSlug($blogCategory);
    }
    /**
     * Handle the BlogCategory "updated" event.
     */
    protected function setSlug(BlogCategory $blogCategory)
    {
        if(empty($blogCategory->slug)){
            $blogCategory->slug = Str::slug($blogCategory->title);
        }
    }
    public function updated(BlogCategory $blogCategory): void
    {
        //
    }
    public function updating(BlogCategory $blogCategory): void
    {
        $this->setSlug($blogCategory);
    }

    /**
     * Handle the BlogCategory "deleted" event.
     */
    public function deleted(BlogCategory $blogCategory): void
    {
        //
    }

    /**
     * Handle the BlogCategory "restored" event.
     */
    public function restored(BlogCategory $blogCategory): void
    {
        //
    }

    /**
     * Handle the BlogCategory "force deleted" event.
     */
    public function forceDeleted(BlogCategory $blogCategory): void
    {
        //
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Banner;

class HeroSlider extends Component
{
    public array $banners = [];

    public function mount(): void
    {
        $this->banners = Banner::where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->map(fn($b) => [
                'image'    => $b->image_path,
                'title'    => $b->title,
                'subtitle' => $b->subtitle,
                'link'     => $b->link_url,
            ])
            ->toArray();
    }

    public function render()
    {
        return view('livewire.hero-slider');
    }
}

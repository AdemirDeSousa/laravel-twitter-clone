<?php

namespace App\Http\Livewire;

use App\Models\Tweet;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

/**
 * @property-read Collection $tweets
 */
class Timeline extends Component
{
    protected $listeners = [
//        'tweet::created' => '$refresh',
        'show::more' => '$refresh'
    ];

    public int $perPage = 10;

    public function render(): View
    {
        return view('livewire.timeline');
    }

    public function loadMore(): void
    {
        $this->perPage += 10;
    }

    public function getTweetsProperty()
    {
        $data = Tweet::query()
            ->latest()
            ->paginate($this->perPage);

        session()->put('last-tweet', $data->first()->id);

        return $data;
    }
}

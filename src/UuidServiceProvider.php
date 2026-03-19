<?php

declare(strict_types=1);

namespace Maarheeze\Uuid\Livewire;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class UuidServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // @phpstan-ignore staticMethod.notFound
        Livewire::propertySynthesizer(UuidSynth::class);
    }
}

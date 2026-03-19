<?php

declare(strict_types=1);

namespace Maarheeze\Uuid\Livewire;

use Livewire\Mechanisms\HandleComponents\Synthesizers\Synth;
use Maarheeze\Uuid\Uuid;

class UuidSynth extends Synth
{
    public static string $key = 'maarheeze-uuid';

    public static function match(mixed $target): bool
    {
        return $target instanceof Uuid;
    }

    /** @return array{string, array<mixed>} */
    public function dehydrate(Uuid $target): array
    {
        return [$target->toString(), []];
    }

    public function hydrate(string $value): Uuid
    {
        return Uuid::fromString($value);
    }
}

<?php

declare(strict_types=1);

namespace Tests;

use Livewire\Mechanisms\HandleComponents\ComponentContext;
use Maarheeze\Uuid\Livewire\UuidSynth;
use Maarheeze\Uuid\Uuid;
use PHPUnit\Framework\TestCase;
use stdClass;

class UuidSynthTest extends TestCase
{
    public function testKey(): void
    {
        $this->assertSame('maarheeze-uuid', UuidSynth::$key);
    }

    public function testMatchReturnsTrueForUuid(): void
    {
        $this->assertTrue(UuidSynth::match(Uuid::generate()));
    }

    public function testMatchReturnsFalseForString(): void
    {
        $this->assertFalse(UuidSynth::match('not-a-uuid'));
    }

    public function testMatchReturnsFalseForObject(): void
    {
        $this->assertFalse(UuidSynth::match(new stdClass()));
    }

    public function testMatchReturnsFalseForNull(): void
    {
        $this->assertFalse(UuidSynth::match(null));
    }

    public function testDehydrateReturnsUuidStringAndEmptyMetadata(): void
    {
        $synth = new UuidSynth(new ComponentContext(null), 'someProperty');
        $uuid = Uuid::generate();

        $result = $synth->dehydrate($uuid);

        $this->assertSame($uuid->toString(), $result[0]);
        $this->assertSame([], $result[1]);
    }

    public function testHydrateReturnsUuidInstance(): void
    {
        $synth = new UuidSynth(new ComponentContext(null), 'someProperty');
        $uuidString = '01950d5e-1234-7000-abcd-000000000000';

        $result = $synth->hydrate($uuidString);

        $this->assertSame($uuidString, $result->toString());
    }

    public function testDehydrateHydrateRoundtrip(): void
    {
        $synth = new UuidSynth(new ComponentContext(null), 'someProperty');
        $original = Uuid::generate();

        $dehydrated = $synth->dehydrate($original);
        $hydrated = $synth->hydrate($dehydrated[0]);

        $this->assertSame($original->toString(), $hydrated->toString());
    }
}

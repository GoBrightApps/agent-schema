<?php

declare(strict_types=1);

namespace Agent\Schema;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Stringable;

/** @implements Arrayable<string, mixed> */
class BaseSchema implements Arrayable, Jsonable, Stringable
{
    /**
     * Save the schema
     */
    /** @var array<string, mixed> */
    public array $schema = [];

    /** {@inheritDoc} */
    public function __toString(): string
    {
        return $this->toJson();
    }

    /** {@inheritDoc} */
    public function __serialize(): array
    {
        return $this->schema;
    }

    /** {@inheritDoc} */
    /** @return array<string, mixed> */
    public function toArray(): array
    {
        return $this->schema;
    }

    /** {@inheritDoc} */
    public function toJson($options = 0): string
    {
        $json = json_encode($this->schema, $options);

        return $json === false ? '' : $json;
    }

    /**
     *  Add description to the schema
     */
    public function description(string $description): static
    {
        $this->schema['description'] = $description;

        return $this;
    }

    /**
     * Add default/fallback value support
     */
    public function default(mixed $value): static
    {
        $this->schema['default'] = $value;

        return $this;
    }
}

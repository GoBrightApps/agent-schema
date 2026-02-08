<?php

declare(strict_types=1);

namespace Agent\Schema;

class AnyOfSchema extends BaseSchema
{
    /**
     * Create a new class instance.
     *
     * @param  array<int, BaseSchema>  $schemas
     */
    public function __construct(array $schemas)
    {
        $this->schema = [
            'anyOf' => array_map(static fn (BaseSchema $schema): array => $schema->toArray(), $schemas),
        ];
    }
}

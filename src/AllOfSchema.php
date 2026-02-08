<?php

declare(strict_types=1);

namespace Agent\Schema;

class AllOfSchema extends BaseSchema
{
    /**
     * Create a new class instance.
     *
     * @param  array<int, BaseSchema>  $schemas
     */
    public function __construct(array $schemas)
    {
        $this->schema = [
            'allOf' => array_map(static fn (BaseSchema $schema): array => $schema->toArray(), $schemas),
        ];
    }
}

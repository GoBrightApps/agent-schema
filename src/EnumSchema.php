<?php

declare(strict_types=1);

namespace Agent\Schema;

use Agent\Schema\Concerns\NullableSchema;
use Agent\Schema\Concerns\TypeableSchema;

class EnumSchema extends BaseSchema
{
    use NullableSchema;
    use TypeableSchema;

    /**
     * Create a new Enum schema.
     *
     * By default, the type is "string".
     * You can chain ->inferTypes() or ->setType() for more control.
     *
     * @param  array  $enum  Allowed values for the enum
     * @param  string|null  $description  Optional description
     */
    public function __construct(array $enum, ?string $description = null)
    {
        $this->schema = [
            'type' => 'string', // default safe type
            'enum' => $enum,
        ];

        if (! in_array($description, [null, '', '0'], true)) {
            $this->schema['description'] = $description;
        }
    }

    /**
     * Override types manually.
     */
    public function setTypes(array $types): self
    {
        $this->schema['type'] = $types;

        return $this;
    }

    /**
     * Automatically infer type(s) from enum values.
     */
    public function inferTypes(): self
    {
        /** @var array<int, mixed> $enum */
        $enum = $this->schema['enum'];
        $types = array_unique(array_map(static fn (mixed $value): string => gettype($value), $enum));

        $mappedTypes = array_map(fn (string $type): string => match ($type) {
            'string' => 'string',
            'integer' => 'integer',
            'double' => 'number',   // PHP float shows as "double"
            'boolean' => 'boolean',
            'NULL' => 'null',
            default => 'string',
        }, $types);

        $this->schema['type'] = count($mappedTypes) === 1
            ? $mappedTypes[0]
            : $mappedTypes;

        return $this;
    }
}

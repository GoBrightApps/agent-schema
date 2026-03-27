<?php

declare(strict_types=1);

namespace Agent\Schema;

use Agent\Schema\Concerns\StrictableSchema;

class ObjectSchema extends BaseSchema
{
    use StrictableSchema;

    /**
     * Create a new class instance.
     */
    public function __construct(?string $description = null, ?string $name = null)
    {
        $this->schema = [
            'type' => 'object',
            'additionalProperties' => false,
        ];

        if (! in_array($name, [null, '', '0'], true)) {
            $this->schema['name'] = $name;
        }

        if (! in_array($description, [null, '', '0'], true)) {
            $this->schema['description'] = $description;
        }

        $this->schema['required'] = [];
        $this->schema['additionalProperties'] = false;
        $this->schema['properties'] = [];
    }

    /**
     * Set required fields for the schema.
     */
    public function required(array $fields): self
    {
        $this->schema['required'] = $fields;

        return $this;
    }

    /**
     * Set name field for the schema.
     */
    public function setName(string $name): self
    {
        $this->schema['name'] = $name;

        return $this;
    }

    /**
     * Set the additionalProperties
     */
    public function additional(bool $additional): self
    {
        $this->schema['additionalProperties'] = $additional;

        return $this;
    }

    /**
     * Add a property to the schema.
     */
    public function property(string $name, BaseSchema $schema, ?string $description = null): self
    {
        /** @var array<string, array<string, mixed>> $properties */
        $properties = $this->schema['properties'];
        $properties[$name] = $schema->toArray();

        if (! in_array($description, [null, '', '0'], true)) {
            $properties[$name]['description'] = $description;
        }

        $this->schema['properties'] = $properties;

        return $this;
    }

    /**
     * Create the schema to output schema
     */
    public function output(string $name, bool $strict = true): OutputSchema
    {
        return new OutputSchema($name, $this->schema, $strict);
    }
}

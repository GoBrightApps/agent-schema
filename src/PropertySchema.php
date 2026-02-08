<?php

declare(strict_types=1);

namespace Agent\Schema;

class PropertySchema extends BaseSchema
{
    /**
     * Create a new class instance.
     */
    public function __construct(public string $name, BaseSchema $schema, ?string $description = null, public bool $required = false)
    {
        $this->schema = $schema->toArray();

        if (! in_array($description, [null, '', '0'], true)) {
            $this->schema['description'] = $description;
        }
    }

    /**
     * Mark property as required.
     */
    public function required(): self
    {
        $this->required = true;

        return $this;
    }

    /**
     * Return array in the format expected by ObjectSchema.
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'schema' => $this->schema,
            'required' => $this->required,
        ];
    }
}

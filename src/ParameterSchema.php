<?php

declare(strict_types=1);

namespace Agent\Schema;

use Agent\Schema\Concerns\StrictableSchema;
use Agent\Schema\Concerns\TypeableSchema;

class ParameterSchema extends BaseSchema
{
    use StrictableSchema;
    use TypeableSchema;

    /**
     * Create a new parameter schema instance.
     */
    public function __construct(string $name, string $description, ObjectSchema $schema)
    {
        $this->schema = [
            'type' => 'function',
            'name' => $name,
            'description' => $description,
            'parameters' => $schema->toArray(),
        ];
    }
}

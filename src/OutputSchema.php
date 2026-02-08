<?php

declare(strict_types=1);

namespace Agent\Schema;

class OutputSchema extends BaseSchema
{
    /**
     * Create a new class instance.
     */
    public function __construct(string $name, array $schema, bool $strict = true)
    {
        $this->schema = [
            'name' => $name,
            'schema' => $schema,
            'strict' => $strict,  // reject extra/malformed fields
        ];
    }

    /**
     * Transform the schema object to response_format
     */
    /** @return array<string, mixed> */
    public function responseFormat(): array
    {
        return [
            'type' => 'json_schema',
            'json_schema' => $this->toArray(),
        ];
    }
}

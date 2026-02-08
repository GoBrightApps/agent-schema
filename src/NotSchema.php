<?php

declare(strict_types=1);

namespace Agent\Schema;

class NotSchema extends BaseSchema
{
    /**
     * Create a new class instance.
     */
    public function __construct(BaseSchema $schema)
    {
        $this->schema = [
            'not' => $schema->toArray(),
        ];
    }
}

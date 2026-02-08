<?php

declare(strict_types=1);

namespace Agent\Schema;

class BooleanSchema extends BaseSchema
{
    /**
     * Create a new class instance.
     */
    public function __construct(?string $description = null)
    {
        $this->schema = ['type' => 'boolean'];

        if (! in_array($description, [null, '', '0'], true)) {
            $this->schema['description'] = $description;
        }
    }
}

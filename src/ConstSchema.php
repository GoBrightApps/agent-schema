<?php

declare(strict_types=1);

namespace Agent\Schema;

class ConstSchema extends BaseSchema
{
    /**
     * Create a new class instance.
     */
    public function __construct(mixed $value, ?string $description = null)
    {
        $this->schema = ['const' => $value];

        if (! in_array($description, [null, '', '0'], true)) {
            $this->schema['description'] = $description;
        }
    }
}

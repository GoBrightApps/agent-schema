<?php

declare(strict_types=1);

namespace Agent\Schema\Concerns;

trait NullableSchema
{
    /**
     * Create a nullable schema type.
     */
    public function nullable(): self
    {
        if (isset($this->schema['type'])) {
            $this->schema['type'] = [$this->schema['type'], 'null'];
        }

        return $this;
    }
}

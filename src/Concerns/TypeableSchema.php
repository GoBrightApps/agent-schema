<?php

declare(strict_types=1);

namespace Agent\Schema\Concerns;

trait TypeableSchema
{
    /**
     * Override the type manually.
     */
    public function setType(string $type): self
    {
        $this->schema['type'] = $type;

        return $this;
    }

    /**
     * Override the type manually.
     */
    public function type(string $type): self
    {
        return $this->settype($type);
    }
}

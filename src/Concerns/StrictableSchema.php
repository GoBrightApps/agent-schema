<?php

declare(strict_types=1);

namespace Agent\Schema\Concerns;

trait StrictableSchema
{
    /**
     * Set the scheme to strict
     */
    public function setStrict(bool $strict = true): self
    {
        $this->schema['strict'] = $strict;

        return $this;
    }

    /**
     * Set the scheme to strict
     */
    public function strict(bool $strict = true): self
    {
        return $this->setStrict($strict);
    }
}

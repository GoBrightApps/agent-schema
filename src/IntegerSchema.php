<?php

declare(strict_types=1);

namespace Agent\Schema;

class IntegerSchema extends BaseSchema
{
    /**
     * Create a new class instance.
     */
    public function __construct(?string $description = null)
    {
        $this->schema = ['type' => 'integer'];

        if (! in_array($description, [null, '', '0'], true)) {
            $this->schema['description'] = $description;
        }
    }

    /**
     * The number must be a multiple of this value
     */
    public function multipleOf(int $multipleOf): self
    {
        $this->schema['multipleOf'] = $multipleOf;

        return $this;
    }

    /**
     * The number must be less than or equal to this value.
     */
    public function maximum(int $maximum): self
    {
        $this->schema['maximum'] = $maximum;

        return $this;
    }

    /**
     * The number must be greater than or equal to this value.
     */
    public function minimum(int $minimum): self
    {
        $this->schema['minimum'] = $minimum;

        return $this;
    }

    /**
     * The number must be greater than or equal to this value.
     */
    public function min(int $max): self
    {
        return $this->minimum($max);
    }

    /**
     * The number must be less than or equal to this value.
     */
    public function max(int $max): self
    {
        return $this->maximum($max);
    }

    /**
     * The number must be greater than this value.
     */
    public function exclusiveMinimum(int $exclusiveMinimum): self
    {
        $this->schema['exclusiveMinimum'] = $exclusiveMinimum;

        return $this;
    }

    /**
     * The number must be less than this value.
     */
    public function exclusiveMaximum(int $maximum): self
    {
        $this->schema['exclusiveMaximum'] = $maximum;

        return $this;
    }
}

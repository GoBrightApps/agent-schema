<?php

declare(strict_types=1);

namespace Agent\Schema;

use Agent\Schema\Concerns\NullableSchema;

class StringSchema extends BaseSchema
{
    use NullableSchema;

    /**
     * Create a new class instance.
     */
    public function __construct(?string $description = null)
    {
        $this->schema = ['type' => 'string'];

        if (! in_array($description, [null, '', '0'], true)) {
            $this->schema['description'] = $description;
        }
    }

    /**
     * The number must be less than or equal to this value.
     */
    public function maxLength(int $maxLength): self
    {
        $this->schema['maxLength'] = $maxLength;

        return $this;
    }

    /**
     * The number must be greater than or equal to this value.
     */
    public function minLength(int $minLength): self
    {
        $this->schema['minLength'] = $minLength;

        return $this;
    }

    /**
     * The number must be less than or equal to this value.
     */
    public function max(int $max): self
    {
        return $this->maxLength($max);
    }

    /**
     * The number must be greater than or equal to this value.
     */
    public function min(int $min): self
    {
        return $this->minLength($min);
    }

    /**
     * A regular expression that the string must match.
     */
    public function pattern(string $pattern): self
    {
        $this->schema['pattern'] = $pattern;

        return $this;
    }

    /**
     * Predefined formats for strings.
     *
     * Currently supported: date-time,time, date, duration, email, hostname, ipv4, ipv6,uuid
     */
    public function format(string $format): self
    {
        $this->schema['format'] = $format;

        return $this;
    }
}

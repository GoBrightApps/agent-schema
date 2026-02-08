<?php

declare(strict_types=1);

namespace Agent\Schema;

class ArraySchema extends BaseSchema
{
    /**
     * Create a new class instance.
     */
    public function __construct(?BaseSchema $itemsSchema = null, ?string $description = null)
    {
        $this->schema['type'] = 'array';

        if (! in_array($description, [null, '', '0'], true)) {
            $this->schema['description'] = $description;
        }

        if ($itemsSchema instanceof BaseSchema) {
            $this->schema['items'] = $itemsSchema->toArray();
        }
    }

    /**
     * Set the items to the schema
     */
    public function items(BaseSchema $itemsSchema): self
    {
        $this->schema['items'] = $itemsSchema->toArray();

        return $this;
    }

    /**
     * The array must have at least this many items.
     */
    public function minItems(int $count): self
    {
        $this->schema['minItems'] = $count;

        return $this;
    }

    /**
     * The array must have at most this many items.
     */
    public function maxItems(int $count): self
    {
        $this->schema['maxItems'] = $count;

        return $this;
    }

    /**
     * The array must have at least this many items.
     */
    public function min(int $count): self
    {
        return $this->minItems($count);
    }

    /**
     * The array must have at most this many items.
     */
    public function max(int $count): self
    {
        return $this->maxItems($count);
    }
}

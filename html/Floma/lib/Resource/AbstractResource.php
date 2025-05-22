<?php

namespace Floma\Resource;

abstract class AbstractResource
{
    protected object $entity;
    protected array $extra = [];

    public function __construct(object $entity)
    {
        $this->entity = $entity;
    }

    public function add(array|string $key, mixed $value = null): static
    {
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                $this->extra[$k] = $v;
            }
        } else {
            $this->extra[$key] = $value;
        }

        return $this;
    }

    public function getEntity(): object
    {
        return $this->entity;
    }

    public function toArray(): array
    {
        return array_merge(
            $this->baseData(),
            $this->extra
        );
    }

    abstract protected function baseData(): array;
}

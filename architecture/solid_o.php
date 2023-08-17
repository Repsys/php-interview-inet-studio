<?php

class SomeObject
{
    public function __construct(
        private readonly string $name
    ){}

    public function getObjectName(): string
    {
        return $this->name;
    }

    public function getHandlerName(): string
    {
        return 'handle_' . $this->name;
    }
}

class SomeObjectsHandler
{
    /**
     * @param SomeObject[] $objects
     * @return array
     */
    public function handleObjects(array $objects): array
    {
        $handlers = [];

        foreach ($objects as $object) {
            if ($object instanceof SomeObject) {
                $handlers[] = $object->getHandlerName();
            }
        }

        return $handlers;
    }
}

$objects = [
    new SomeObject('object_1'),
    new SomeObject('object_2')
];

$soh = new SomeObjectsHandler();
$soh->handleObjects($objects);

//var_dump($soh->handleObjects($objects));
<?php

namespace Model\Configurator\DocComment\Entity\Tag;
use InvalidArgumentException;
use Model\Configurator\DocComment\DocTagInterface;
use Model\Entity\Entity;
use ReflectionClass;

class Filter
{
    public function __invoke(DocTagInterface $tag, ReflectionClass $class, Entity $entity)
    {
        $info = $this->parseFilterInformation($tag->getValue());

        if ($info['direction'] === 'to') {
            $entity->addExportFilter($info['name'], new $info['class']);
        } else {
            $entity->addImportFilter($info['name'], new $info['class']);
        }
    }

    private function parseFilterInformation($tag)
    {
        $parts = explode(' ', $tag);
        $parts = array_filter($parts);

        if (count($parts) !== 4) {
            throw new InvalidArgumentException('The tag "' . $tag . '" must be in the format of "@filter [to / from] [dot-notated name] using [class]".');
        }

        $parts[0] = strtolower($parts[0]);

        if (!in_array($parts[0], ['to', 'from'])) {
            throw new InvalidArgumentException('The direction "' . $parts[0] . '" specified for tag "' . $tag . '" is not valid.');
        }

        return [
            'direction' => $parts[0],
            'name'      => $parts[1],
            'class'     => $parts[3]
        ];
    }
}
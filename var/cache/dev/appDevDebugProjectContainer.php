<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerHx0mwig\appDevDebugProjectContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerHx0mwig/appDevDebugProjectContainer.php') {
    touch(__DIR__.'/ContainerHx0mwig.legacy');

    return;
}

if (!\class_exists(appDevDebugProjectContainer::class, false)) {
    \class_alias(\ContainerHx0mwig\appDevDebugProjectContainer::class, appDevDebugProjectContainer::class, false);
}

return new \ContainerHx0mwig\appDevDebugProjectContainer(array(
    'container.build_hash' => 'Hx0mwig',
    'container.build_id' => '85e1031b',
    'container.build_time' => 1527627016,
), __DIR__.\DIRECTORY_SEPARATOR.'ContainerHx0mwig');

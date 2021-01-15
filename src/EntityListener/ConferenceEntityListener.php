<?php

declare(strict_types=1);

namespace App\EntityListener;

use App\Entity\Conference;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class ConferenceEntityListener
{
    private SluggerInterface $slugger;

    public function __construct(SluggerInterface  $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(LifecycleEventArgs $eventArgs)
    {
        $entity = $eventArgs->getEntity();
        if (!$entity instanceof Conference) {
            return;
        }

        $entity->computeSlug($this->slugger);
    }

    public function preUpdate(LifecycleEventArgs $eventArgs)
    {
        $entity = $eventArgs->getEntity();
        if (!$entity instanceof Conference) {
            return;
        }

        $entity->computeSlug($this->slugger);
    }
}

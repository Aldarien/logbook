<?php
namespace Logbook\Models;

class EventFactory
{
    public static function create($event_type)
    {
        $class = ucwords($event_type) . 'Event';
        if (class_exists($class)) {
            return new $class();
        }
        return null;
    }
}

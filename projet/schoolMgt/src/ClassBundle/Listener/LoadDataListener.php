<?php
/**
 * Created by PhpStorm.
 * User: Baklouti
 * Date: 23/02/2019
 * Time: 02:28
 */

namespace ClassBundle\Listener;

use AncaRebeca\FullCalendarBundle\Event\CalendarEvent;
use AncaRebeca\FullCalendarBundle\Model\FullCalendarEvent;
use ClassBundle\Entity\Calendarannuel as MyCustomEvent;

class LoadDataListener
{
    /**
     * @param CalendarEvent $calendarEvent
     *
     * @return FullCalendarEvent[]
     */
    public function loadData(CalendarEvent $calendarEvent)
    {
        $startDate = $calendarEvent->getStart();
        $endDate = $calendarEvent->getEnd();
        $filters = $calendarEvent->getFilters();
        echo "qdqsd";
        print_r($startDate);
        //You may want do a custom query to populate the events

        try {
            $calendarEvent->addEvent(new MyCustomEvent('Event Title 1', new \DateTime()));
            $calendarEvent->addEvent(new MyCustomEvent('Event Title 2', new \DateTime()));
        } catch (\Exception $e) {
        }
//        return [
//            $calendarEvent->addEvent(new MyCustomEvent('Event Title 1', new \DateTime())),
//        $calendarEvent->addEvent(new MyCustomEvent('Event Title 2', new \DateTime()))
//        ];
    }
}

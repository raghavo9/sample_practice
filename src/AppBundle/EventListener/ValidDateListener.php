<?php

namespace AppBundle\EventListener;

use Pimcore\Event\Model\DataObjectEvent;
use Pimcore\Event\Model\ElementEventInterface;

class ValidDateListener
{
    public function onPreUpdate(ElementEventInterface $e)
    {
        if($e instanceof DataObjectEvent)
        {
            $obj = $e->getObject();
            $mdate= $obj->getSampleDate();
            $today = date("Y-m-d");
            p_r($today);
            p_r($mdate);
            if($mdate>$today)
            {
                p_r("SampleDate cannot be future date ");die;
            }

        }
    }
}
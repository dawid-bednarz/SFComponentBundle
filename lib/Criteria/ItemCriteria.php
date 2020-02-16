<?php

/**
 * @author Dawid Bednarz( dawid@bednarz.pro )
 * @license Read README.md file for more information and licence uses
 */

namespace DawBed\ComponentBundle\Criteria;

class ItemCriteria
{
    public static function byDynamicFields(array $fields) : self
    {
        $dynamicListCriteria = new self;
        foreach ($fields as $field) {
            $dynamicListCriteria->$field=null;
        }

        return $dynamicListCriteria;
    }
}

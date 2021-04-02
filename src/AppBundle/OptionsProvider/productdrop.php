<?php

namespace AppBundle\OptionsProvider;
use Pimcore\Model\DataObject\Brand;
use Pimcore\Model\DataObject\ClassDefinition\Data;
use Pimcore\Model\DataObject\ClassDefinition\DynamicOptionsProvider\SelectOptionsProviderInterface;


class productdrop implements SelectOptionsProviderInterface
{
    /**
     * @param array $context 
     * @param Data $fieldDefinition 
     * @return array
     */
    public function getOptions($context, $fieldDefinition) {
        //$object = isset($context["object"]) ? $context["object"] : null;
        //$fieldname = "id: " . ($object ? $object->getId() : "unknown") . " - " .$context["fieldname"];
        //$result = array(
        //
        //    array("key" => $fieldname .' == A', "value" => 2),
        //    array("key" => $fieldname .' == C', "value" => 4),
        //    array("key" => $fieldname .' == F', "value" => 5)
        //
        //);
        //return $result;

        
        $result = array();
        $brands = new Brand\Listing();
        $brands->setCondition("Active=?",true);
        foreach($brands as $brand)
        {
            //array_push($result , ["key" => $brand->getBrandName(), "value" =>$brand->getBrandName()]);
            array_push($result , ["key" =>$brand->getBrandName(), "value"=>$brand->getBrandName()]);
        }
        return $result;



    }


    /**
     * Returns the value which is defined in the 'Default value' field  
     * @param array $context 
     * @param Data $fieldDefinition 
     * @return array
     */
    public function getDefaultValue($context, $fieldDefinition) {
        return $fieldDefinition->getDefaultValue();
        //return "default";
    }

    /**
     * @param array $context 
     * @param Data $fieldDefinition 
     * @return bool
     */
    public function hasStaticOptions($context, $fieldDefinition) {
        return true;
    }

    


}
<?php
/**
 * @author Vyas Dipen
 * @copyright Copyright (c) 2017 Vyasb2b  
 * @package vyasb2b_magento
 */ 

class Vyasb2b_Magento_Model_System_Config_Source_View {
    
    public function toOptionArray() {

    		$cmspages = Mage::getModel('cms/page')->getCollection();

 $data = array();
        foreach ($cmspages as $item)
        {            
            $data[] = array(
                'value' => $item->getIdentifier(), 
                'label' => $item->getTitle(),
            );
        } 
        
        array_unshift($data, array('value'=>'x', 'label'=> Mage::helper('adminhtml')->__('-- Please Select --')));
    		
        return $data;



       
       
    }

}
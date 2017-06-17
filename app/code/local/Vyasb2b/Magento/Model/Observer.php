<?php
/**
 * @author Vyas Dipen
 * @copyright Copyright (c) 2017 Vyasb2b  
 * @package vyasb2b_magento
 */ 

class Vyasb2b_Magento_Model_Observer

{
	public function Btobredirections(Varien_Event_Observer $observer)
	{

		$storeId = Mage::app()->getStore()->getStoreId();
		$PGconfig = Mage::getStoreConfig('b2bcms/vyasb2bpage/b2bcmslist', $storeId);
		$hmId = Mage::getStoreConfig('web/default/cms_home_page', $storeId);
		$b2benable = Mage::getStoreConfig('b2bcms/vyasb2bpage/b2bcmsenable', $storeId);

		if ($b2benable)
		{
			$hmyes = Mage::getBlockSingleton('page/html_header')->getIsHomePage();
			$pgA = explode(",", $PGconfig);
			if (!Mage::getSingleton('customer/session')->isLoggedIn())
			{
				$currentUrl = Mage::helper('core/url')->getCurrentUrl();
				$ci = rtrim($currentUrl, '/');
				$kl = explode("/", $ci);
				if (count($kl) > 0)
				{
					$key = count($kl) - 1;
					$model = Mage::getModel('cms/page')->getCollection()->addFieldTofilter('identifier', $kl[$key])->getFirstItem();
					$pgID = $model->getIdentifier();
					$chkr = Mage::app()->getRequest()->getRouteName();
					if ($chkr == 'cms' && in_array($pgID, $pgA))
					{
						Mage::app()->getFrontController()->getResponse()->setRedirect(Mage::getUrl('customer/account'));
					}

					if (in_array($hmId, $pgA))
					{
						Mage::app()->getFrontController()->getResponse()->setRedirect(Mage::getUrl('customer/account'));
					}
				}
			}
		}
	}
}

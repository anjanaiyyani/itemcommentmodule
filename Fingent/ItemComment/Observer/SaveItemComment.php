<?php

namespace Fingent\ItemComment\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class SaveItemComment implements ObserverInterface
{

    public function execute(Observer $observer)
    {
        $itemsInfo = $observer->getData('info');
        $quote=$observer->getCart()->getQuote();
        $quoteItems = $quote->getAllVisibleItems();
        foreach ($quoteItems as $item) {
            $itemId=$item->getId();
            $quoteItem=$quote->getItemById($itemId);
            $comment=$itemsInfo[$itemId]['comments'];
            if(!empty($comment)){
                $quoteItem->setItemComment($comment);
            }
        }
        
    }
}
<?php

declare(strict_types=1);

namespace Wiktor\LoggedInDiscount\Plugin;

use Magento\Catalog\Model\Product;
use Magento\Customer\Model\Session;
use Magento\Framework\App\ObjectManager;

class PriceDiscounter
{
    public function afterGetPrice(Product $subject, float $result): float
    {
        if ($this->getCustomerSession()->isLoggedIn()) {
            $discount = $result * 0.15;

            return $result - $discount;
        }

        return $result;
    }

    private function getCustomerSession(): mixed
    {
        $objectManager = ObjectManager::getInstance();

        return $objectManager->create(Session::class);
    }
}

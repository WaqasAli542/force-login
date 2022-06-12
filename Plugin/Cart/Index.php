<?php

namespace WMZ\ForceLogin\Plugin\Cart;

use Closure;
use Magento\Checkout\Controller\Cart\Index as CartIndex;
use Magento\Framework\Controller\Result\Redirect;
use WMZ\ForceLogin\Plugin\ForceLogin;

class Index extends ForceLogin
{
    /**
     * @param CartIndex $subject
     * @param Closure $proceed
     * @return Redirect|mixed
     */
    public function aroundExecute(CartIndex $subject, Closure $proceed)
    {
        if ($this->isLoggedIn() || !($this->forceLoginEnable(ForceLogin::CART))) {
            return $proceed();
        }
        return $this->redirectToLogin();
    }
}

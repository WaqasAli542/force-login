<?php

namespace WMZ\ForceLogin\Plugin\Product;

use Closure;
use Magento\Catalog\Controller\Product\View as ProductView;
use Magento\Framework\Controller\Result\Redirect;
use WMZ\ForceLogin\Plugin\ForceLogin;

class View extends ForceLogin
{
    /**
     * @param ProductView $subject
     * @param Closure $proceed
     * @return Redirect|mixed
     */
    public function aroundExecute(ProductView $subject, Closure $proceed)
    {
        if ($this->isLoggedIn() || !($this->forceLoginEnable(ForceLogin::PRODUCT))) {
            return $proceed();
        }
        return $this->redirectToLogin();
    }
}

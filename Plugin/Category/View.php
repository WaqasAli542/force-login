<?php

namespace WMZ\ForceLogin\Plugin\Category;

use Closure;
use Magento\Catalog\Controller\Category\View as CategoryView;
use Magento\Framework\Controller\Result\Redirect;
use WMZ\ForceLogin\Plugin\ForceLogin;

class View extends ForceLogin
{
    /**
     * @param CategoryView $subject
     * @param Closure $proceed
     * @return Redirect|mixed
     */
    public function aroundExecute(CategoryView $subject, Closure $proceed)
    {
        if ($this->isLoggedIn() || !($this->forceLoginEnable(ForceLogin::CATEGORY))) {
            return $proceed();
        }
        return $this->redirectToLogin();
    }
}

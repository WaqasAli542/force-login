<?php

namespace WMZ\ForceLogin\Plugin\Search\Term;

use Closure;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Search\Controller\Term\Popular as PopularSearch;
use WMZ\ForceLogin\Plugin\ForceLogin;

class Popular extends ForceLogin
{
    /**
     * @param PopularSearch $subject
     * @param Closure $proceed
     * @return Redirect|mixed
     */
    public function aroundExecute(PopularSearch $subject, Closure $proceed)
    {
        if ($this->isLoggedIn() || !($this->forceLoginEnable(ForceLogin::SEARCH_TERM))) {
            return $proceed();
        }
        return $this->redirectToLogin();
    }
}

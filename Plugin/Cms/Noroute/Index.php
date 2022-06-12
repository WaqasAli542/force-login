<?php

namespace WMZ\ForceLogin\Plugin\Cms\Noroute;

use Closure;
use Magento\Cms\Controller\Noroute\Index as CmsNoRouteIndex;
use Magento\Cms\Helper\Page;
use Magento\Framework\Controller\Result\Redirect;
use WMZ\ForceLogin\Plugin\ForceLogin;

class Index extends ForceLogin
{
    /**
     * @param CmsNoRouteIndex $subject
     * @param Closure $proceed
     * @return Redirect|mixed
     */
    public function aroundExecute(CmsNoRouteIndex $subject, Closure $proceed)
    {
        $pageId = $this->helperData->getCmsPageConfig(Page::XML_PATH_NO_ROUTE_PAGE);
        $forceCmsPageId = $this->helperData->getCmsPageId();
        $forceCmsPage = strpos($forceCmsPageId, $pageId);

        if ($this->isLoggedIn() || !($this->forceLoginEnable(ForceLogin::CMS_NO_ROUTE)) || $forceCmsPage === false) {
            return $proceed();
        }

        return $this->redirectToLogin();
    }
}

<?php

namespace WMZ\ForceLogin\Plugin\Cms\Index;

use Closure;
use Magento\Cms\Controller\Index\Index as CmsPageIndex;
use Magento\Cms\Helper\Page;
use Magento\Framework\Controller\Result\Redirect;
use WMZ\ForceLogin\Plugin\ForceLogin;

class Index extends ForceLogin
{
    /**
     * @param CmsPageIndex $subject
     * @param Closure $proceed
     * @param null $coreRoute
     * @return Redirect|mixed
     */
    public function aroundExecute(CmsPageIndex $subject, Closure $proceed, $coreRoute = null)
    {
        $pageId = $this->helperData->getCmsPageConfig(Page::XML_PATH_HOME_PAGE);
        $forceCmsPageIds = $this->helperData->getCmsPageId();
        $forceCmsPage = strpos($forceCmsPageIds, $pageId);

        if ($this->isLoggedIn() || !($this->forceLoginEnable(ForceLogin::CMS_INDEX)) || $forceCmsPage === false) {
            return $proceed();
        }

        return $this->redirectToLogin();
    }
}

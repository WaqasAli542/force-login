<?php

namespace WMZ\ForceLogin\Plugin\Cms\Page;

use Closure;
use Magento\Cms\Controller\Page\View as CmsPageView;
use Magento\Customer\Model\SessionFactory as CustomerSessionFactory;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Message\ManagerInterface;
use WMZ\ForceLogin\Helper\Data;
use Magento\Cms\Helper\Page;
use Magento\Store\Model\StoreManagerInterface;
use WMZ\ForceLogin\Plugin\ForceLogin;

class View extends ForceLogin
{
    /**
     * @var Page
     */
    private $pageCms;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * View constructor.
     * @param ManagerInterface $messageManager
     * @param RedirectFactory $resultRedirectFactory
     * @param CustomerSessionFactory $customerSessionFactory
     * @param Data $helperData
     * @param Page $pageCms
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ManagerInterface $messageManager,
        RedirectFactory $resultRedirectFactory,
        CustomerSessionFactory $customerSessionFactory,
        Data $helperData,
        Page $pageCms,
        StoreManagerInterface $storeManager
    ) {
        parent::__construct(
            $messageManager,
            $resultRedirectFactory,
            $customerSessionFactory,
            $helperData
        );
        $this->pageCms = $pageCms;
        $this->storeManager = $storeManager;
    }

    /**
     * @param CmsPageView $subject
     * @param Closure $proceed
     * @return Redirect|mixed
     * @throws NoSuchEntityException
     */
    public function aroundExecute(CmsPageView $subject, Closure $proceed)
    {
        if ($this->isLoggedIn() || !($this->forceLoginEnable(ForceLogin::CMS_PAGE))) {
            return $proceed();
        }
        $forceCmsPageId = $this->helperData->getCmsPageId();
        $pageId = $subject->getRequest()->getParam(
            'page_id',
            $subject->getRequest()->getParam('id', false)
        );

        $cmsUrl = str_replace(
            $this->storeManager->getStore()->getBaseUrl(),
            '',
            $this->pageCms->getPageUrl($pageId)
        );
        if (strpos($forceCmsPageId, $cmsUrl) !== false) {
            return $this->redirectToLogin();
        }
        return $proceed();
    }
}

<?php

namespace WMZ\ForceLogin\Block\Account;

use Magento\Customer\Block\Account\AuthorizationLink as CustomerAuthorizationLink;
use Magento\Customer\Model\Url;
use Magento\Framework\App\Http\Context as HttpContext;
use Magento\Framework\Data\Helper\PostHelper;
use Magento\Framework\Escaper;
use Magento\Framework\View\Element\Template\Context;
use WMZ\ForceLogin\Helper\Data as DataHelper;

class AuthorizationLink extends CustomerAuthorizationLink
{
    /**
     * @var DataHelper
     */
    private $dataHelper;

    /**
     * @var Escaper
     */
    private $escaper;

    /**
     * AuthorizationLink constructor.
     * @param Context $context
     * @param HttpContext $httpContext
     * @param Url $customerUrl
     * @param Escaper $escaper
     * @param PostHelper $postDataHelper
     * @param DataHelper $dataHelper
     * @param array $data
     */
    public function __construct(
        Context $context,
        HttpContext $httpContext,
        Url $customerUrl,
        Escaper $escaper,
        PostHelper $postDataHelper,
        DataHelper $dataHelper,
        array $data = []
    ) {
        parent::__construct(
            $context,
            $httpContext,
            $customerUrl,
            $postDataHelper,
            $data
        );
        $this->escaper = $escaper;
        $this->dataHelper = $dataHelper;
    }

    /**
     * Enable module
     * @return bool
     */
    public function isEnable(): bool
    {
        return $this->dataHelper->isEnable();
    }

    /**
     * Enable customer registration
     * @return bool
     */
    public function isEnableRegister(): bool
    {
        return $this->dataHelper->isEnableRegister();
    }

    /**
     * @return Escaper
     */
    public function getEscaper()
    {
        return $this->escaper;
    }
}

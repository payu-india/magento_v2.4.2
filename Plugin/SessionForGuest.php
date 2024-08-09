<?php
namespace PayUIndia\Payu\Plugin;

use Magento\Customer\Model\AccountManagement;
use Magento\Checkout\Model\Session as CheckoutSession;

class SessionForGuest
{
    /**
     * @var CheckoutSession
     */
    protected $checkoutSession;

    /**
     * @param CheckoutSession $checkoutSession
     */
    public function __construct(
        CheckoutSession $checkoutSession
    ) {
        $this->checkoutSession = $checkoutSession;
    }

    /**
     * Around plugin for isEmailAvailable
     *
     * @param AccountManagement $subject
     * @param \Closure $proceed
     * @param string $customerEmail
     * @param int|null $websiteId
     * @return bool
     */
    public function aroundIsEmailAvailable(
        AccountManagement $subject,
        \Closure $proceed,
        $customerEmail,
        $websiteId = null
    ) {
        //set email for Guest Custome
        $this->checkoutSession->setGuestCustomerEmail($customerEmail);

       
        $result = $proceed($customerEmail, $websiteId);

        return $result;
    }
}

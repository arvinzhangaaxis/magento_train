<?php

namespace Aaxis\Train\Block;

use Magento\Framework\Data\Collection;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\User\Api\Data\UserInterface;
use Magento\User\Model\UserFactory;

class User extends Template
{

    /**
     * @var UserFactory
     */
    protected $userInterfaceFactory;

    /** @var UserInterface */
    protected $user;

    /**
     * User constructor.
     * @param UserFactory $userInterfaceFactory
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        UserFactory $userInterfaceFactory,
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->userInterfaceFactory = $userInterfaceFactory;
    }

    public function getUser()
    {
        $email = $this->_request->getParam('email');
        if ($email && is_null($this->user)) {
            /** @var Collection $collection */
            $collection = $this->userInterfaceFactory->create()->getCollection();
            $collection
                ->setPageSize(1)
                ->addFieldToFilter('email', ['eq' => [$email]]);
            $this->user = $collection->getFirstItem();
        }
        return $this->user;
    }
}

<?php

namespace Aaxis\Train\Block;

use Magento\Framework\App\Request\Http;
use Magento\Framework\Data\Collection;
use Magento\Framework\View\Element\Template;
use Magento\User\Api\Data\UserInterface;
use Magento\User\Model\UserFactory;
use Magento\Framework\View\Element\Template\Context;

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
     * @param Context $context
     * @param array $data
     * @param UserFactory $userInterfaceFactory
     */
    public function __construct(
        Context $context,
        array $data = [],
        UserFactory $userInterfaceFactory
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
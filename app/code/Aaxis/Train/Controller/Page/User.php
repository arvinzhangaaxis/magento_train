<?php

namespace Aaxis\Train\Controller\Page;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;

class User implements HttpGetActionInterface
{
    /** @var PageFactory */
    protected $resultPageFactory;

    /**
     * User constructor.
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        return $this->resultPageFactory->create();
    }
}

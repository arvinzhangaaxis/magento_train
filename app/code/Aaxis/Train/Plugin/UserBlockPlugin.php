<?php

namespace Aaxis\Train\Plugin;

use Magento\User\Api\Data\UserInterface;
use Psr\Log\LoggerInterface;

class UserBlockPlugin
{

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * UserBlockPlugin constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }


    /**
     * @param \Aaxis\Train\Block\User $subject
     */
    public function beforeGetUser(\Aaxis\Train\Block\User $subject)
    {
        $this->logger->info('before get user');
    }

    /**
     * @param \Aaxis\Train\Block\User $subject
     * @param $result
     * @return mixed
     */
    public function afterGetUser(\Aaxis\Train\Block\User $subject, $result)
    {
        $this->logger->info('after get user');
        return $result;
    }

    /**
     * @param \Aaxis\Train\Block\User $subject
     * @param callable $proceed
     * @return mixed
     */
    public function aroundGetUser(\Aaxis\Train\Block\User $subject, callable $proceed)
    {
        $this->logger->info('around get user: start');
        $user = $proceed();
        if ($user instanceof UserInterface) {
            $this->logger->info('around get user: end', [
                'email' => $user->getEmail(),
            ]);
        } else {
            $this->logger->info('around get user: end');
        }
        return $user;
    }

}
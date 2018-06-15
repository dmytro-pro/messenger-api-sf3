<?php

namespace MessengerBundle\Repository;

use MessengerBundle\Entity\Message;
use UserBundle\Entity\User;

/**
 * MessageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MessageRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @param User    $author
     * @param User    $recipient
     * @param Message $message
     *
     * @return Message
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function messageUser(User $author, User $recipient, Message $message)
    {

        /** @var DialogRepository $dialogRepo */
        $dialogRepo = $this->getEntityManager()->getRepository('MessengerBundle:Dialog');

        $dialog = $dialogRepo->createOrGetDialogWithUsers([$author, $recipient]);


        $dialog->addMessage($message);
        $this->getEntityManager()->persist($message);
        $this->getEntityManager()->flush($message);

        return $message;
    }
}

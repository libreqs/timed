<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AuthenticationCredentialsNotFoundException;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Get;
use App\Controller\RestController;
use App\Entity\User;
use App\Error\Code;
use App\Exception\IllegalStateException;
use JMS\SecurityExtraBundle\Annotation\PreAuthorize;

/**
 *
 * @PreAuthorize("isFullyAuthenticated()")
 */
class AccountController extends RestController
{
    /**
     * Returns the {@see \Intrester\ApiBundle\Entity\User} entity of the user which is currently accessing the API.
     *
     * @ApiDoc(
     *  section="Account",
     *  description="Return user of current session.",
     *  statusCodes={
     *      200="Returned when successful"
     *  }
     * )
     * @return Response<User>
     *
     * Internal documentation.
     */
    public function getAccountAction()
    {
        /** @var $token OAuthToken */
        $token = $this->get('security.token_storage')->getToken();
        if (!$token) {
            throw new AuthenticationCredentialsNotFoundException("Firewall not configured. Missing user authentication token.");
        }

        /** @var $user User */
        $user = $token->getUser();
        if (!$user) {
            throw new IllegalStateException('Authorized user with access token reached API while no associated user was found: ' . $token);
        }

        return $this->displayResult($user, array('detail', 'private'));
    }
}
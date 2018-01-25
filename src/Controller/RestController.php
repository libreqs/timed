<?php
namespace App\Controller;

use FOS\RestBundle\Context\Context;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\FOSRestController;
use App\Entity\ErrorResponse;
use Symfony\Component\HttpFoundation\Response;

class RestController extends FOSRestController
{
    /**
     * Utility function to easily return with a nice error view, if the type of error is known (no unexpected exception).
     *
     * @param $errorCode
     * @param $httpCode
     * @param null $message
     * @param array $headers
     * @return mixed
     */
    protected function error($errorCode, $httpCode, $message = null, $headers = array())
    {
        if (is_array($message)) {
            $message = implode('; ', $message);
        }
        $error = new ErrorResponse($errorCode);
        if ($message) {
            $error->setMessage($message);
        }
        //return $this->get('fos_rest.view_handler')->handle(new View($error, $httpCode, $headers));
        return $this->handleView(new View($error, $httpCode, $headers));
    }

    /**
     * Utility function for easy displaying pre-configured serializable entities.
     *
     * @param $data
     * @param string $serializerGroups
     * @return mixed
     */
    protected function displayResult($data, $serializerGroups = 'list', $httpStatusCode = Response::HTTP_OK, $headers = array())
    {
        if (!$data || empty($data)) {
            return new Response('', $httpStatusCode, $headers);
        }

        $view = new View($data, $httpStatusCode, $headers);
        $context = new Context();
        $view->setContext($context);
        $context->setSerializeNull(true);

        if ($serializerGroups != null) {
            if (!is_array($serializerGroups)) {
                $serializerGroups = array($serializerGroups);
            }
            $context->setGroups($serializerGroups);
        }

        return $this->get('fos_rest.view_handler')->handle($view);
    }

    protected function displayNoContent($httpStatusCode = Response::HTTP_NO_CONTENT, $headers = array())
    {
        return $this->displayResult('', null, $httpStatusCode, $headers);
    }
}
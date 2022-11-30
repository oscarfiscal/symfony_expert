<?php

namespace App\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use App\Service\ClientHttp;

class UrlAccessValidator extends ConstraintValidator
{

    private $clientHttp;

    public function __construct(ClientHttp $clientHttp)
    {
        $this->clientHttp = $clientHttp;
    }

    public function validate($value, Constraint $constraint)
    {
        /* @var App\Validator\UrlAccess $constraint */

        if (null === $value || '' === $value) {
            return;
        }

        $code = $this->clientHttp->getCodeUrl($value);

        if (null  === $code) {
          $code = 'Error';
        }

        if(200 !== $code){
              // TODO: implement the validation here
        $this->context->buildViolation($constraint->message)
        ->setParameter('{{ code }}', $code)
        ->addViolation();
        }

      
    }
}

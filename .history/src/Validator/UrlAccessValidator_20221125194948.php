<?php

namespace App\Validator;

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

        // TODO: implement the validation here
        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $value)
            ->addViolation();
    }
}

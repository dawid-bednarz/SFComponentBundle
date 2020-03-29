<?php

/**
 * @author Dawid Bednarz( dawid@bednarz.pro )
 * @license Read README.md file for more information and licence uses
 */

namespace DawBed\ComponentBundle\Validator\Constraints;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UniqueEntityValidator extends ConstraintValidator
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function validate($value, Constraint $constraint)
    {
        $propertyValue = PropertyAccess::createPropertyAccessor()
            ->getValue($value, $constraint->field);

        if ($propertyValue === null) {
            return;
        }

        if ($value instanceof UniqueEntityInterface) {
            if ($value->getOldUniqueValue() === $propertyValue) {
                return;
            }
        }
        $query = [
            $constraint->field => $propertyValue
        ];

        if ($this->entityManager->getRepository($constraint->entityClass)
                ->findOneBy($query) !== null) {
            $this->context->buildViolation($constraint->message)
                ->atPath($constraint->field)
                ->addViolation();
        }
    }
}


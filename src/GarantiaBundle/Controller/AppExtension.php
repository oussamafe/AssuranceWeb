<?php
/**
 * Created by PhpStorm.
 * User: marou
 * Date: 13/04/2019
 * Time: 21:33
 */

namespace GarantiaBundle\Controller;


use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('verif', [$this, 'VerifierParticipation']),
        ];

    }


}
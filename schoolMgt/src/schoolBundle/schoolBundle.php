<?php

namespace schoolBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class schoolBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}

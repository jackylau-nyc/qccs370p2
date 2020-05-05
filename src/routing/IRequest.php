<?php

//  Adapted from this tutorial: https://medium.com/the-andela-way/how-to-build-a-basic-server-side-routing-system-in-php-e52e613cf241.

namespace routing; 

interface IRequest{
    public function getBody();
}
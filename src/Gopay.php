<?php

namespace GopaySdk;

class Gopay
{
    public function accessGopay(): AccessGopay
    {
        return AccessGopay::getInstance();
    }

    public function paymentInit(): CheckOut
    {
        return CheckOut::getInstance();
    }
}
?>
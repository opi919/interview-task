<?php

function cartArray(){
    $item = \Cart::getContent();

    return $item->toArray();
}
<?php

function cartArray(){
    $item = \Cart::session(auth()->id())->getContent();

    return $item->toArray();
}
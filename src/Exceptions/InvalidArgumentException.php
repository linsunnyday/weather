<?php

namespace Linsunnyday\Weather\Exceptions;

/**
 * 当调用方传递的 $format 不是 xml 也不是 json 时需要抛出参数异常
 */
class InvalidArgumentException extends Exception
{

}
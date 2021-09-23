<?php

namespace App\Http\Controllers\Func;

use App\Http\Controllers\Controller;

/**
 * PHP基础函数学习
 * Class FuncController
 * @package App\Http\Controllers\Func]
 */
class FuncController extends Controller
{

    function index()
    {

    }


    /**
     * 测试闭包
     */
    function testClosure()
    {
        $name = 'fanhuilin';
        $this->test(
            function () use ($name) {
                return 'name:'.$name;
            }
        );
    }

    function test($a)
    {
        dd($a());
    }

    /**
     * 测试array_reduce
     */
    function testArrayReduce()
    {
        // array_reduce() 将回调函数 callback 迭代地作用到 array 数组中的每一个单元中，从而将数组简化为单一的值。

        $two_dimensional = array();

        $two_dimensional['foo'] = array('a' => 1, 'b' => 2, 'c' => 3);
        $two_dimensional['bar'] = array('a' => 4, 'b' => 5, 'c' => 6);

        // $one_dimensional = array_reduce($two_dimensional, 'array_merge', array());

        $one_dimensional = array_reduce($two_dimensional, function ($one_dimensional, $value) {
                dump($one_dimensional);
                dump($value);
                return array_merge($one_dimensional, array_values($value)); // [1,2,3]
            }, array());
    }
}

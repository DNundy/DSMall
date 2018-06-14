<?php
namespace Api\Controller;
use Think\Controller;
class CodeController extends Controller {
    public function index(){
       $Verify = new \Think\Verify();
       $Verify->entry();
    }
}
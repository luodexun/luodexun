<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/15
 * Time: 17:41
 */
namespace app\admin\widget;


use think\Controller;

class Common extends Controller {
    public function test(){

        return $this->fetch('common/test');

    }
    public function add(){

        return $this->fetch('common/add');

    }

    public function header(){

      return $this->fetch('common/header');

  }
    public function left(){

        return $this->fetch('common/left');

    }
    public function lis(){

        return $this->fetch('common/list');

    }
    public function ae(){

        return $this->fetch('common/ae');

    }
    public function memberList(){

        return $this->fetch('common/memberList');

    }
    public function memberAe(){

        return $this->fetch('common/memberAe');

    }
    public function cateList(){

        return $this->fetch('common/cateList');

    }
    public function cateAe(){

        return $this->fetch('common/cateAe');

    }
    public function goodsData(){

        return $this->fetch('common/goodsData');

    }
    public function goodsAdd(){

        return $this->fetch('common/goodsAdd');

    }
    public function goodsEdit(){

        return $this->fetch('common/goodsEdit');

    }
    public function imageData(){

        return $this->fetch('common/imageData');

    }
    public function imageAdd(){

        return $this->fetch('common/imageAdd');

    }
    public function upload(){
        return $this->fetch('common/upload');

    }
}
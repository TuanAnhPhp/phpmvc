<?php
class indexController{

    /**
     * Đây là phuwong thức khởi tạo của 1 Class
     * sẽ luôn được chạy ngay khi class được khởi tạo qua từ khóa new
     * indexController constructor.
     */
    public function __construct()
    {

    }

    public function indexAction(){

        echo '<br> Tôi là indexAction đây';

        echo '<br>' . __METHOD__;
    }

}
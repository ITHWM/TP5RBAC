<?php

namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Db;
use think\Session;

class Login extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        return view('admin@login/index');
    }

    public function dologin(Request $request)
    {
        $data = $request->port();
        //验证密码
        $username = $data['username'];
        $userpass = $data['userpass'];
        //验证用户名
        $user = Db::name('user')->where(['username'=>$username])->find();
        if(!$user) {
            $this->error('用户名不存在的');
            return;
        }
        if ($user['userpass'] != md5($userpass)) {
            $this->error('密码错误,即将爆炸');
            return;
        }
        // 将用户信息存session
        Session::set('admin_user',$user);
        $hh = Session::get('admin_user');
    }


}

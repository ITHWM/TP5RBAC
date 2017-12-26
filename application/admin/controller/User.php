<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;
class User extends Controller
{
    /**
     * 显示用户首页列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $list = Db::table('lamp_user')->select();
        $this->assign('list', $list);
        return view('user/index');
    }
    /**
     * 显示添加用户页.
     *
     * @return \think\Response
     */
    public function create()
    {
        return view('user/add');
    }
    /**
     * 保存新增用户
     *
     * @param  \think\Request $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $data = input('post.');
        $data['userpass'] = md5($data['userpass']);
        $result = Db::table('lamp_user')->insert($data);
        if ($result) {
            $this->success('新增管理员成功！', 'admin/user/index');
        } else {
            $this->error('新增管理员失败！');
        }
    }
    /**
     * 显示指定的资源
     *
     * @param  int $id
     * @return \think\Response
     */
    public function read($id)
    {
    }
    /**
     * 显示编辑用户页.
     *
     * @param  int $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $data = Db::table('lamp_user')->where('id', $id)->find();
        $this->assign('data', $data);
        return view('user/edit');
    }
    /**
     * 保存更新的信息
     *
     * @param  \think\Request $request
     * @param  int $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        $info = $request->put();
        $data = [
            'username' => $info['username'],
            'name' => $info['name'],
            'userpass' => md5($info['userpass']),
        ];
        $result = Db::table('lamp_user')->where('id', $id)->update($data);
        if ($result) {
            $this->success('用户修改成功！','admin/user/index');
        } else {
            $this->error('用户修改失败！');
        }
    }
    /**
     * 删除指定用户
     *
     * @param  int $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $result = Db::table('lamp_user')->delete($id);
        if ($result) {
            $this->success('用户删除成功！','admin/user/index');
        } else {
            $this->error('用户删除失败！');
        }
    }
}
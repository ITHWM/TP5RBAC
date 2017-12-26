<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;
class Role extends Controller
{
    /**
     * 显示角色用户列表首页
     *
     * @return \think\Response
     */
    public function index()
    {
        $list = Db::table('lamp_role')->select();
        $this->assign('list', $list);
        return view('role/index');
    }
    
    /**
     * 显示添加角色
     * @return [type] [description]
     */
    public function create()
    {
        return view('role/add');
    }
    /**
     * 显示新增角色页面
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function save(Request $request)
    {
        $info = $request->post();
        $data = [
            'name' => $info['name'],
            'status' => 1,
            'remark' => $info['remark']
        ];
        $result = Db::table('lamp_role')->insert($data);
        if ($result) {
            $this->success('新增角色成功！', 'admin/role/index');
        } else {
            $this->error('新增角色失败！');
        }
    }
    
    /**
     * [read description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑页面
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function edit($id)
    {
        $data = Db::table('lamp_role')->where('id', $id)->find();
        $this->assign('data', $data);
        return view('role/edit');
    }

    
    /**
     * 显示修改角色页面
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function update(Request $request, $id)
    {
        $info = $request->put();
        $data = [
            'name' => $info['name'],
            'remark' => $info['remark'],
        ];
        $result = Db::table('lamp_role')->where('id', $id)->update($data);
        if ($result) {
            $this->success('角色修改成功！','admin/role/index');
        } else {
            $this->error('角色修改失败！');
        }
    }
    
    /**
     * 删除指定用户
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function delete($id)
    {
        $result = Db::table('lamp_role')->delete($id);
        if ($result) {
            $this->success('角色删除成功！','admin/role/index');
        } else {
            $this->error('角色删除失败！');
        }
    }
    public function active($id,$status)
    {
        if ($status == 0) {
            $status = 1;
        } else {
            $status = 0;
        }
        $result = Db::table('lamp_role')->where('id', $id)->update(['status' => $status]);
        if ($result) {
            $this->success('角色状态修改成功！','admin/role/index');
        } else {
            $this->error('角色状态修改失败！');
        }
    }
}
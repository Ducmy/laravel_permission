<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Http\Controllers\Controller;
use App\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{

    function __construct()
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Check author
        $id = Auth::id();
        $user = \App\User::find($id);
        $roles = $user->getRoleNames();
        $role = $roles[0];
        if ($role === 'admin') {

            $data = User::orderBy('id', 'DESC')->where('id', '<>', 1)->paginate(5);
            $user_lists = array();
            $index = 0;
            foreach ($data as $key => $user) {
                if (($user->getRoleNames())[0] !== 'admin') {
                    $user_lists[$index] = $user->id;
                    $index++;
                }
            }
            $data = User::orderBy('id', 'DESC')
                ->where('id', '<>', 1)
                ->whereIn('id', $user_lists)
                ->paginate(5);

            return view('admin.admin.users.index', compact('data'))
                ->with('i', ($request->input('page', 1) - 1) * 5);
        }

        $data = QueryBuilder::for(User::class)
            ->allowedFilters(['name', 'email'])
            ->paginate(5)
            ->appends(request()->query());
        
        // $data = User::orderBy('id', 'DESC')->paginate(5);
        return view('admin.users.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('admin.users.create', compact('roles'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        return redirect()->route('users.index')
            ->with('success', 'Đã tạo thành viên.');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.users.show', compact('user'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('admin.users.edit', compact('user', 'roles', 'userRole'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            // 'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('roles'));
        return redirect()->route('users.index')
            ->with('success', 'Thành viên đã được cập nhật thành công');
    }

    public function naptien(Request $request, $id) {

        $this->validate($request, [
            'credit' => 'required',
        ]);
        $input = $request->all();

        $user = User::find($id);
        // dd($user->credit);
        // dd($input);

        $user->credit = $user->credit + (float)$input['credit'];
        $user->save();

        return redirect()->route('users.index')
            ->with('success', 'Bạn đã nạp tiền cho thành viên');
    }

    public function thanhtoan(Request $request, $id) {

        $user = User::find($id);
        if( ($user->getRoleNames())[0] === 'teacher') {
            $user->credit = 0;
            $user->save();
            return redirect()->route('users.index')
            ->with('success', 'Đã thanh toán cho giáo viên.');
        } else {
            return redirect()->route('users.index')
            ->with('success', 'Thanh toán sai đối tượng.');
        }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'Thành viên đã được xóa');
    }
}

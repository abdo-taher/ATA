<?php
namespace App\Http\Controllers;
use App\Http\Requests\UserRequest;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use mysql_xdevapi\Exception;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {

        $this->middleware('permission:قائمة المستخدمين', ['only' => ['index']]);
        $this->middleware('permission:اضافة مستخدم', ['only' => ['create','store']]);
        $this->middleware('permission:تعديل مستخدم', ['only' => ['edit','update']]);
        $this->middleware('permission:حذف مستخدم', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('users.index',compact('data'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();

        return view('users.Add_user',compact('roles'));

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {

        try {
            $input = $request->all();
            if(!empty($input['image'])){
                $image = $request->image->getClientOriginalName();
                $request->image->move(base_path('assets/img/admin')."/".$request->username , $image);
                $input['image'] = $image;
            }
            $input['password'] = Hash ::make($input['password']);
            $user = User::create($input);
            $user->assignRole($request->input('roles'));
            return redirect()->route('Users.index')
                ->with('success','تم اضافة المستخدم بنجاح');

        }catch (Exception $exception){
            return redirect()->route('Users.index')
                ->with('fail','حدث خطا ما');
        }

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
        return view('Users.show',compact('user'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($username)
    {
        try {
            $id = User::where('username',$username)->get('id');
            $user = User::find($id)->first();
            $roles = Role::pluck('name','name')->all();
            $userRole = $user->roles->pluck('name','name')->all();
            return view('users.edit',compact('user','roles','userRole'));

        }catch (Exception $exception){
            return redirect()->route('Users.index')
                ->with('fail','حدث خطا ما');
        }

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        try {
            $input = $request->all();
            if(!empty($input['password'])){
                $input['password'] = Hash::make($input['password']);
            }
            $user = User::find($id);
            if (!empty($input['image'])){
                Storage::disk('admin')->delete("/". $user->username , $user->image);
                $image = $request->image->getClientOriginalName();
                Storage::disk('admin')->put("/".$request->username , $image);
                $input['image'] = $image;
            }
            unset($input['password']);
            $user->update($input);
            Db::table('model_has_roles')->where('model_id',$id)->delete();
            $user->assignRole($request->input('roles'));
            return redirect()->route('Users.index')
                ->with('success','تم تحديث معلومات المستخدم بنجاح');
        }catch (Exception $exception){
            return redirect()->route('Users.index')
                ->with('fail','حدث خطا ما');
        }

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function active($id)
    {
        try {
            $user = User::find($id);
            $status = $user->status == 1 ? 0 : 0 ;
            $user->update(['status'=>$status]);
            return redirect()->route('Users.index')->with('success','تم ايقاف المستخدم بنجاح');

        }catch (Exception $exception){
            return redirect()->route('Users.index')
                ->with('fail','حدث خطا ما');
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
        try {

            $user = User::find($id)->delete();
            Storage::disk('attachment')->deleteDirectory("/".$user->username);
            return redirect()->route('Users.index')->with('success','تم حذف المستخدم بنجاح');
        }catch (Exception $exception){
            return redirect()->route('Users.index')
                ->with('fail','حدث خطا ما');
        }

    }
}

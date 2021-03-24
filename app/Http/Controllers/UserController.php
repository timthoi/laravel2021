<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller {
    /**
     * Get pagination users
     *
     * @return User[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index(Request $request) {
        $search = $request->input('search');
        // $all = $request->all();
        
        $users = User::where('first_name', 'like', '%' . $search . '%')->paginate(2);
        
        // SQL thuan
        //        $query = "SELECT first_name, last_name, phone,email FROM users";
        //        $rs = DB::select($query);
        
        
        //   $total = count($rs);
        // dump data
        //        dd($rs);
        //        echo "<pre>";
        //        print_r($total);
        //        var_dump($total);
        //        die;
        
        //
        //            $from_page
        //to_page: 10
        //current_page
        //per_page
        
        
        //  dd($rs);
        //var_dump($rs);die;
        //  return User::all();
        return $users;
    }
    
    public function getDetailuser($id) {
    
    }
    /**
     * @param $id
     *
     * @return mixed
     */
    public function show($id) {
        $userModel = new User();
    
        $selectRaw = [
            [
                'strRaw' => 'first_name, last_name',
                'params' => []
            ]
        ];
    
        $whereRaw = [
            [
                'strRaw' => 'id = ? AND phone = ?',
                'params' => [$id, 00123213]
            ]
        ];
    
        $users = $userModel->getUserDetail($selectRaw, $whereRaw);
       
        // ket noi database: truy xuat users get user theo user id
        
        
        // Neu khong tim thhay
        if (empty($users)) {
            return [
                'code' => 0,
                "data" => []
            ];
        }
        
        $result = [
            'code' => 1,
            "data" => [
                $users
            ]
        ];
        
        return $result;
    }
    
    /**
     * @param  Request  $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function store(UserCreateRequest $request) {
        
        //        $user = User::create([
        //                                 'first_name' => $request->input('first_name'),
        //                                 'last_name' => $request->input('last_name'),
        //                                 'phone' => $request->input('phone'),
        //                                 'email' => $request->input('email'),
        //                                 'password' => Hash::make($request->input('password'))
        //                             ]);
        //
        $user = User::create($request->only('first_name', 'last_name', 'email', 'phone') + [
                                 'password' => Hash::make($request->input('password'))
                             ]);
        
        return response($user, 201);
    }
    
    /**
     * @param  Request  $request
     * @param $id
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id) {
        // instance user
        $user = User::find($id);
        // var_dump($user);die;
        // return ORM instance
        
        //        $user->update([
        //                          'first_name' => $request->input('first_name'),
        //                          'last_name' => $request->input('last_name'),
        //                          'phone' => $request->input('phone'),
        //                          'email' => $request->input('email'),
        //                          'password' => Hash::make($request->input('password'))
        //                      ]);
        
        $user->update($request->only('first_name', 'last_name', 'email'));
        
        
        return response($user, Response::HTTP_ACCEPTED);
    }
    
    /**
     * Hard delete
     * Soft delete
     *
     * @param $id
     *
     * @return mixed
     */
    public function destroy($id) {
        //User::destroy($id);
        
        return User::find($id);
    }
}

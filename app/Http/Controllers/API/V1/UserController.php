<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();
        return response()->json([
            'statusCode' => 200,
            'message' => 'User.list',
            'data'=> $users
        ]);
    }
    public function show(User $user)
    {
        // $user = User::find($id);
        return response()->json([
            'statusCode' => 200,
            'message' => 'User.detail',
            'data'=> $user
        ]);
    }

    public function register(Request $request)
    {
        // validate fields
        $attrs = $request->validate([
            'username' => 'required|max:255',
            'phone_number' => 'required|min:9',
            'password' => 'required|min:6|confirmed'
        ]);
        // create user
        $user = User::create([
            'username' => $attrs['username'],
            'phone_number' => $attrs['phone_number'],
            'password' => bcrypt($attrs['password']),
            'remember_token' => Str::random(60),
        ]);
        // return user & token in response
        $token =   $user->createToken('API Token')->accessToken;
        return response()->json([
            'statusCode' => 200,
            'message' => 'user.register',
            'data' => $user,
            'token' => $token
        ]);      
    }
    public function login(Request $request)
    {
        // validate fields
        $attrs = $request->validate([
            'phone_number' => 'required|min:9',
            'password' => 'required|min:6',
        ]);
        // attempt login
        if(!Auth::attempt($attrs))
        {
            return response()->json([
                'success' => false,
                'statusCode' => 403,
                'message' => 'Invalid credentials.'
            ]);
        }
        $accessToken =Auth::user()->createToken('API Token')->accessToken;
        return response()->json([
            'statusCode' => 200,
            'success' => true,
            'user' => auth()->user(), 
            'access_token' => $accessToken
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'statusCode' => 200,
            'message' => 'Logout success.'
        ]);
    }
    // public function register(Request $request)
    // {
    //     // validate fields
    //     $attrs = $request->validate([
    //         'username' => 'required|max:255',
    //         'phone_number' => 'required|min:9',
    //         'password' => 'required|min:6|confirmed'
    //     ]);
    //     // create user
    //     $user = User::create([
    //         'username' => $attrs['username'],
    //         'phone_number' => $attrs['phone_number'],
    //         'password' => Hash::make($attrs->get('password')),
    //         'remember_token' => Str::random(60),
    //     ]);
    //     // return user & token in response
    //     $token = $user->createToken('API Token')->accessToken;
    //     $response = ['token' => $token];
    //     return response()->json([
    //         'statusCode' => 200,
    //         'message' => 'user.register',
    //         'data' => $user,
    //         'token' => $response
    //     ]);      
    // }
    

    // public function logout (Request $request) {
    //     $token = $request->user()->token();
    //     $token->revoke();
    //     $response = ['message' => 'You have been successfully logged out!'];
    //     return response($response, 200);
    // }
    // public function store(Request $request)
    // {
    //     $user = new User();
    //     $user->name = $request->get('name');
    //     $user->email = $request->get('email');
    //     $user->password = Hash::make($request->get('password'));
    //     $user->save();
    //     return response()->json([
    //         'statusCode' => 200,
    //         'message' => 'user.store',
    //         'data' => $user
    //     ]);
    // }
    
    // public function store(Request $request)
    // {
    //     $user = new User();

    //     $user->username = $request->get('username');
    //     $user->phone_number = $request->get('phone_number');
    //     $user->password = Hash::make($request->get('password'));
    //     $user->save();
        
    //     $token = $user->createToken('API Token')->accessToken;
        
    //     $user->getRememberToken();
    //     return response()->json([
    //         'statusCode' => 200,
    //         'message' => 'user.store',
    //         'data' => $user,
    //         'token' => $token
    //     ]); 
    // }
        
    

    // public function register(Request $request)
    // {
    //     $data = $request->validate([
    //         'username' => 'required|max:255',
    //         'phone_number' => 'required|min:9',
    //         'password' => 'required|min:6|confirmed'
    //     ]);

    //     $data['password'] = bcrypt($request->password);

    //     $user = User::create($data);
    //     $accessToken = $user->createToken('AuthToken')->accessToken;

    //     return response([ 'user' => $user, 'token' => $accessToken]);
    // }

    // public function login(Request $request)
    // {
    //     $data = $request->validate([
    //         'username' => 'required|max:255',
    //         'password' => 'required|min:6',
    //     ]);

    //     if (!auth()->attempt($data)) {
    //         return response(['error_message' => 'Incorrect Details. 
    //         Please try again']);
    //     }

    //     $token = auth()->user()->createToken('API Token')->accessToken;

    //     return response(['user' => auth()->user(), 'token' => $token]);

    // }

    // public function storeaddress(Request $request)
    // {
    //     $address = new UserAddress();
    //     $user_id = User::find($id);

    //     $address->user_id = $user_id;
    //     $address->address_line1	 = $request->get('address_line1');
    //     $address->address_line2 = $request->get('address_line2');     
    //     $address->city = $request->get('city');  
    //     $address->save();        
    // }

    // Register user
    // public function register(Request $request)
    // {
    //     // validate fields
    //     $attrs = $request;

    //     $user = User::create([
    //         'username' => $attrs['username'],
    //         'phone_number' => $attrs['phone_number'],
    //         'password' => Hash::make($attrs->get('password')),
    //     ]);
    //     // return user & token in response
    //     return response()->json([
    //         'user' => $user,
    //         'token' => $user->createToken('secret')->plainTextToken
    //     ],200);      
    // }
    // Register user
    
}

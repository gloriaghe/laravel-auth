<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'address' => [ 'nullable', 'string', 'max:100'],
            'birth' => [ 'nullable', 'date'],
            'phone' => ['nullable',  'string', 'max:20'],

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // try{
        $user = DB::transection(function () use ($data){
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),

        ]);

        UserDetails::create([
            'user_id' => $user->id,
            'address' => $data['address'],
            'phone' => $data['phone'],
            'birth' => $data['birth'],
        ]);
        return $user;
    });

        return $user;
    }
    // catch (Exception $e){
    //     return null;
    // }
}


public function register(Request $request)
{
    $this->validator($request->all())->validate();

    $user = $this->create($request->all());

if($user) {
    event(new Registered($user));

    $this->guard()->login($user);

    if ($response = $this->registered($request, $user)) {
        return $response;
    }

    return $request->wantsJson()

                ? new JsonResponse([], 201)
                : redirect($this->redirectPath());
}
else{
    return redirect()->route('resgister')->with('db-error', 'Errore nel DB. Riprovare');
}
}
}

<?php

namespace Ddondola\Http\Controllers\Auth;

use Ddondola\Repositories\CountryRepository;
use Ddondola\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Validation\Rule;

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
    protected $redirectTo = '/home';

    protected $countries;

    /**
     * Create a new controller instance.
     *
     * @param CountryRepository $countries
     */
    public function __construct(CountryRepository $countries)
    {
        $this->middleware('guest');
        $this->countries = $countries;
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
            'id' => [
                'required', 'numeric',
                Rule::exists('countries')->where(function ($query) use ($data) {
                    $query->where('id', $data["id"])->where('active', 1);
                }),
            ],
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ],
        [
            'id.required' => 'You need to select a country',
            'id.exists' => 'You need to select a valid country',
            'id.numeric' => 'You need to select a valid country'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \Ddondola\User|\Illuminate\Database\Eloquent\Model
     */
    protected function create(array $data)
    {
        return $this->countries->id($data["id"])->users()->create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.register', ['countries' => $this->countries->active()]);
    }
}

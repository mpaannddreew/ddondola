<?php

namespace Ddondola\Http\Controllers;


use Ddondola\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Messenger\Facades\Messenger;
use Shoppie\Repository\ShopRepository;

class HomeController extends Controller
{
    protected $users;

    /**
     * HomeController constructor.
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users) {
        $this->middleware('auth')->except(['index']);
        $this->users = $users;
    }

    /**
     * @param Request $request
     * @param \Shoppie\Repository\ProductRepository $products
     * @param ShopRepository $shops
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, \Shoppie\Repository\ProductRepository $products,
                          \Shoppie\Repository\ShopRepository $shops) {
        if (Auth::check()) {
            if ($request->user()->hasVerifiedEmail()) {
                return view('ddondola.home');
            }

            return redirect()->route('verification.notice');
        }
        return view('welcome', ['products' => $products->featured(6), 'shops' => $shops->featured(6)]);
    }

    public function dashboard() {
        return view('ddondola.me.dashboard');
    }

    public function messenger($participant = null) {
        if ($participant) {
            $converser = Messenger::resolveParticipant($participant);
            if ($converser) {
                if ($converser->is(Auth::user())) {
                    abort(404);
                }
            } else {
                abort(404);
            }
        }

        return view('ddondola.me.messenger');
    }

    public function notifications(Request $request) {
        return view('ddondola.me.notifications', ['user' => $request->user()]);
    }

    public function profile(Request $request) {
        return view('ddondola.me.profile', ['user' => $request->user()]);
    }

    public function profileEdit(Request $request) {
        return view('ddondola.me.user-info', ['user' => $request->user()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function profileUpdate(Request $request) {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
        ];

        if ($request->input('email') != $request->user()->email)
            $rules['email'] = 'required|string|email|max:255|unique:users';

        $this->validate($request, $rules);

        $data = array_merge($request->only(['first_name', 'last_name']), ['profile' => $request->only(['phone_number', 'address', 'about'])]);

        if ($request->input('email') != $request->user()->email)
            $data['email'] = $request->input('email');

        $this->users->update($request->user(), $data);

        return redirect()->route('my.profile.edit')->with('success', 'Profile updated successfully');
    }


    public function showChangePassword(Request $request) {
        return view('ddondola.me.change-password', ['user' => $request->user()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updatePassword(Request $request) {
        $this->validate($request, [
            'old_password' => 'required|string|min:6',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if (!Hash::check($request->input('old_password'), $request->user()->password)) {
            return redirect()->route('show.change.password')->with('error', 'You entered a wrong old password');
        }

        $this->users->update($request->user(), ['password' => bcrypt($request->input('password'))]);

        return redirect()->route('show.change.password')->with('success', 'Profile password updated successfully');
    }

    public function followers(Request $request) {
        return view('ddondola.me.followers', ['user' => $request->user()]);
    }

    public function following(Request $request) {
        return view('ddondola.me.following', ['user' => $request->user()]);
    }
}

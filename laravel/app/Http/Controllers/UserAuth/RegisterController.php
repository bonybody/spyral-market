<?php

namespace App\Http\Controllers\UserAuth;

use App\Course;
use App\School;
use App\User;
use App\User_detail;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Response;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;

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
     * Where to redirect after login / registration.
     *
     * @var string
     */
    protected $redirectTo = 'home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('user.guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = [
            'school_id' => 'required|integer',
            'course_id' => 'required|integer',
            'name' => 'required|string|max:30',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|alpha-num|min:6',
        ];

        $messages = [
            'school_id.required' => '学校を選択してください。',
            'school_id.integer' => '不正な値です。',
            'course_id.required' => '学科を選択してください。',
            'course_id.integer' => '不正な値です。',
            'name.required' => '名前は入力必須です。（後から変更可能）',
            'name.string' => '名前は文字列で入力してください。',
            'name.max' => '名前は30文字以内で入力してください。',
            'email.required' => 'メールアドレスは入力必須です。',
            'email.email' => 'メールアドレス形式で入力してください。',
            'email.max' => '255文字以下で入力してください。',
            'email.unique' => 'そのメールアドレスは既に使用されています。',
            'password.required' => 'パスワードは入力必須です。',
            'password.alpha-num' => 'パスワードは英数字で入力してください。',
            'password.min:6' => 'パスワードは6文字以上で入力してください。',
        ];

        return Validator::make($data, $rules, $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => \Hash::make($data['password']),
            'school_id' => $data['school_id'],
            'course_id' => $data['course_id'],
        ]);
    }

    /**
     * Show the application registration form.
     *
     * @return Response
     */

    public function showRegistrationForm()
    {
        $schools = School::all();
        $courses = Course::all();
        $hals = null;
        $modes = null;
        $isens = null;
        foreach ($courses as $course) {
            switch ($course->school_id) {
                case 1:
                    $hals[] = $course;
                    break;
                case 2:
                    $modes[] = $course;
                    break;
                case 3:
                    $isens[] = $course;
                    break;
            }
        }
        return view('welcomes.register', ['schools' => $schools, 'hals' => $hals, 'modes' => $modes, 'isens' => $isens]);
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('user');
    }
}

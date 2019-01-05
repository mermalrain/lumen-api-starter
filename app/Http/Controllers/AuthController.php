<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RecoverPasswordRequest;
use App\Http\Requests\RegisterRequest;
use App\Mail\PasswordReset;
use App\Mail\Welcome;
use App\User;
use Exception;
use Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;


/**
 * Class AuthController
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function getUser()
    {
        return response()->json(['data' => Auth::user()]);
    }

    /**
     * @param LoginRequest $request
     *
     * @return JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);

        if (!$token) {
            return response()->json(['message' => trans('messages.login_failed')], 401);
        }

        return response()->json(['data' => ['user' => Auth::user(), 'token' => $token]]);
    }

    /**
     * @param RegisterRequest $request
     *
     * @return JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $name = $request->input('name');

        $user = User::createFromValues($name, $email, $password);

        Mail::to($user)->send(new Welcome($user));

        return response()->json(['data' => ['message' => 'Account created. Please verify via email.']]);
    }

    /**
     * @param String $token
     *
     * @return Response
     * @throws Exception
     */
    public function verify($token)
    {
        $user = User::verifyByToken($token);

        if (!$user) {
            return response()->json(['data' => ['message' => 'Invalid verification token']], 400);
        }

        return response()->json(['data' => ['message' => 'Account has been verified']]);
    }

    /**
     * @param Request $request
     * @throws ValidationException
     */
    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:users,email'
        ]);

        if ($validator->passes()) {
            $user = User::byEmail($request->input('email'));

            Mail::to($user)->send(new PasswordReset($user));
        }

        return response()->json(['data' => ['message' => 'Please check your email to reset your password.']]);
    }

    /**
     * @param Request $request
     * @param $token
     * @throws ValidationException
     */
    public function recoverPassword(Request $request, $token)
    {
        $this->validate($request, [
            'password' => 'required|min:8',
        ]);

        $user = User::newPasswordByResetToken($token, $request->input('password'));

        if ($user) {
            return response()->json(['data' => ['message' => 'Password has been changed.']]);
        } else {
            return response()->json(['data' => ['message' => 'Invalid password reset token']], 400);
        }
    }
}

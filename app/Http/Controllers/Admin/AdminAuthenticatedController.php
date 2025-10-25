<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAddNewPasswordRequest;
use App\Http\Requests\HandleLoginRequest;
use App\Http\Requests\SendResetPasswordLinkRequest;
use App\Mail\AdminSendPassWordResetLinkMail;
use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AdminAuthenticatedController extends Controller
{
    function login()
    {

        return view('admin.auth.login');
    }

    function handleLogin(HandleLoginRequest $request)
    {
        // dd($request->all());
        $request->authenticate();

        toast(__(auth()->guard('admin')->user()->name . ' ' . 'Login Successfully'), __('success'));


        return redirect()->route('admin.dashboard');
    }

    function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    function forgotPassword()
    {
        return view('admin.auth.forgot-password');
        // return view('admin.mail.send-password-reset-link');
    }

    function sendResetLink(SendResetPasswordLinkRequest $request)
    {
        // dd($request->all());
        $token = \Str::random(64);

        $admin = Admin::where('email', $request->email)->first();
        $admin->remember_token = $token;
        $admin->save();

        Mail::to($request->email)->send(new AdminSendPassWordResetLinkMail($token, $request->email));
        toast(__('A mail has been sent to your email address please check!'), __('success'));
        return redirect()->back();
    }

    function resetPasswordLink($token)
    {
        // dd($token);
        return view('admin.auth.reset-password', compact('token'));
    }

    function handleNewPassword(AdminAddNewPasswordRequest $request)
    {
        $admin = Admin::where(['email' => $request->email, 'remember_token' => $request->token])->first();

        if (!$admin) {
            toast(__('Invalid or expired token'), __('error'));
            return back();
        }

        $admin->password = bcrypt($request->password);
        $admin->remember_token = null;
        $admin->save();
        toast(__('Password reset successful'), __('success'));
        return redirect()->route('admin.login');
    }
}

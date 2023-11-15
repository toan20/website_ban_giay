<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;
use App\Http\Requests\AgentRegisterRequest;
use Illuminate\Support\Str;
// use App\Mail\MailKichHoatDaiLy;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\AgentLoginRequest;
use App\Mail\kichhoatdaily;
use Illuminate\Support\Facades\Auth;
use Stringable;

class AgentController extends Controller
{
    public function register()
    {
        $check = Auth::guard('agent')->check();
        if ($check) {
            toastr()->info(' Bạn đã được đăng nhập');
            return redirect('/');
        } else {
            return view('agent.register');
        }
    }

    public function registerAction(AgentRegisterRequest $request)
    {
        $parts = explode(" ", $request->ho_va_ten);
        if (count($parts) > 1) {
            $lastname = array_pop($parts);
            $firstname = implode(" ", $parts);
        } else {
            $firstname = $request->ho_va_ten;
            $lastname = " ";
        }


        $data = $request->all();
        $data['hash']       = Str::uuid();
        $data['ho_lot']     = $firstname;
        $data['ten']        = $lastname;
        $data['thanh_pho']  = "Đà Nẵng";
        $data['password']   = bcrypt($request->password);
        Agent::create($data);

        // Gửi mail
        Mail::to($request->email)->send(new kichhoatdaily(
            $request->ho_va_ten,
            $data['hash'],
            'Kích Hoạt Tài Khoản Đăng Ký'
        ));

        return response()->json([
            'status' => true,
        ]);
    }

    public function login()
    {
        $check = Auth::guard('agent')->check();
        if ($check) {
            toastr()->info(' Bạn đã được đăng nhập');
            return redirect('/'); //sửa trong n
        } else {
            return view('agent.login');
        }
    }

    public function loginAction(AgentLoginRequest $request)
    {
        $data  = $request->all();
        $check = Auth::guard('agent')->attempt($data);
        if ($check) {
            // Đã login thành công!!!
            $agent = Auth::guard('agent')->user();
            if ($agent->is_email) {
                return response()->json([
                    'status' => 2,
                ]);
            } else {
                //Chưa kích hoạt mail
                Auth::guard('agent')->logout();
                return response()->json([
                    'status' => 1,
                ]);
            }
        } else {
            //Login thất bại
            return response()->json(['status' => 0]);
        }
    }



    public function active($hash)
    {
        $agent = Agent::where('hash', $hash)->first();
        if ($agent->is_email) {
            toastr()->error('Tài khoản của bạn đã được kích hoạt trước đó!');
        } else {
            $agent->is_email = 1;
            $agent->save();
            toastr()->success('Tài khoản của bạn đã được kích hoạt!');
        }
        return redirect('/agent/login');
    }

    public function logout()
    {
        Auth::guard("agent")->logout();
        return redirect()->back();
    }
    public function indexNewinfo($id)
    {
        $check = Auth::guard('agent')->check();
        if ($check) {
            if ($id == Auth::guard('agent')->id()) {
                return view('agent.info');
            } else {
                toastr()->warning('không phải your account');
                return redirect()->back();
            }
        } else {
            toastr()->warning('bạn chưa đăng nhập');
            return redirect('/');
        }
    }
    public function newInfo( Request $request)
    {
        $check = Auth::guard('agent')->check();
        if ($check) {
            if (Auth::guard('agent')->id()) {
                $dataUpdate = Agent::find(Auth::guard('agent')->id());
                $parts = explode(" ", $request->ho_va_ten);
                if (count($parts) > 1) {
                    $lastname = array_pop($parts);
                    $firstname = implode(" ", $parts);
                } else {
                    $firstname = $request->ho_va_ten;
                    $lastname = " ";
                }

                $data = $request->all();
                $dataUpdate->update($data);
                return response()->json([
                    'status' => true,
                ]);

            } else {
                toastr()->warning('không phải your account');
                return redirect()->back();
            }
        } else {
            toastr()->warning('bạn chưa đăng nhập');
            return redirect('/');
        }


    }
    public function newAvatar( Request $request)
    {
        $check = Auth::guard('agent')->check();
        if ($check) {
            if (Auth::guard('agent')->id()) {
                $dataUpdate = Agent::find(Auth::guard('agent')->id());
                $data['img'] =  $request->img;
                $dataUpdate->update($data);
                return response()->json([
                    'status' => true,
                ]);

            } else {
                toastr()->warning('không phải your account');
                return redirect()->back();
            }
        } else {
            toastr()->warning('bạn chưa đăng nhập');
            return redirect('/');
        }


    }

    public function showI4($id)
    {
        $check = Auth::guard('agent')->check();
        if ($check) {
            $id= Auth::guard('agent')->id();
            if ($id) {
                $in4 = Agent::find($id);
                return response()->json([
                    'data' => $in4,
                    'stt' => true,
                ]);
            } else {
                toastr()->warning('không phải your account');
                return redirect()->back();
            }
        } else {
            toastr()->warning('bạn chưa đăng nhập');
            return redirect('/');
        }
    }

}

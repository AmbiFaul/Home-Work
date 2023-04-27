<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Psy\Readline\Hoa\Console;


class MainController extends Controller
{
    public function home()
    {
        return view('home');
    }
    public function about()
    {
        return view('about');
    }
    public function login()
    {
        return view('login');
    }
    public function signup()
    {
        return view('signup');
    }
    public function signupCheck(Request $request)
    {
        $valid = $request->validate([
            'password' => 'min:6'
        ]);

        $user = new Contact();
        $user->firstname = $request->input('first-name');
        $user->lastname = $request->input('last-name');
        $user->surname = $request->input('surname');
        $user->data = $request->input('data');
        $user->gender = $request->input('gender');
        $user->number = $request->input('number');
        $user->seria = $request->input('seria');


        if($request->input('password') == $request->input('password-confirm'))
        {
            $user->password = md5($request->input('password'));
        }
        else{
            return back()->withErrors([
                'password' => 'Пароли не совпадют',
            ]);
        }

        $user->email = $request->input('email');
        $user->save();
        return redirect()->route('home');
    }
    public function profil()
    {
        $id = session()->get('id');
        if($id==null)
        {
            return redirect('login');
        }
        else{
            return view('profil');
        }
    }
    public function loginCheck(Request $request)
    {
        session()->start();
        $credentials = $request->validate(
            [
                'email'=>['required', 'email'],
                'password'=>['required'],
            ]
        );
        $lll=session()->get('id');
        echo $lll;
        $passwords = DB::table('contacts')
            ->where('email', $request->input('email'))
            ->pluck('password');
        echo $passwords;
        $pas = '["'.md5($request->input('password')).'"]';
        echo $pas;
        if($pas==$passwords)
        {
            echo 'true';
            $id = DB::table('contacts')
                ->where('email', $request->input('email'))
                ->pluck('id');
            echo $id;
            $id = str_replace(["[", "]"], "", $id);
            echo $id;

            session()->put('id', $id);
            return redirect()->route('profil');

        }
        else {
            return back()->withErrors(
                [
                    'password' => 'Не верно введены данные'
                ]
            );
        }
    }
    public function leave()
    {
        session()->flush();
        return redirect()->route('home');
    }
    public function dataset(Request $request)
    {
        $user = new Contact();
        $pas = DB::table('contacts')
            ->where('id', session()->get('id'))
            ->pluck('password');
        $pas = str_replace(['["','"]'], "", $pas);
        $bd = array('firstname', 'lastname', 'surname', 'number', 'seria');
        $num = array();
        $data = array('first-name', 'last-name', 'surname', 'number', 'seria');
        if (md5($request->input('password-confirm')) == $pas){

            for($i = 0; $i<count($bd); $i++)
            {
                if($request->input($data[$i])) {
                    $user::where('id', session()->get('id'))->update([
                        $bd[$i] => $request->input($data[$i])
                    ]);
                }
            }
            return redirect()->route('home');
        }
        else{
            return back()->withErrors(
                [
                    'password-confirm' => 'Неверный пароль'
                ]
            );
        }
    }

}

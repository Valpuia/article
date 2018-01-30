<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facade\Input;
use App\Mailers\AppMailer;
use App\User;
use Hash;
use Auth;
use App\article;
use Validator;

class articleController extends Controller
{
    public function get_register(){
    	return view('register');
    }

    public function register(Request $request, AppMailer $mailer){

        $validator=Validator::make($request->all(),[
            'name'=>'required|unique:users']);
        if($validator->fails()){
            return redirect('/register')->with('name','Name is already taken');
        }
        

        $validator=Validator::make($request->all(),[
               #'email'=>'required|email|unique:users,email']);
                'email' => array(
                    'required',
                    'email',
                    'unique:users,email',
                    #'regex:/(\.edu(\.[a-z]+)?|\.ac\.[a-z]+)$/'
                    'regex:^\b[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,}\b^')]);
        if($validator->fails()){
            return redirect('/register')->with('email','Please Enter valid email | Email should contain a combination of a-zA-Z0-9 and special symbols');
        }

        $validator=Validator::make($request->all(),[
        	'password'=>'required|min:6',]);
        if($validator->fails()){
        		return redirect('/register')->with('passwords','The password must be at least 6 characters');
        }

        $validator=Validator::make($request->all(),[
        	'password'=>'required|confirmed|min:6',
        	'password_confirmation'=>'required']);
        if($validator->fails()){
        		return redirect('/register')->with('password','The password confirmation does not match');
        }

        $validator=Validator::make($request->all(),[
        		'phone'=>'required|unique:users,phone_no|regex:/[789]\d{9}$/'
        	]);
        if($validator->fails()){
        	return redirect('/register')->with('phone','Phone number already exist or Invalid phone number, please enter your phone number');
        }
        
    	$User=new User;
    	$User->name=$request->get('name');
    	$User->email=$request->get('email');
    	$User->phone_no=$request->get('phone');
    	$User->password= Hash::make($request->password);
        $User->token=$request->get('_token');

    	if($User->save()){
    		$mailer->sendEmailConfirmationTo($User);
            return redirect('/')->with('success','We have send you an email verification, please verify your email.');
    	}
    	else{
    		return redirect('/register')->with('error','registration-failed');
    	}
    }

    public function get_login(){
        if(Auth::check()){
            return redirect('/home');
        }
    	return view('login');
    }

    public function login(Request $request){
    	if(Auth::attempt(['email'=>$request->get('email'), 'password' =>$request->get('password')])){
            if(Auth::user()->activestatus == 1){
    		  return redirect('/home');   
            }
            else{
                Auth::logout();
                return redirect('/')->with('error','Please Verify your email to login');
            }
    	}
    	else{
    		return redirect('/')->with('error','invalid email or password');
    	}
    }

    public function get_home(Request $request){
        if(count($request->search)==0){
        	$post = article::paginate(5);
            $posts = article::paginate(5);
        }
        else{
            $users= user::where('name','like','%'.$request->search.'%')->pluck('id');

            if(count($users)!=0){
                $post=article::where('user_id','=',$users)->paginate(5);
                $posts=article::where('user_id','=',$users)->paginate(5);
            }
            else{
                $post=article::where('title','like','%'.$request->search.'%')->paginate(5);
                $posts=article::where('title','like','%'.$request->search.'%')->paginate(5);
            }
        }
    	return view('home',['articles'=>$post, 'posts'=>$posts]);
    }

    public function get_logout(){
    	Auth::logout();
    	return redirect('/');
    }

    public function get_newarticle(){
    	return view('newarticle');
    }
    public function newarticle(Request $request)
    {
    	$articles = new article;
    	$articles->title = $request->get('title');
    	$articles->content = $request->get('article');
    	$articles->user_id = Auth::user()->id;
    	if($articles->save()){
    		return redirect('/home')->with('success','Article posted successfully');
    	}
    	else{
    		return redirect('/home')->with('error','Problem occured while uploading');
    	}
    }

    public function get_myarticle(){
        $mynewarticle=article::where('user_id',Auth::user()->id)->paginate(6);
        $mynewarticles=article::where('user_id',Auth::user()->id)->paginate(6);
        $mynewarticles1=article::where('user_id',Auth::user()->id)->paginate(6);
        return view('myarticle',['mynewarticle'=>$mynewarticle, 'mynewarticles'=>$mynewarticles
            , 'mynewarticles1'=>$mynewarticles1]);

    }

    public function myarticle(Request $request){
        article::where('id',$request->get('id'))->update(['title'=>$request->get('title'),'content'=>$request->get('content')]);
        return redirect('/myarticle');
    }

    public function get_Delete(Request $request){
        $mynewarticle = article::find($request->get('del'));
        $mynewarticle->delete();
        return redirect('/myarticle');
    }

    public function get_user(){
        return view('/user');
    }

    public function profileUpdate(Request $request){
        if(Auth::user()->name!=$request->name){
            $validator=Validator::make($request->all(),[
                'name'=>'required|unique:users']);
            if($validator->fails()){
                return redirect('/user')->with('name','Name is already taken');
            }
        
        }

        if(Auth::user()->phone_no!=$request->phone){
            $validator=Validator::make($request->all(),[
                'phone'=>'required|unique:users,phone_no|regex:/[789]\d{9}$/']);
            if($validator->fails()){
                return redirect('/user')->with('phone','Phone number already exists or Invalid phone number');
            }
        }

        if($request->hasFile('ProfilePictures')){
            $validator = Validator::make($request->all(),['profilePictures'=>'max:2097152',]);
            if($validator->fails()){
                return redirect('/user')->withError($validator)->withInput();
            }
            $image=$request->file('ProfilePictures');
            $filename=time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path().'/ProfilePictures',$filename);
            user::where('id',Auth::user()->id)->update(['profilePicture'=>$filename]);
        }
        user::where('id',Auth::user()->id)->update([
            'name'=>$request->name,
            'phone_no'=>$request->phone]);
        return redirect('/user')->with('success','Profile updated successfully');
    }

    public function get_profile($id){
        $poster=user::where('name',$id)->first();
        return view('/viewuser',['poster'=>$poster]);
    }

    public function confirmEmail($token)
    {
        # code...
        $user=User::wheretoken($token)->firstOrFail();
        User::wheretoken($token)->firstOrFail()->confirmEmail();
        Auth::login($user);
        return redirect('/home')->with('verified','Thank you for verifying your email');
    }
}

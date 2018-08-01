<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\Input;
use App\Rules\CpfValidate;
use App\Rules\PasswordValidate;

class CrudController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        $users = User::paginate(5);
        return view('home')
            ->with('users', $users);
    }

    public function search(Request $request)
    {


        $users = User::where('name','like', "%$request->search%")
                       ->orWhere('cpf', 'like', '%'.preg_replace('/[.,-]/', '', $request->search).'%')
                       ->orWhere('email', 'like', "%$request->search%")
                       ->paginate(5);
        $users->appends($request->except('page'));
        return view('home')
            ->with('users', $users);
    }

    public function create(){
        return view('create');
    }

    public function store(Request $request){


        $request->validate([
                'name'             => 'required',
                'email'            => 'required|unique:users',
                'birthdate'        => 'required',
                'cpf'              => ['required', 'unique:users', new CpfValidate],
                'password'         => ['required', new PasswordValidate($request->password, $request->retypepassword)],
                'retypepassword'   => 'required',
                'image'            => 'required'
                ],
                ['name.required'     => "O campo nome deve ser preenchido",
                'email.required'     => 'O campo email deve ser preenchido',
                'email.unique'       => 'Já existe um usuário com este email',
                'cpf.required'       => 'O campo cpf deve ser preenchido',
                'cpf.unique'         => 'Já existe um usuário com este cpf',
                'birthdate.required' => 'O campo Data de nascimento deve ser preenchidoo',
                ]);


        $user = new User();
        $user->name      = $request->name;
        $user->email     = $request->email;
        $user->cpf       = $request->cpf;
        $user->birthdate = $request->birthdate;
        $user->password  = bcrypt($request->password);
        $user->image     = $request->image;
        $user->status    = 1;

        $user->save();

        return redirect()->back()->with('success', 'Usuário cadastrado com sucesso!');

    }

    public function edit($id){
        $user = User::find($id);
        return view('edit')
            ->with('user', $user);
    }

    public function update(Request $request, $id){


        $request->validate([
            'name'             => 'required',
            'email'            => 'required|unique:users,email,'.$id,
            'birthdate'        => 'required',
            'cpf'              => ['required', 'unique:users,cpf,'.$id, new CpfValidate],
            'password'         => ['required', new PasswordValidate($request->password, $request->retypepassword)],
            'retypepassword'   => 'required',
            'image'            => 'required'
        ],
            ['name.required'     => "O campo nome deve ser preenchido",
                'email.required'     => 'O campo email deve ser preenchido',
                'email.unique'       => 'Já existe um usuário com este email',
                'cpf.required'       => 'O campo cpf deve ser preenchido',
                'cpf.unique'         => 'Já existe um usuário com este cpf',
                'birthdate.required' => 'O campo Data de nascimento deve ser preenchidoo',
            ]);


        $user = User::find($id);
        $user->name      = $request->name;
        $user->email     = $request->email;
        $user->cpf       = $request->cpf;
        $user->birthdate = $request->birthdate;
        $user->password  = bcrypt($request->password);
        $user->image     = $request->image;
        $user->status    = 1;

        $user->save();

        return redirect()->back()->with('success', 'Usuário editado com sucesso!');

    }

    public function toggle($id){
        $user = User::find($id);
        $user->status = !$user->status;
        $user->save();

        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\Input;
use App\Rules\CpfValidate;

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
                'password'         => 'required',
                'retypepassword'   => 'required'
                ],
                ['name.required'     => "O campo nome deve ser preenchido",
                'email.required'     => 'O campo email deve ser preenchido',
                'email.unique'       => 'Já existe um usuário com este email',
                'cpf.required'       => 'O campo cpf deve ser preenchido',
                'cpf.unique'         => 'Já existe um usuário com este cpf',
                'birthdate.required' => 'O campo Data de nascimento deve ser preenchidoo',
                ]);



        return redirect()->back()->with('success', 'Atendente adicionado');

    }

    public function destroy($id){
        $seller = Clerk::find($id);
        Clerk::destroy($seller->id);
        User::destroy($seller->user->id);

        return redirect()->back()->with('success', 'Atendente removido com sucesso');
    }
}

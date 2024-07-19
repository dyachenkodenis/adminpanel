<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
      public function index()
    {
        $user = User::latest()->paginate(10);
        return view('admin.user.index', compact('user'))->with('i', (request()->input('page', 1) - 1) * 10);

    }
 
 
    public function create()
    {        
         return view('admin.user.create');  
    }


    public function store(Request $request, User $user)
    {
        $request->validate([        
            'name' => '',
          'role' => '',
          'email' => '',   
          'password' => '',           
        ]);
        
        $pass = Hash::make($request->password);

        User::create([                                              
                        'name' => $request->name,
                        'role' => $request->role,
                        'email' => $request->email,      
                        'password' => $pass,                          
                    ]);

        return redirect()->route('admin.user.index')
            ->with('success', 'Пользователь успешно создан.');
    }

    public function show(User $user)
    {
       return view('admin.user.show', compact('user'));

    }
    

    public function edit(User $user)
    {
           
       return view('admin.user.edit', compact('user'));
    }


    public function update(Request $request, User $user)
    {
        if(!empty($request->password)){
        $pass = Hash::make($request->password);
        $user->update([     
            'name' => $request->name,        
            'role' => $request->role,
            'email' => $request->email,           
            'password' => $pass,                       
         ]);
        }else{
            $user->update([     
                'name' => $request->name,        
                'role' => $request->role,
                'email' => $request->email  
             ]);
        }
        
         
        }


    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.user.index')
            ->with('success', 'Статья успешно удалена.');
    }
    public function ajax(Request $request)
    {         
        $user = User::all();
        return View::make('admin.user.index_ajax')->with(compact('user'));
    }
}

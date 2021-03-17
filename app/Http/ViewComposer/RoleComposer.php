<?php
namespace App\Http\ViewComposer;
use Illuminate\View\View;
use App\Role;
class RoleComposer{
    protected $roles;
    public function __construct(Role $roles)
    {
        $this->roles=$roles;
    }

    public function compose(View $view){
        return $view->with('roles',$this->roles::all());
    }

}
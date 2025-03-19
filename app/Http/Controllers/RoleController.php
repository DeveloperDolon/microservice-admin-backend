<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends BaseController
{
    public function create(RoleRequest $request)
    {
        $roleInfo = $request->validated();

        $data = Role::create($roleInfo);
        
        return $this->sendSuccessResponse($data);
    }

    public function update($id, RoleRequest $request) 
    {
        $role = Role::find($id);

        $role->update($request->validated());

        return $this->sendSuccessResponse($role, 'Role update successful!');
    }

    public function delete($id) 
    {
        $deleted = Role::destroy($id);

        if($deleted) {
            return $this->sendSuccessResponse($deleted, 'Role deleted successful!');
        }

        throw new \Exception('Data could not found!');
    }

    public function list(Request $request)
    {
        $query = Role::query();

        $request->whenFilled('search', function ($input) use ($query) {
            $query->where('name', 'like', '%' . $input . '%' );
        });

        $roles = $query->paginate(10);

        return $this->sendSuccessResponse($roles, 'Role list retrieved successful!');
    }
}

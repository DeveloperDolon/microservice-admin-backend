<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends BaseController
{
    public function storeRole(RoleRequest $request)
    {
        $roleInfo = $request->validated();

        $data = Role::create($roleInfo);

        return $this->sendSuccessResponse($data);
    }
}

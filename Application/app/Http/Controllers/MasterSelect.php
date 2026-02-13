<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MsRole;
use App\Models\MsMenu;

class MasterSelect extends Controller
{
    public function getRoles(Request $request)
    {
        return MsRole::getRoleList();
    }

    public function getSubmenus(Request $request)
    {
        return MsMenu::getSubMenus();
    }
}

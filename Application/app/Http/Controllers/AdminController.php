<?php

namespace App\Http\Controllers;

use App\Models\MsContact;
use App\Models\MsUser;
use App\Models\MsFile;
use App\Models\MsMenu;
use App\Models\Msrole;
use App\Models\MsUserGroup;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException as Exception;

class AdminController extends Controller
{
    public function index()
    {
        $allmenus = MsMenu::getMainMenus(session('roleid'));
        $menus = $allmenus->groupBy('parentid');
        $user = MsUser::getprofile(session('userid'));
        $usernm = $user && $user->usernm ? ucfirst(strtolower(explode(' ', trim($user->usernm))[0])) : 'Guest';
        $title = "Dashboard";
        $content = view('admin.dashboard');
        return view('admin.index', compact('title', 'user', 'menus', 'usernm', 'content'));
    }

    public function taxinvoicedetail()
    {
        $allmenus = MsMenu::getMainMenus(session('roleid'));
        $menus = $allmenus->groupBy('parentid');
        $user = MsUser::getprofile(session('userid'));
        // $storenm = $user->storenm ?? 'Store';
        $usernm = $user && $user->usernm ? ucfirst(strtolower(explode(' ', trim($user->usernm))[0])) : 'Guest';
        $title = "Tax Invoice";
        $content = view('admin.taxinvoicedetail');
        return view('admin.index', compact('title', 'content', 'menus', 'user', 'usernm'));
    }
    public function profile()
    {
        $allmenus = MsMenu::getMainMenus(session('roleid'));
        $menus = $allmenus->groupBy('parentid');
        $user = MsUser::getprofile(session('userid'));
        $storenm = $user->storenm ?? 'Store';
        $usernm = $user && $user->usernm ? ucfirst(strtolower(explode(' ', trim($user->usernm))[0])) : 'Guest';
        $title = "Profile";
        $content = view('component.profile', compact('user', 'usernm', 'storenm'));
        return view('admin.index', compact('title', 'content', 'menus', 'user', 'storenm', 'usernm'));
    }

    public function profileProcess(Request $request)
    {
        $userid = session('userid');
        $request->validate([
            'usernm' => 'unique:msuser,usernm,' . session('userid') . ',userid',
            'email' => 'email|unique:msuser,email,' . session('userid') . ',userid',
            'pswd' => 'min:6|confirmed',
            'phone' => 'unique:mscontact,phone,' . session('userid') . ',userid',
            'address' => 'unique:mscontact,address,' . session('userid') . ',userid',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        DB::beginTransaction();

        try {

            MsUser::where('userid', $userid)
                ->update([
                    'usernm' => $request->usernm,
                    'email' => $request->email,
                    'updatedate' => now(),
                    'updatedby' => $userid,
                ]);

            MsContact::updateorCreate(
                ['userid' => $userid],
                [
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'updatedate' => now(),
                    'updatedby' => $userid,
                ]
            );

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filenm = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $filenm, 'public');

                MsFile::where('userid', $userid)
                    ->delete();

                MsFile::create([
                    'userid' => $userid,
                    'filenm' => $filenm,
                    'exfilenm' => $file->getClientOriginalName(),
                    'format' => $file->getClientOriginalExtension(),
                    'size' => $file->getSize(),
                    'createddate' => now(),
                    'createdby' => $userid,
                ]);
            }
            DB::commit();
            return response()->json([
                'msg' => 'Profile berhasil diperbarui',
            ]);
        } catch (\Exception $e) {
            DB::roolback();
            return response()->json([
                'msg' => 'Terjadi kesalahan saat memperbarui profile: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function datatable(Request $request, $type)
    {
        $userid = session('userid');

        if ($type === 'user') {

            $users = MsUser::datatable();
            $start = $request->input('start', 0);

            return DataTables::of($users)
                ->addIndexColumn()

                ->addColumn('0', function ($row) use (&$start) {
                    return ++$start;
                })
                ->addColumn('1', function ($row) {
                    return $row->filenm
                        ? '<img src="' . asset('public/uploads/' . $row->exfilenm) . '" class="w-10 h-10 rounded-full">'
                        : '-';
                })
                ->addColumn('2', fn($row) => $row->usernm)
                ->addColumn('3', fn($row) => $row->email)
                ->addColumn('4', fn($row) => $row->storenm)
                ->addColumn('5', fn($row) => $row->rolenm)
                ->addColumn('6', function ($row) {
                    return btn_action($row->userid, 'user');
                })

                ->rawColumns(['1', '6'])
                ->toArray();
        }

        if ($type === 'menu') {

            $menus = MsUserGroup::datatable();
            $start = $request->input('start', 0);
            $roles = Msrole::getRoleList();

            return DataTables::of($menus)
                ->addIndexColumn()

                ->addColumn('0', function ($row) use (&$start) {
                    return ++$start;
                })
                ->addColumn('1', fn($row) => $row->menunm)
                ->addColumn('2', fn($row) => $row->submenunm)
                ->addColumn('3', fn($row) => $row->menulink)
                ->addColumn('4', fn($row) => '<i class="' . $row->menuicon . '"></i>')
                ->addColumn('5', fn($row) => $row->sequence)
                ->addColumn('6', function ($row) use ($roles) {

                    $checkedRoles = $row->roleids ? explode(',', $row->roleids) : [];
                    $html = '<div class="flex gap-2 flex-wrap">';
                    foreach ($roles as $role) {
                        $checked = in_array($role->roleid, $checkedRoles) ? 'checked' : '';
                        $html .= '<label class="inline-flex items-center mr-3">
                            <input type="checkbox" class="changerolemenu w-4 h-4 border border-default-medium rounded-xs bg-neutral-secondary-medium focus:ring-2 focus:ring-brand-soft" name="roleid[]" 
                            value="' . $role->roleid . '" 
                            data-menuid="' . $row->menuid . '" 
                            ' . $checked . '>
                            <span class="ml-2 text-xs">' . $role->rolenm . '</span>
                        </label>';
                    }
                    $html .= '</div>';
                    return $html;
                })
                ->addColumn('7', function ($row) {
                    return btn_action($row->menuid, 'menu');
                })
                ->rawColumns(['4', '6', '7'])
                ->toArray();
        }

        abort(404);
    }

    public function menu()
    {
        $allmenus = MsMenu::getMainMenus(session('roleid'));
        $menus = $allmenus->groupBy('parentid');
        $user = MsUser::getprofile(session('userid'));
        $usernm = $user && $user->usernm ? ucfirst(strtolower(explode(' ', trim($user->usernm))[0])) : 'Guest';
        $title = "Admin Menu";
        $subtitle = "Master Menu";
        $type = "menu";
        $content = view('admin.master.menu', compact('subtitle', 'type'));
        return view('admin.index', compact('title', 'content', 'menus', 'user', 'usernm'));
    }
    public function user()
    {
        $allmenus = MsMenu::getMainMenus(session('roleid'));
        $menus = $allmenus->groupBy('parentid');
        $user = MsUser::getprofile(session('userid'));
        $usernm = $user && $user->usernm ? ucfirst(strtolower(explode(' ', trim($user->usernm))[0])) : 'Guest';
        $title = "Admin User";
        $subtitle = "Master User";
        $type = "user";
        $content = view('admin.master.user', compact('type', 'subtitle'));
        return view('admin.index', compact('title', 'content', 'menus', 'user', 'usernm'));
    }

    public function addForm($type)
    {
        $allmenus = MsMenu::getMainMenus(session('roleid'));
        $menus = $allmenus->groupBy('parentid');
        $user = MsUser::getprofile(session('userid'));
        $usernm = $user && $user->usernm ? ucfirst(strtolower(explode(' ', trim($user->usernm))[0])) : 'Guest';
        $title = "Admin " . ucfirst($type);
        $subtitle = "Tambah " . ucfirst($type);
        $content = view('admin.master.v_form', compact('type', 'subtitle'));
        return view('admin.index', compact('title', 'content', 'menus', 'user', 'usernm'));
    }

    public function addProcess(Request $request, $type)
    {
        $userid = session('userid');

        DB::beginTransaction();

        try {
            if ($type === 'user') {
                $request->validate([
                    'usernm' => 'required|unique:msuser,usernm',
                    'email' => 'required|email|unique:msuser,email',
                    'pswd' => 'required|min:6|confirmed',
                    'roleid' => 'required|exists:msrole,roleid',
                    'storenm' => 'nullable|string|max:100',
                ]);

                $user = MsUser::create([
                    'usernm' => $request->usernm,
                    'email' => $request->email,
                    'pswd' => bcrypt($request->pswd),
                    'roleid' => $request->roleid,
                    'createdate' => now(),
                    'createdby' => $userid,
                    'isactive' => 1,
                ]);

                MsContact::create([
                    'userid' => $user->userid,
                    'storenm' => $request->storenm,
                    'createdate' => now(),
                    'createdby' => $userid,
                    'isactive' => 1,
                ]);
            }

            if ($type === 'menu') {
                $request->validate([
                    'menunm' => 'required|string|max:100',
                    'parentid' => 'nullable|exists:msmenu,menuid',
                    'menulink' => 'required|string|max:200',
                    'menuicon' => 'nullable|string|max:100',
                    'sequence' => 'required|integer',
                ]);

                $menu = MsMenu::create([
                    'menunm' => $request->menunm,
                    'parentid' => $request->parentid,
                    'menulink' => $request->menulink,
                    'menuicon' => $request->menuicon,
                    'sequence' => $request->sequence,
                    'createdate' => now(),
                    'createdby' => $userid,
                    'isactive' => 1,
                ]);

                MsUserGroup::create([
                    'menuid' => $menu->menuid,
                    'roleid' => $request->roleid,
                    'createdate' => now(),
                    'createdby' => $userid,
                    'isactive' => 1,
                ]);
            }
            DB::commit();
            return response()->json([
                'msg' => ucfirst($type) . ' berhasil ditambahkan',
                'redirect' => route('admin_master_' . $type)
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'msg' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'msg' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
    public function editForm($type, $id)
    {
        $allmenus = MsMenu::getMainMenus(session('roleid'));
        $menus = $allmenus->groupBy('parentid');
        $user = MsUser::getprofile(session('userid'));
        $usernm = $user && $user->usernm ? ucfirst(strtolower(explode(' ', trim($user->usernm))[0])) : 'Guest';
        $title = "Admin " . ucfirst($type);
        $subtitle = "Edit " . ucfirst($type);
        if ($type === 'user') {
            $data = MsUser::getprofile($id);
        }
        if ($type === 'menu') {
            $data = MsUserGroup::getUserMenus($id);
        }
        $content = view('admin.master.v_form', compact('type', 'subtitle', 'data'));
        return view('admin.index', compact('title', 'content', 'menus', 'user', 'usernm'));
    }

    public function editProcess(Request $request, $type, $id)
    {
        $userid = session('userid');

        DB::beginTransaction();

        try {
            if ($type === 'user') {
                $request->validate([
                    'usernm' => 'required|unique:msuser,usernm,' . $id . ',userid',
                    'email' => 'required|email|unique:msuser,email,' . $id . ',userid',
                    'pswd' => 'nullable|min:6|confirmed',
                    'roleid' => 'required|exists:msrole,roleid',
                    'storenm' => 'nullable|string|max:100',
                ]);

                $updateData = [
                    'usernm' => $request->usernm,
                    'email' => $request->email,
                    'roleid' => $request->roleid,
                    'updatedate' => now(),
                    'updatedby' => $userid,
                    'isactive' => 1,
                ];

                if ($request->filled('pswd')) {
                    $updateData['password'] = bcrypt($request->pswd);
                }

                MsUser::where('userid', $id)->update($updateData);

                MsContact::where('userid', $id)->update([
                    'storenm' => $request->storenm,
                    'updatedate' => now(),
                    'updatedby' => $userid,
                    'isactive' => 1,
                ]);
            }

            if ($type === 'menu') {
                $request->validate([
                    'menunm' => 'required|string|max:100',
                    'parentid' => 'nullable|exists:msmenu,menuid',
                    'menulink' => 'required|string|max:200',
                    'menuicon' => 'nullable|string|max:100',
                    'sequence' => 'required|integer',
                    'roleid' => 'required|exists:msrole,roleid',
                ]);

                MsMenu::where('menuid', $id)->update([
                    'menunm' => $request->menunm,
                    'parentid' => $request->parentid,
                    'menulink' => $request->menulink,
                    'menuicon' => $request->menuicon,
                    'sequence' => $request->sequence,
                    'updatedate' => now(),
                    'updatedby' => $userid,
                    'isactive' => 1,
                ]);

                MsUserGroup::where('menuid', $id)->update([
                    'roleid' => $request->roleid,
                    'updatedate' => now(),
                    'updatedby' => $userid,
                    'isactive' => 1,
                ]);
            }

            DB::commit();

            return response()->json([
                'msg' => ucfirst($type) . ' berhasil diupdate',
                'redirect' => route('admin_master_' . $type)
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'msg' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'msg' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function changeRole(Request $request)
{
    $request->validate([
        'menuid' => 'required|exists:msmenu,menuid',
        'roleid' => 'required|exists:msrole,roleid',
        'checked' => 'required|boolean',
    ]);
    DB::beginTransaction();
    try {
        $menu = MsMenu::findOrFail($request->menuid);

        if ($menu->parentid !== null){
            $userGroup = MsUserGroup::where('menuid', $request->menuid)->first();

            if (!$userGroup){
                throw new \Exception('Data hak akses submenu tidak ditemukan');
            }

            if(!$request->checked){
                return response()->json([
                    'success' => false,
                    'msg' => 'Minimal pilih 1 role'
                ], 422);
            }

            $userGroup->update([
                'roleid' => $request->roleid,
                'updateddate' => now(),
                'updatedby' => session('userid')
            ]);
        } else {
            if ($request->checked) {

            if(!$request->checked){
                return response()->json([
                    'success'=> false,
                    'msg'=>'Minimal pilih 1 role'
                ]);
            }
                MsUserGroup::updateOrCreate(
                    [
                        'menuid' => $request->menuid,
                        'roleid' => $request->roleid,
                    ],
                    [
                        'updateddate' => now(),
                        'updatedby' => session('userid'),
                        'createddate' => now(),
                        'createdby' => session('userid'),
                        'isactive' => 1
                    ]
                );
            } else {
                MsUserGroup::where('menuid', $request->menuid)
                    ->where('roleid', $request->roleid)
                    ->delete();
            }
        }
        DB::commit();
        return response()->json([
            'success' => true,
            'msg' => 'Hak akses berhasil diperbarui',
        ]);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'success' => false,
            'msg' => 'Terjadi kesalahan: ' . $e->getMessage()
        ], 500);
    }
}
    public function detail($type, $id)
    {
        $allmenus = MsMenu::getMainMenus(session('roleid'));
        $menus = $allmenus->groupBy('parentid');
        $user = MsUser::getprofile(session('userid'));
        $usernm = $user && $user->usernm ? ucfirst(strtolower(explode(' ', trim($user->usernm))[0])) : 'Guest';
        $title = "Admin Detail View";
        $subtitle = "Detail " . ucfirst($type);
        if ($type === 'user') {
            $data = MsUser::getprofile($id);
        }
        if ($type === 'menu') {
            $data = MsUserGroup::getUserMenus($id);
        }
        $content = view('admin.master.v_form', compact('type', 'subtitle', 'data'));
        return view('admin.index', compact('title', 'content', 'menus', 'user', 'usernm'));
    }
    public function delete($type, $id)
    {
        $userid = session('userid');

        if ($type === 'user') {
            MsUser::where('userid', $id)->delete();
        }

        if ($type === 'menu') {
            MsMenu::where('menuid', $id)->delete();
        }

        return response()->json([
            'msg' => ucfirst($type) . ' berhasil dihapus',
        ]);
    }
}

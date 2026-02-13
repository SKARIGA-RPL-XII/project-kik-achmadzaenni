<?php

namespace App\Http\Controllers;

use App\Models\MsContact;
use App\Models\MsUser;
use App\Models\MsFile;
use App\Models\MsMenu;
use App\Models\TrBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\ValidationException as Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class PenjualController extends Controller
{
    public function index()
    {
        $allmenus = MsMenu::getMainMenus(session('roleid'));
        $menus = $allmenus->groupBy('parentid');
        $user = MsUser::getprofile(session('userid'));
        $usernm = $user && $user->usernm ? ucfirst(strtolower(explode(' ', trim($user->usernm))[0])) : 'Guest';
        $title = "Dashboard";
        $content = view('penjual.dashboard');
        return view('penjual.index', compact('title', 'user', 'usernm', 'content', 'menus'));
    }

    public function profile()
    {
        $allmenus = MsMenu::getMainMenus(session('roleid'));
        $menus = $allmenus->groupBy('parentid');
        $user = MsUser::getprofile(session('userid'));
        $usernm = $user && $user->usernm ? ucfirst(strtolower(explode(' ', trim($user->usernm))[0])) : 'Guest';
        $title = "Profile";
        $content = view('component.profile', compact('user', 'usernm'));
        return view('penjual.index', compact('title', 'user', 'usernm', 'content', 'menus'));
    }
   public function profileProcess(Request $request)
{
    $userid = session('userid');
    
    $request->validate([
        'usernm' => ['required', Rule::unique('msuser', 'usernm')->ignore($userid, 'userid')],
        'email' => ['required', 'email', Rule::unique('msuser', 'email')->ignore($userid, 'userid')],
        'pswd' => ['nullable', 'min:6', 'confirmed'],
        'phone' => [Rule::unique('mscontact', 'phone')->ignore($userid, 'userid')],
        'address' => [Rule::unique('mscontact', 'address')->ignore($userid, 'userid')],
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
    ]);

    DB::beginTransaction();

    try {
        MsUser::where('userid', $userid)->update([
            'usernm' => $request->usernm,
            'email' => $request->email,
            'updateddate' => now(),
            'updatedby' => $userid,
            'isactive' => 1
        ]);

        if ($request->filled('pswd')) {
            MsUser::where('userid', $userid)->update([
                'pswd' => Hash::make($request->pswd)
            ]);
        }

        MsContact::updateorCreate(
            ['userid' => $userid],
            [
                'phone' => $request->phone,
                'address' => $request->address,
                'updateddate' => now(),
                'updatedby' => $userid,
                'isactive' => 1
            ]
        );

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $fileSize = $file->getSize();

            $hashedName = hash('sha256', time() . $originalName) . '.' . $extension;

            $filePath = $file->storeAs('uploads', $hashedName, 'public');

            MsFile::where('userid', $userid)->delete();

            MsFile::create([
                'userid' => $userid,
                'filenm' => $originalName,
                'exfilenm' => $hashedName,
                'format' => $extension,
                'size' => $fileSize,
                'createddate' => now(),
                'createdby' => $userid,
                'isactive' => 1
            ]);
        }

        DB::commit();
        $user = MsUser::getprofile(($userid));

        return response()->json([
            'msg' => 'Profile berhasil diperbarui',
            'new_image_url' => isset($hashedName) ? asset('storage/uploads/' . $hashedName) : null
        ]);

    } catch (\Exception $e) {
        DB::rollback();
        return response()->json([
            'msg' => 'Terjadi kesalahan: ' . $e->getMessage(),
        ], 500);
    }
}

    public function transaction()
    {
        $allmenus = MsMenu::getMainMenus(session('roleid'));
        $menus = $allmenus->groupBy('parentid');
        $user = MsUser::getprofile(session('userid'));
        $usernm = $user && $user->usernm ? ucfirst(strtolower(explode(' ', trim($user->usernm))[0])) : 'Guest';
        $title = "Transaction";
        $content = view('penjual.transaction');
        return view('penjual.index', compact('title', 'user', 'menus', 'usernm', 'content'));
    }
    public function produk()
    {
        $allmenus = MsMenu::getMainMenus(session('roleid'));
        $menus = $allmenus->groupBy('parentid');
        $user = MsUser::getprofile(session('userid'));
        $usernm = $user && $user->usernm ? ucfirst(strtolower(explode(' ', trim($user->usernm))[0])) : 'Guest';
        $title = "Produk";
        $subtitle = "Inventory Produk";
        $content = view('penjual.inventory.produk', compact('subtitle'));
        return view('penjual.index', compact('title', 'user', 'menus', 'usernm', 'content'));
    }

    public function datatable(Request $request)
    {
        $userid = session('userid');

        $barangs = TrBarang::datatable($userid);
        $start = $request->input('start', 0);
        return Datatables::of($barangs)
            ->addIndexColumn()
            ->addColumn('0', function ($row) use ($start) {
                return ++$start;
            })
            ->addColumn('1', function ($row) {
                return $row->filenm ? '<img src="' . asset('public/uploads/ ' . $row->exfilenm) . '" class="w-10 h-10 rounded-full">' : '<img src="' . asset('public/uploads/default-avatar.png') . '">';
            })
            ->addColumn('2', fn($row) => $row->brgnm)
            ->addColumn('3', fn($row) => "Rp.$row->price")
            ->addColumn('4', function($row) {
                return '<img src="https://bwipjs-api.metafloor.com/?bcid=code128&text=' . $row->barcode . '&scale=1">';
            })
            ->addColumn('5', fn($row) => Carbon::parse($row->expired)->format('Y:m:d'))
            ->addColumn('6', fn($row) => Carbon::parse($row->createddate)->format('Y:m:d'))
            ->addColumn('7', fn($row) => $row->qty)
            ->addColumn('8', function ($row) {
                return btn_action($row->brgid, 'produk');
            })
            ->rawColumns(['1', '4', '8'])
            ->toArray();
    }

    public function addForm()
    {
        $allmenus = MsMenu::getMainMenus(session('roleid'));
        $menus = $allmenus->groupBy('parentid');
        $user = MsUser::getprofile(session('userid'));
        $usernm = $user && $user->usernm ? ucfirst(strtolower(explode(' ', trim($user->usernm))[0])) : 'Guest';
        $title = "Produk";
        $subtitle = "Tambah Produk";
        $content = view('penjual.inventory.v_form', compact('subtitle'));
        return view('penjual.index', compact('title', 'content', 'menus', 'user', 'usernm'));
    }

    public function addProcess(Request $request)
    {
        $userid = session('userid');

        DB::beginTransaction();

        try {

            $request->validate([
                'brgnm' => 'required|unique:trbarang,brgnm',
                'barcode' => 'unique:trbarang,barcode',
                'expired' => 'required',
                'price' => 'required',
                'qty' => 'required',
            ]);

            $photo = MsFile::create([
                'filenm' => $request->filenm,
                'exfilenm' => $request->exfilenm,
                'createddate' => now(),
                'createdby' => $userid,
                'isactive' => 1
            ]);

            TrBarang::create([
                'fileid' => $photo->fileid,
                'brgnm' => $request->brgnm,
                'barcode' => $request->barcode,
                'price' => $request->price,
                'qty' => $request->qty,
                'expired' => $request->expired,
                'createddate' => now(),
                'createdby' => $userid,
                'isactive' => 1
            ]);

            DB::commit();
            return response()->json([
                'msg' => 'Produk berhasil ditambahkan',
                'redirect' => route('penjual_produk')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'msg' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function editForm($id)
    {
        $allmenus = MsMenu::getMainMenus(session('roleid'));
        $menus = $allmenus->groupBy('parentid');
        $user = MsUser::getprofile(session('userid'));
        $usernm = $user && $user->usernm ? ucfirst(strtolower(explode(' ', trim($user->usernm))[0])) : 'Guest';
        $title = "Produk";
        $subtitle = "Edit Produk";
        $data = TrBarang::getBarang($id);
        $content = view('penjual.inventory.v_form', compact('subtitle', 'data'));
        return view('penjual.index', compact('title', 'content', 'menus', 'user', 'usernm'));
    }

    public function editProcess(Request $request, $id)
    {
        $userid = session('userid');

        DB::beginTransaction();

        try {
            $request->validate([
                'brgnm' => 'required|unique:trbarang,brgnm',
                'barcode' => 'unique:trbarang,barcode',
                'expired' => 'required',
                'price' => 'required',
                'qty' => 'required',
            ]);

            $photo = [
                'filenm' => $request->filenm,
                'exfilenm' => $request->exfilenm,
                'createddate' => now(),
                'createdby' => $userid,
                'isactive' => 1
            ];
            $updateData = [
                'brgnm' => $request->brgnm,
                'barcode' => $request->barcode,
                'price' => $request->price,
                'qty' => $request->qty,
                'expired' => $request->expired,
                'isactive' => 1
            ];

            MsFile::where('brgid', $id)->update($photo);
            TrBarang::where('brgid', $id)->update($updateData);

            DB::commit();
            return response()->json([
                'msg' => 'Produk berhasil diupdate',
                'redirect' => route('penjual_produk')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'msg' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}

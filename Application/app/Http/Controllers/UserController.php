<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use App\Models\MsContact;
use App\Models\MsUser;
use App\Models\MsFile;
use App\Models\MsMenu;
use App\Models\TrBarang;
use App\Models\TrBalance;
use App\Models\TrCart;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $userid = session('userid');
        $allmenus = MsMenu::getMainMenus(session('roleid'));
        $menus = $allmenus->groupBy('parentid');
        $Balance = TrBalance::totalSaldo($userid);
        $totalSaldo = (object)[
            'balance' => $Balance
        ];
        $data = TrBalance::getDataBalance($userid);
        $user = MsUser::getprofile(session('userid'));
        $usernm = $user && $user->usernm ? ucfirst(strtolower(explode(' ', trim($user->usernm))[0])) : 'Guest';
        $title = "Dashboard";
        $content = view('user.dashboard', compact('data', 'totalSaldo'));
        return view('user.index', compact('title', 'user', 'usernm', 'content', 'menus'));
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
        return view('user.index', compact('title', 'user', 'usernm', 'storenm', 'content', 'menus'));
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

    public function shop()
    {
        $allmenus = MsMenu::getMainMenus(session('roleid'));
        $menus = $allmenus->groupBy('parentid');
        $datas = TrBarang::getBarangUser();
        $data = TrCart::totalcard(session('userid'));
        $user = MsUser::getprofile(session('userid'));
        $usernm = $user && $user->usernm ? ucfirst(strtolower(explode(' ', trim($user->usernm))[0])) : 'Guest';
        $title = "Shop";
        $content = view('user.shop', compact('datas', 'data'));
        return view('user.index', compact('title', 'content', 'menus', 'user', 'usernm'));
    }

    public function keranjang(Request $request)
    {
        $userid = session('userid');
        $allmenus = MsMenu::getMainMenus(session('roleid'));
        $menus = $allmenus->groupBy('parentid');
        $user = MsUser::getprofile($userid);
        $usernm = $user && $user->usernm ? ucfirst(strtolower(explode(' ', trim($user->usernm))[0])) : 'Guest';
        $title = "Shop Cart";
        $items = TrCart::getCartDetail($userid);
        $total = 0;
        foreach ($items as $item) {
            $total += ($item->price * $item->qty);
        }
        $pajak = $total * 0.10;
        $Tagihan = $total + $pajak;
        $content = view('user.keranjang', compact('items', 'total', 'pajak', 'Tagihan'));
        return view('user.index', compact('title', 'content', 'menus', 'user', 'usernm'));
    }
    public function addToCart(Request $request)
    {
        $userid = session('userid');
        $brgid = $request->brgid;
        $cartItem = TrCart::item($userid, $brgid);
        if ($cartItem) {
            $cartItem->qty += 1;
            $cartItem->updateddate = Carbon::now();
            $cartItem->save();
        } else {
            TrCart::create([
                'userid' => $userid,
                'brgid' => $brgid,
                'qty' => 1,
                'createddate' => Carbon::now(),
                'createdby' => $userid,
                'isactive' => 1
            ]);
        }
        $totalCart = TrCart::totalcard($userid);
        return response()->json([
            'status' => 'success',
            'message' => 'Barang berhasil ditambahkan',
            'total_cart' => $totalCart
        ]);
    }

    public function updateToCart(Request $request)
    {
        try {
            $userid = session('userid');
            $cartid = $request->cartid;
            $action = $request->action;

            $cartItem = TrCart::cartitem($userid, $cartid);

            if (!$cartItem) {
                return response()->json([
                    'status' => false, 
                    'msg' => 'Item tidak ditemukan'
                ], 404);
            }

            if ($action == 'plus') {
                $barang = TrBarang::where('brgid', $cartItem->brgid)->first();
                if ($barang && $cartItem->qty >= $barang->qty) {
                    return response()->json([
                        'status' => false, 
                        'msg' => 'Stok tidak mencukupi'
                    ], 400);
                }
                
                $cartItem->qty += 1;
            } else {
                if ($cartItem->qty > 1) {
                    $cartItem->qty -= 1;
                } else {
                    return response()->json([
                        'status' => false, 
                        'msg' => 'Minimal pembelian 1 item'
                    ], 400);
                }
            }
            
            $cartItem->updateddate = now();
            $cartItem->updatedby = $userid;
            $cartItem->save();
            $currentBarang = TrBarang::where('brgid', $cartItem->brgid)->first();
            $pricePerItem = $currentBarang->price;
            $itemTotal = $pricePerItem * $cartItem->qty;

            $subtotal = TrCart::join('trbarang', 'trcart.brgid', '=', 'trbarang.brgid')
                ->where('trcart.userid', $userid)
                ->where('trcart.isactive', 1)
                ->sum(DB::raw('trcart.qty * trbarang.price'));
            
            $pajak = $subtotal * 0.10;
            $grandTotal = $subtotal + $pajak;

            return response()->json([
                'status' => true,
                'qty' => $cartItem->qty,
                'item_total' => number_format($itemTotal, 0, ',', '.'),
                'subtotal' => number_format($subtotal, 0, ',', '.'),
                'pajak' => number_format($pajak, 0, ',', '.'),
                'grand_total' => number_format($grandTotal, 0, ',', '.')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false, 
                'msg' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
    public function history(Request $request)
    {
        $allmenus = MsMenu::getMainMenus(session('roleid'));
        $menus = $allmenus->groupBy('parentid');
        // $datas = TrBarang::getBarangUser();
        $user = MsUser::getprofile(session('userid'));
        $usernm = $user && $user->usernm ? ucfirst(strtolower(explode(' ', trim($user->usernm))[0])) : 'Guest';
        $title = "History";
        $content = view('user.history');
        return view('user.index', compact('title', 'content', 'menus', 'user', 'usernm'));
    }
    public function topup(Request $request)
    {
        $userid = session('userid');
        $orderId = 'TPP-' . Str::uuid();
        $balance = TrBalance::create([
            'userid' => $userid,
            'income' => $request->amount,
            'balance' => 0,
            'expense' => 0,
            'status' => 0,
            'paytype' => null,
            'createddate' => now(),
            'createdby' => $userid,
            'isactive' => 1,
        ]);

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $request->amount,
            ],
            'customer_details' => [
                'first_name' => $request->usernm,
                'email' => $request->email,
            ]
        ];

        $snapToken = Snap::getSnapToken($params);

        return response()->json([
            'snap_token' => $snapToken,
            'blcid' => $balance->blcid,
            'order_id' => $orderId
        ]);
    }

    public function topupComplete(Request $request)
    {
        $userid = session('userid');
        $balance = TrBalance::where('blcid', $request->blcid)->first();

        if (!$balance) {
            return response()->json(['msg' => 'Topup record not found'], 404);
        }

        $balance->status = 1;
        $balance->paytype = $request->payment_type ?? $balance->paytype;
        $balance->updateddate = now();
        $balance->updatedby = $userid;
        $balance->save();
        $balancenew = TrBalance::totalSaldo($userid);

        return response()->json(['msg' => 'Topup berhasil diproses', 'BalanceNew' => $balancenew]);
    }

    public function withdraw(Request $request)
    {
        $userid = session('userid');

        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $currentSaldo = TrBalance::calculateSaldo($userid);
        $amount = floatval($request->amount);

        if ($amount > $currentSaldo) {
            return response()->json(['msg' => 'Saldo tidak cukup'], 422);
        }

        TrBalance::create([
            'userid' => $userid,
            'income' => 0,
            'expense' => $amount,
            'balance' => 0,
            'status' => 1,
            'paytype' => 'withdraw',
            'createddate' => now(),
            'createdby' => $userid,
            'isactive' => 1,
        ]);

        $newBalance = TrBalance::calculateSaldo($userid);

        return response()->json([
            'msg' => 'Penarikan berhasil',
            'new_balance' => $newBalance
        ]);
    }
}

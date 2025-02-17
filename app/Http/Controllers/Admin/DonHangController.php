<?php

namespace App\Http\Controllers\Admin;

use App\Models\DonHang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DonHangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listDonHang = DonHang::query()->orderByDesc('id')->get();

        $trangThaiDonHang = DonHang::TRANG_THAI_DON_HANG;

        $type_huy_don_hang = DonHang::HUY_DON_HANG;
        return view('admins.donhangs.index', compact('listDonHang','trangThaiDonHang','type_huy_don_hang'));
    }

    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $donHang = DonHang::query()->findOrFail($id);

        $trangThaiDonHang = DonHang::TRANG_THAI_DON_HANG;

        $trangThaiThanhToan = DonHang::TRANG_THAI_THANH_TOAN;

        return view('admins.donhangs.show', compact('donHang','trangThaiDonHang','trangThaiThanhToan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $donHang = DonHang::query()->findOrFail($id);

        $currentTrangThai = $donHang->trang_thai_don_hang;

        $newTrangThai = $request->input('trang_thai_don_hang');

        $trangThais = array_keys(DonHang::TRANG_THAI_DON_HANG);

        if($currentTrangThai === DonHang::HUY_DON_HANG){
            return redirect()->route('quanlydonhangs.index')->with('error','Đơn hàng đã bị hủy không thể thay đổi trạng thái');
        }
        if(array_search($newTrangThai,$trangThais) < array_search($currentTrangThai,$trangThais)){
            return redirect()->route('quanlydonhangs.index')->with('error','Không thể cập nhật ngược lại trạng thái');
        }
        $donHang->trang_thai_don_hang = $newTrangThai;

        $donHang->save();

        return redirect()->route('quanlydonhangs.index')->with('success','Cập nhật trạng thái thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $donHang = DonHang::query()->findOrFail($id);

        if($donHang && $donHang->trang_thai_don_hang == DonHang::HUY_DON_HANG){
            $donHang->chiTietDonHang()->delete();

            $donHang->delete();

            return redirect()->back()->with('success','Xóa đơn hàng thành công');
        }
        return redirect()->back()->with('error','Không thể xóa đơn hàng');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class VoucherController extends Controller
{
    public function index() {
        $vouchers = Voucher::orderBy('created_at')->get();
        return view('admin.voucher.list')->with(compact('vouchers'));
    }

    public function getForm() {
        return view('admin.voucher.form');
    }

    public function saveForm(Request $request) {
        $rules = [
            'voucher_name' => 'required',
            'voucher_code' => 'required',
            'voucher_discount' => 'required',
        ];

        $messages = [
            'voucher_name.required' => 'Tên không được để trống',
            'voucher_code.required' => 'Code không được để trống',
            'voucher_discount.required' => 'Discount không được để trống',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            // tra ve true neu validate bi loi
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        } else {
            $data = $request->all();
            $user = Auth::user();
            $data['create_by'] = $user['id'];
            $data['update_by'] = $user['id'];
            $data['update_at'] = Carbon::now();
            DB::beginTransaction();
            try {
                Voucher::create($data);
                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
                Log::error('Lỗi ' . $exception->getMessage());
            }
            return redirect()->route('admin.voucher.list');
        }
    }

    public function editForm($id) {
        $voucher = Voucher::FindOrFail($id);
        return view('admin.voucher.edit', ['voucher' => $voucher]);
    }

    public function updateForm(Request $request, $id) {
        $rules = [
            'voucher_name' => 'required',
            'voucher_code' => 'required',
            'voucher_discount' => 'required',
        ];

        $messages = [
            'voucher_name.required' => 'Tên không được để trống',
            'voucher_code.required' => 'Code không được để trống',
            'voucher_discount.required' => 'Discount không được để trống',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            // tra ve true neu validate bi loi
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        } else {
            $voucher = Voucher::FindOrFail($id);
            $updateRequest = $request->all();
            $user = Auth::user();
            $updateRequest['create_by'] = $user['id'];
            $updateRequest['update_by'] = $user['id'];
            $updateRequest['update_at'] = Carbon::now();
            $voucher->update($updateRequest);
            return redirect()->route('admin.voucher.list');
        }
    }

    public function delete($id) {
        Voucher::FindOrFail($id)->delete();
        return redirect()->back();
    }
}

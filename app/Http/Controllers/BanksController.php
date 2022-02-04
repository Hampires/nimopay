<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Banks;
use App\BankDetails;

class BanksController extends Controller
{
    public function detail_edit(Request $request)
    {
        if(!auth()->user()->hasRole('owner')){
            abort(403, 'Unauthorized action.');
        }

        if (auth()->user()->hasBankAccount()) {
            // user bank account already exist
            if (auth()->user()->hasKYC()) {
                // user has kyc
                $validationParams = array();
                foreach ($request->all() as $key => $value) {
                    if ($key == 'bank') {
                        $bank_id = Banks::where('alias', $value)->get('id')->first()->id;
                        $validationParams['bank'] = $bank_id;
                    } else {
                        $validationParams[$key] = $value;
                    }
                }

                $validationRules = array(
                    'bvn' => ['required', 'unique:bank_details,bvn', 'digits:10'],
                    'account_number' => ['required', 'unique:bank_details,account_number', 'digits:10'],
                    'account_name' => ['required', 'unique:bank_details,account_name', 'max:255'],
                    'bank' => ['required', 'exists:banks,id'],
                );

                $validator = validator()->make($validationParams, $validationRules);
                
                if ($validator->fails()) {
                    throw new ValidationException($validator);
                }

                $bank = auth()->user()->bank_detail;
                $bank->bvn = $validationParams['bvn'];
                $bank->account_number = $validationParams['account_number'];
                $bank->account_name = $validationParams['account_name'];
                $bank->bank_id = $validationParams['bank'];
                $bank->update();

                return redirect()->back()->withStatus(__('Bank connect updated.'));
            } else {
                return redirect()->back()->with(['warning' => 'Kindly verify your kyc to update bank connect.']);
            }
        }
        if (!auth()->user()->hasBankAccount()) {
            // user has no bank account
            $validationParams = array();
            foreach ($request->all() as $key => $value) {
                if ($key == 'bank') {
                    $bank_id = Banks::where('alias', $value)->get('id')->first()->id;
                    $validationParams['bank'] = $bank_id;
                } else {
                    $validationParams[$key] = $value;
                }
            }

            $validationRules = array(
                'bvn' => ['required', 'unique:bank_details,bvn', 'digits:10'],
                'account_number' => ['required', 'unique:bank_details,account_number', 'digits:10'],
                'account_name' => ['required', 'unique:bank_details,account_name', 'max:255'],
                'bank' => ['required', 'exists:banks,id'],
            );

            $validator = validator()->make($validationParams, $validationRules);
            
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $bank = new BankDetails;
            $bank->account_number = $validationParams['account_number'];
            $bank->account_name = $validationParams['account_name'];
            $bank->bvn = $validationParams['bvn'];
            $bank->bank_id = $validationParams['bank'];
            $bank->save();

            return redirect()->back()->withStatus(__('Bank connect created.'));
        }
    }
}

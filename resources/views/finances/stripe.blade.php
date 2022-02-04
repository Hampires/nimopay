<!-- Fee Info -->
<div class="col-6">
    <div class="card  bg-secondary shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col-8">
                    <h3 class="mb-0">{{ __('Bank connect') }}</h3>
                </div>
                <div class="col-4 text-right">
                </div>
            </div>
        </div>
        <div class="card-body">
            <div>
                <form  id="bankform" method="post" action="{{ route('bank.connect') }}" autocomplete="off">
                    <div>
                        @csrf
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @elseif (session('warning'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                {{ session('warning') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div>
                            <div class="form-group{{ $errors->has('bvn') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="bvn">{{ __('BVN') }}</label>
                                <input type="text" name="bvn" id="bvn" class="form-control form-control-alternative{{ $errors->has('bvn') ? ' is-invalid' : '' }}" placeholder="{{ __('Bank Verification Number') }}" value="{{ old('bvn', auth()->user()->bank_detail->bvn) }}" required autofocus>
                                @if ($errors->has('bvn'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bvn') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('account_number') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="account_number">{{ __('Account Number') }}</label>
                                <input type="text" name="account_number" id="account_number" class="form-control form-control-alternative{{ $errors->has('account_number') ? ' is-invalid' : '' }}" placeholder="{{ __('0123456789') }}" value="{{ old('account_number', auth()->user()->bank_detail->account_number) }}" required autofocus>
                                @if ($errors->has('account_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('account_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('account_name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="account_name">{{ __('Bank Account Name') }}</label>
                                <input type="text" name="account_name" id="account_name" class="form-control form-control-alternative{{ $errors->has('account_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Account Name') }}" value="{{ old('account_name', auth()->user()->bank_detail->account_name) }}" required autofocus>
                                @if ($errors->has('account_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('account_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            @if ($errors->has('bank'))
                                <h1><strong>{{ $errors->first('bank') }}</strong></h1>
                            @endif
                            <div class="form-group{{ $errors->has('bank') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="bank">{{ __('Bank') }}</label>
                                <br />
                                <select class="form-control form-control-alternative   @isset($classselect) {{$classselect}} @endisset"  name="bank" id="bank">
                                    <option disabled selected value> {{ __('Select bank')}} </option>
                                    @for ($i = 0; $i < count($banks); $i++)
                                        @if (old('bank', auth()->user()->bank_detail->bank_id) == $banks[$i]->id)
                                            <option  selected value="{{ $banks[$i]->alias }}">{{ __($banks[$i]->name) }}</option>
                                        @elseif(old('bank') == $banks[$i]->alias)
                                            <option  selected value="{{ $banks[$i]->alias }}">{{ __($banks[$i]->name) }}</option>
                                        @else
                                            <option value="{{ $banks[$i]->alias }}">{{ __($banks[$i]->name) }}</option>
                                        @endif
                                    @endfor
                                </select>
                            </div>
                        </div>      
                    </div>
                    <hr />
                    @if (!auth()->user()->hasBankAccount())
                        <button type="submit" class="btn btn-primary">{{ __('Connect with Bank Connect') }}</button>
                    @elseif (auth()->user()->hasBankAccount() && !auth()->user()->hasKYC())
                        <button type="submit" class="btn btn-warning">{{ __('Update Bank connection') }}</button>
                    @elseif (auth()->user()->hasBankAccount() && auth()->user()->hasKYC())
                        <button type="button" class="btn btn-warning" disabled>{{ __('Update Bank connection') }}</button>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
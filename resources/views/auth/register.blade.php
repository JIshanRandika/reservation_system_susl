@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('NIC') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="text" class="form-control @error('NIC') is-invalid @enderror" name="NIC" required autocomplete="NIC">

                                @error('NIC')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                     <div class="form-group row">
                            <label for="PassportNo" class="col-md-4 col-form-label text-md-right">{{ __('Passport Number') }}</label>

                            <div class="col-md-6">
                                <input id="PassportNo" type="text" class="form-control" name="PassportNo" required autocomplete="PassportNo">
                                @error('PassportNo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ContactNo" class="col-md-4 col-form-label text-md-right">{{ __('Contact Number') }}</label>

                            <div class="col-md-6">
                                <input id="ContactNo" type="text" class="form-control" name="ContactNo" required autocomplete="ContactNo">
                                @error('ContactNo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="Address" type="text" class="form-control" name="Address" required autocomplete="Address">
                                @error('Address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="University" class="col-md-4 col-form-label text-md-right">{{ __('University') }}</label>

                            <div class="col-md-6">
                                <input id="University" type="University" class="form-control" name="University" required autocomplete="University">
                                @error('University')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="FacultyOrCenter" class="col-md-4 col-form-label text-md-right">{{ __('Faculty') }}</label>

                            <div class="col-md-6">
                                <select id="FacultyOrCenter" type="text" class="form-control" name="FacultyOrCenter" required autocomplete="FacultyOrCenter">
                                    <option value="Faculty Of Applied Sciences">{{ __('The Faculty Of Applied Sciences') }}</option>
                                    <option value="Faculty of Agricultural Sciences">{{ __('Faculty of Agricultural Sciences') }}</option>
                                    <option value="Faculty of Geomatics">{{ __('Faculty of Geomatics') }}</option>
                                    <option value="Faculty of Graduate Studies">{{ __('Faculty of Graduate Studies') }}</option>
                                    <option value="Faculty of Management Studies">{{ __('Faculty of Management Studies') }}</option>
                                    <option value="The Faculty Of Medicine">{{ __('The Faculty Of Medicine') }}</option>
                                    <option value="Faculty of Social Sciences and Languages">{{ __('Faculty of Social Sciences and Languages') }}</option>
                                    <option value="Faculty of Technology">{{ __('Faculty of Technology') }}</option>
                                    <option value="Other">{{ __('Other') }}</option>
                                </select>
                                @error('FacultyOrCenter')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Department" class="col-md-4 col-form-label text-md-right">{{ __('Department') }}</label>

                            <div class="col-md-6">
                                {{-- <input id="Department" type="text" class="form-control" name="Department" required autocomplete="Department"> --}}

                                <select id="Department" type="text" class="form-control" name="Department" required autocomplete="Department">
                                    <option value="Department of Agribusiness Management">{{ __('Department of Agribusiness Management') }}</option>
                                    <option value="Department of Export Agriculture">{{ __('Department of Export Agriculture') }}</option>
                                    <option value="Department of Livestock Production">{{ __('Department of Livestock Production') }}</option>
                                    <option value="Department of Computing and Information Systems">{{ __('Department of Computing and Information Systems') }}</option>
                                    <option value="Department of Food Science and Technology">{{ __('Department of Food Science and Technology') }}</option>
                                    <option value="Department of Natural Resources">{{ __('Department of Natural Resources') }}</option>
                                    <option value="Department of Physical Sciences and Technology">{{ __('Department of Physical Sciences and Technology') }}</option>
                                    <option value="Department of Sport Sciences and Physical Education">{{ __('Department of Sport Sciences and Physical Education') }}</option>
                                    <option value="Department of Remote Sensing and GIS">{{ __('Department of Remote Sensing and GIS') }}</option>
                                    <option value="Department of Surveying and Geodesy">{{ __('Department of Surveying and Geodesy') }}</option>
                                    <option value="Department of Accountancy & Finance">{{ __('Department of Accountancy & Finance') }}</option>
                                    <option value="Department of Business Management">{{ __('Department of Business Management') }}</option>
                                    <option value="Department of Marketing Management">{{ __('Department of Marketing Management') }}</option>
                                    <option value="Department of Tourism Management">{{ __('Department of Tourism Management') }}</option>
                                    <option value="Department of Anatomy">{{ __('Department of Anatomy') }}</option>
                                    <option value="Department of Biochemistry">{{ __('Department of Biochemistry') }}</option>
                                    <option value="Department of Microbiology">{{ __('Department of Microbiology') }}</option>
                                    <option value="Department of Community Medicine">{{ __('Department of Community Medicine') }}</option>
                                    <option value="Department of Forensic Medicine & Toxicology">{{ __('Department of Forensic Medicine & Toxicology') }}</option>
                                    <option value="Department of Medicine">{{ __('Department of Medicine') }}</option>
                                    <option value="Department of Obstetrics & Gynaecology">{{ __('Department of Obstetrics & Gynaecology') }}</option>
                                    <option value="Department of Graduate Studies">{{ __('Department of Graduate Studies') }}</option>
                                    <option value="Department of Economics & Statistics">{{ __('Department of Economics & Statistics') }}</option>
                                    <option value="Department of English Language Teaching">{{ __('Department of English Language Teaching') }}</option>
                                    <option value="Department of Geography & Environmental Management">{{ __('Department of Geography & Environmental Management') }}</option>
                                    <option value="Department of Languages">{{ __('Department of Languages') }}</option>
                                    <option value="Department of Social Sciences">{{ __('Department of Social Sciences') }}</option>
                                    <option value="Department of Biosystems Technology">{{ __('Department of Biosystems Technology') }}</option>
                                    <option value="Department of Engineering Technology">{{ __('Department of Engineering Technology') }}</option>
                                    <option value="Other">{{ __('Other') }}</option>
                                </select>
                                @error('Department')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Designation" class="col-md-4 col-form-label text-md-right">{{ __('Designation') }}</label>

                            <div class="col-md-6">
                                {{-- <input id="Designation" type="text" class="form-control" name="Designation" required autocomplete="Designation"> --}}
                                <select id="Designation" type="text" class="form-control" name="Designation" required autocomplete="Designation">
                                    <option value="SUSL Lecturer">{{ __('SUSL Lecturer') }}</option>                                    
                                    <option value="Visiting Lecturer">{{ __('Visiting Lecturer') }}</option>
                                    <option value="Vice Chancellor">{{ __('Vice Chancellor') }}</option>
                                    <option value="Dean">{{ __('Dean') }}</option>
                                    <option value="Head of The Department">{{ __('Head of The Department') }}</option>
                                    <option value="Other">{{ __('Coordinator') }}</option>  
                                    <option value="Other">{{ __('Other') }}</option>               
                                </select>
                               
                                @error('Department')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="UPFNo" class="col-md-4 col-form-label text-md-right">{{ __('UPFNo') }}</label>

                            <div class="col-md-6">
                                <input id="UPFNo" type="text" class="form-control" name="UPFNo" required autocomplete="UPFNo">
                                @error('UPFNo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

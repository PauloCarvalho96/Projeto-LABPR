@extends('layouts.app_client_homepage')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Profile</div>
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="accordion" id="accordionExample">
                            <div class="card">
                              <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                  <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    Change Informations
                                  </button>
                                </h2>
                              </div>

                              <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">

                                    <form class="form-horizontal" method="POST" action="{{ route('changeDataUser') }}">
                                        @csrf

                                    <div class="form-group">
                                        <label for="name" class="col-md-4 control-label">Name</label>
                                        <div class="col-md-6">
                                            <input id="new_name" type="text" class="form-control" name="new_name" value="{{Auth::user()->name}}" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="last_name" class="col-md-4 control-label">Last Name</label>
                                        <div class="col-md-6">
                                            <input id="new_last_name" type="text" class="form-control" name="new_last_name" value="{{Auth::user()->last_name}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="address" class="col-md-4 control-label">Adress</label>
                                        <div class="col-md-6">
                                            <input id="new_address" type="text" class="form-control" name="new_address" value="{{Auth::user()->address}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="post_number" class="col-md-4 control-label">Post Number</label>
                                        <div class="col-md-6">
                                            <input id="new_post_number" type="text" class="form-control" name="new_post_number" value="{{Auth::user()->post_number}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="phone_number" class="col-md-4 control-label">Phone Number</label>
                                        <div class="col-md-6">
                                            <input id="new_phone_number" type="text" class="form-control" name="new_phone_number" value="{{Auth::user()->phone_number}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="city" class="col-md-4 control-label">City</label>
                                        <div class="col-md-6">
                                            <input id="new_city" type="text" class="form-control" name="new_city" value="{{Auth::user()->city}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="country" class="col-md-4 control-label">Country</label>
                                        <div class="col-md-6">
                                            <input id="new_country" type="text" class="form-control" name="new_country" value="{{Auth::user()->country}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="col-md-4 control-label">Confirm Password</label>
                                        <div class="col-md-6">
                                            <input id="password_check" type="password" class="form-control" name="password_check" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                Change Data
                                            </button>
                                        </div>
                                    </div>

                                    </form>
                                </div>
                              </div>
                            </div>
                            <div class="card">
                              <div class="card-header" id="headingTwo">
                                <h2 class="mb-0">
                                  <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Change Password
                                  </button>
                                </h2>
                              </div>
                              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                    <form class="form-horizontal" method="POST" action="{{ route('changePassword') }}">
                                        @csrf
                                        <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                                            <label for="new-password" class="col-md-4 control-label">Current Password</label>

                                            <div class="col-md-6">
                                                <input id="current-password" type="password" class="form-control" name="current-password" required>

                                                @if ($errors->has('current-password'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('current-password') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                                            <label for="new-password" class="col-md-4 control-label">New Password</label>

                                            <div class="col-md-6">
                                                <input id="new-password" type="password" class="form-control" name="new-password" required>

                                                @if ($errors->has('new-password'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('new-password') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="new-password-confirm" class="col-md-4 control-label">Confirm New Password</label>

                                            <div class="col-md-6">
                                                <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-4">
                                                <button type="submit" class="btn btn-primary">
                                                    Change Password
                                                </button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                              </div>
                            </div>
                            <div class="card">
                              <div class="card-header" id="headingThree">
                                <h2 class="mb-0">
                                  <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Delete User
                                  </button>
                                </h2>
                              </div>
                              <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                <div class="card-body">
                                    <form class="form-horizontal" method="POST" action="{{ route('deleteUser') }}">
                                        {{ csrf_field() }}
                                        <div class="form-group{{ $errors->has('password_delete') ? ' has-error' : '' }}">
                                            <label for="password_delete" class="col-md-4 control-label">Current Password</label>

                                            <div class="col-md-6">
                                                <input id="password_delete" type="password" class="form-control" name="password_delete" required>

                                                @if ($errors->has('password_delete'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('password_delete') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="password_confirm_de" class="col-md-4 control-label">Confirm Current Password</label>

                                            <div class="col-md-6">
                                                <input id="password_confirm_de" type="password" class="form-control" name="password_confirm_de" required>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-4">
                                                <button type="submit" class="btn btn-danger" >
                                                    Delete User
                                                </button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                              </div>
                            </div>
                          </div>





                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@extends('Defaults.Views.layouts.master')

@section('title','Create User')

@section('content')
<div class="row">
    <div class="col-sm-12">

        {!! Form::open(['route' => ['administration.users.store'] , 'files'=> true]) !!}

        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">User Information</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-4">
                                {!! Form::textField('email', 'Email') !!}
                            </div>
                            <div class="col-sm-4">
                                {!! Form::textField('last_name', 'Last Name') !!}
                            </div>
                            <div class="col-sm-4">
                                {!! Form::textField('first_name', 'First Name') !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                {!! Form::passwordField('password', 'Password') !!}
                            </div>
                            <div class="col-sm-4">
                                {!! Form::passwordField("password_confirmation", 'Confirm') !!}
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button class="btn btn-primary">Save Changes</button>
                        <a href="{{ URL::route('administration.users.index') }}" class="btn btn-default">Cancel</a>
                    </div>
                </div>
            </div>
        </div>

       {!! Form::close() !!}

    </div><!-- /.col-sm-12 -->
</div><!-- /.row -->
@endsection
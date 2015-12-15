@extends('Defaults.Views.layouts.master')

@section('title','Edit User')

@section('content')
<div class="row">
    <div class="col-sm-12">

        {!! Form::model($user, ['route' => ['administration.users.update', $user->id], 'method' => 'PUT', 'files'=> true]) !!}
        
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
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <a href="{{ URL::route('administration.users.index') }}" class="btn btn-default">Cancel</a>
                        <button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#deleteModal">Delete Record</button>
                    </div>
                </div>
            </div>
        </div>

       {!! Form::close() !!}

    </div><!-- /.col-sm-12 -->
</div><!-- /.row -->
@include('Defaults.Views.partials.modals.delete')
@endsection
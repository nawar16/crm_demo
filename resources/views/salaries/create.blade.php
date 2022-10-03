@extends('layouts.master')
@section('content')

        <form action="{{route('salaries.store')}}" method="POST">
            <div class="tablet">
                <div class="tablet__body">
                    <div class="row">
                        @if($users)
                            <div class="col-lg-4">
                                @lang("For which user are you adding salary?")
                            </div>
                            <div class="col-lg-8">
                                <select name="user_external_id"
                                        class="form-control"
                                        id="user-search-select" data-live-search="true"
                                        data-style="btn dropdown-toggle btn-light"
                                        data-container="body"
                                        data-dropup-auto="false"
                                        required>
                                    <option disabled selected value> -- @lang('Select an option') -- </option>
                                    @foreach($users as $key => $user)
                                        <option data-tokens="{{$user}}" value="{{$key}}">{{$user}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <hr style="margin-top:4em;">
                            <div class="col-lg-4">
                                @lang("Salary value")
                            </div>
                            <div class="col-lg-8">
                            <input type="number" name="salary" id="salary" class="form-control">
                            </div>
                            <hr style="margin-top:4em;">

                            <div class="col-lg-4">
                                @lang("Month")
                            </div>
                            <div class="col-lg-8">
                            <input type="number" name="month" id="month" class="form-control">
                            </div>
                            <hr style="margin-top:4em;">
                        @endif
                    </div>
                </div>
                <div class="tablet__footer">
                    <input type="submit" class="btn btn-md btn-brand"  value="{{__('Save')}}" style="margin:1em;">
                </div>
            </div>
            {{csrf_field()}}
        </form>


@stop



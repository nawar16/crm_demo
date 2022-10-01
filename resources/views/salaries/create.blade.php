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

                            
                        @endif
                    </div>
                </div>
                <div class="tablet__footer">
                    <input type="submit" class="btn btn-md btn-brand" id="createTask" value="{{__('Confirm')}}" style="margin:1em;">
                </div>
            </div>
            {{csrf_field()}}
        </form>


@stop

@push('scripts')
    <script>
        $('#user-search-select').selectpicker();
        $endDateInput = $('#end_date').pickadate({
            hiddenName:true,
            format: "{{frontendDate()}}",
            formatSubmit: 'yyyy/mm/dd',
            min: true,
            clear: false,
        });

        let endDatePicker = $endDateInput.pickadate('picker')

        $startDateInput = $('#start_date').pickadate({
            hiddenName:true,
            format: "{{frontendDate()}}",
            formatSubmit: 'yyyy/mm/dd',
            clear: false,
            style: "background:#fff",
            onSet: function(context) {
                let minDate = new Date(context.select)
                if(minDate > new Date(endDatePicker.get('select', 'yyyy/mm/dd'))) {
                    endDatePicker.set('select', minDate)
                }
                endDatePicker.set('min', minDate)
            }
        });
        let startDatePicker = $startDateInput.pickadate('picker')

        $('#reason').change(function() {
            if ($(this).val() === 'sick_leave') {
                $("#medical-certificate").show();
            } else {
                $("#medical-certificate").hide();
            }
        });
    </script>
@endpush


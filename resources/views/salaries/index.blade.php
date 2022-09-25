@extends('layouts.master')
@section('content')

<select class="table-status-input">
    @foreach($users as $user)
    <option value="{{$user->id}}">{{$user->name}}</option>
    @endforeach
</select>
@stop

@push('scripts')
  
    <script>
        $(function () {
            $('#absence-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('absence.data') !!}',
                language: {
                    url: '{{ asset('lang/' . (in_array(\Lang::locale(), ['dk', 'en']) ? \Lang::locale() : 'en') . '/datatable.json') }}'
                },
                name:'search',
                drawCallback: function() {
                    var length_select = $(".dataTables_length");
                    var select = $(".dataTables_length").find("select");
                    select.addClass("tablet__select");
                },
                autoWidth: false,
                columns: [
                    {data: 'user_id', name: 'user_id', orderable: false, searchable: false,},
                    {data: 'start_at', name: 'start_at'},
                    {data: 'end_at', name: 'end_at'},
                    {data: 'reason', name: 'reason'},
                    @if(Entrust::can('absence-manage'))
                    { data: 'delete', name: 'delete', orderable: false, searchable: false, class:'fit-action-delete-th table-actions'},
                    @endif

                ]
            });

        });
        </script>

@endpush


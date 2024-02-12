<div class="table-responsive">
    <table id="example" class="table text-md-nowrap">
        <thead>
            <tr>

                <th class="border-bottom-0">اسم الخبير</th>
                <th class="border-bottom-0">النقاط</th>

                <th class="border-bottom-0">{{ __('general.action') }}</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($selectedexperts as $selectedexpert)
                <tr>

                    <td>{{ $selectedexpert->expert->first_name . ' ' . $selectedexpert->expert->last_name }}
                    </td>
                    <td>{{ $selectedexpert->points }}</td>

                    <td>
                        <a href="" class="btn btn-success btn-sm"
                            title="{{ __('general.edit') }}"><i class="fa fa-edit"></i></a>

                        <form action="{{ url('admin/service/expert/deleteselected', $selectedexpert->id) }}" method="POST" class="d-inline" name="delete_expert_form" id="delete_expert_form">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm btn-delete-expert"
                            id="expert-{{ $selectedexpert->expert->id }}"><i
                                class="fa fa-trash"></i></button>
                        </form>

                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>



    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>




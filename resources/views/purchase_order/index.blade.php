@extends('layouts.index')
@section('title')
    Purchase Orders
@endsection


@section('content')
    <div class="col">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('po.create') }}" class="btn btn-primary">
                    <span class="left badge"><i class="fas fa-plus-square"></i></span> Purchase Order
                </a>
            </div>
            <div class="card-body">
                <table id="po-table" class="table table-striped">
                    <thead>
                        <th class="text-center">No</th>
                        <th>Number</th>
                        <th class="text-center">Status</th>
                        <th>PO Date</th>
                        <th>Payment</th>
                        <th>Amount</th>
                        <th>Vendor</th>
                        <th>Email</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            const editRoute = "{{ route('po.edit', ':id') }}";
            const deleteRoute = "{{ route('po.destroy', ':id') }}";
            const approveRoute = "{{ route('gr.create', ':id') }}";
            const showRoute = "{{ route('po.show', ':id') }}";

            $('#po-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('po.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        className: 'text-center'
                    },
                    {
                        data: 'po_number',
                        name: 'po_number'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        className: 'text-center',
                        render: function(data, type, row) {
                            let badgeClass = '';
                            let statusText = '';

                            switch (data) {
                                case 'draft':
                                    badgeClass = 'badge bg-warning text-dark';
                                    statusText = 'Draft';
                                    break;
                                case 'approved':
                                    badgeClass = 'badge bg-success';
                                    statusText = 'Approved';
                                    break;
                                case 'canceled':
                                    badgeClass = 'badge bg-danger';
                                    statusText = 'Canceled';
                                    break;
                                default:
                                    badgeClass = 'badge bg-secondary';
                                    statusText = 'Unknown';
                            }

                            return `<span class="${badgeClass}">${statusText}</span>`;
                        }
                    },
                    {
                        data: 'po_date',
                        name: 'po_date'
                    },
                    {
                        data: 'payment_term',
                        name: 'payment_term'
                    },
                    {
                        data: 'total',
                        name: 'total'
                    },
                    {
                        data: 'partner.name',
                        name: 'partner.name'
                    },
                    {
                        data: 'partner.email',
                        name: 'partner.email'
                    },
                    {
                        data: 'encrypted_id',
                        name: 'encrypted_id',
                        orderable: false,
                        searchable: false,
                        className: 'text-center',
                        render: function(data, type, row) {
                            var editUrl = editRoute.replace(':id', data);
                            var deleteUrl = deleteRoute.replace(':id', data);
                            var approveUrl = approveRoute.replace(':id', data);
                            var showUrl = showRoute.replace(':id', data);

                            var approveButton = row.status === 'approved' ? `<a href="${approveUrl}" class="dropdown-item">Good Receipt</a>` : '';
                            var showButton = `<a href="${showUrl}" class="dropdown-item">Show</a>`
                            var editButton = row.has_transaction ? '' :
                                `<a class="dropdown-item" href="${editUrl}">Edit</a>`;
                            var deleteButton = row.has_transaction ? '' : `
                                    <form action="${deleteUrl}" method="post" onsubmit="return confirm('Are you sure you want to delete this item?');" style="display:inline;">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="dropdown-item bg-danger">Delete</button>
                                    </form>`;

                            return `
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton${data}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton${data}">           
                                    ${editButton}
                                    ${showButton}    
                                    <div class="dropdown-divider"></div>
                                    ${approveButton}
                                    ${deleteButton}
                                </div>
                            </div>`;
                        }
                    }
                ],
                autoWidth: false,
                responsive: true,
                paging: true,
                lengthChange: false,
                searching: true,
                ordering: true,
                info: true
            });
        });
    </script>
@endsection

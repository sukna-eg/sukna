<x-admin-layouts.admin-app>
    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body">
        <!-- row -->
        <div class="page-titles">
            <ol class="breadcrumb">
                <li>
                    <h5 class="bc-title">{{ __('Users') }}</h5>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">
                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M2.125 6.375L8.5 1.41667L14.875 6.375V14.1667C14.875 14.5424 14.7257 14.9027 14.4601 15.1684C14.1944 15.4341 13.8341 15.5833 13.4583 15.5833H3.54167C3.16594 15.5833 2.80561 15.4341 2.53993 15.1684C2.27426 14.9027 2.125 14.5424 2.125 14.1667V6.375Z"
                                stroke="#2C2C2C" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M6.375 15.5833V8.5H10.625V15.5833" stroke="#2C2C2C" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        Home </a>
                </li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ __('Users') }} </a></li>
            </ol>
            <a class="text-primary fs-13" href="{{ route('admin.users.create') }}">+ Add User</a>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="offcanvas-body">
                                <div class="container-fluid">
                                    <x-admin-layouts.alerts />
                                    <div class="table-responsive active-projects manage-client">
                                        <div class="tbl-caption">
                                            <h4 class="heading mb-0"> {{ __('Users') }}</h4>
                                        </div>
                                        <div class="tab-content" id="myTabContent">
											<div class="tab-pane fade show active" id="Preview" role="tabpanel" aria-labelledby="home-tab">
											 <div class="card-body pt-0">
												<div class="table-responsive">
													<table id="example" class="display table" style="min-width: 845px">
                                                        <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Name</th>
                                                    {{-- <th>Email</th> --}}
                                                    <th>Phone</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Properties Count</th>
                                                    <th>First Month</th>
                                                    <th>Second Month</th>
                                                    <th>Third Month</th>
                                                    <th>Total Price</th>
                                                    <th>Paids</th>


                                                    {{-- <th>actions</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($users as $user)
                                                    <tr>

                                                        <td><span>{{ $user->id }}</span></td>
                                                        <td><span>{{ $user->name }}</span></td>
                                                        {{-- <td><span>{{ $user->email }}</span></td> --}}
                                                        <td>
                                                            <span>{{ $user->phone }}</span>
                                                        </td>
                                                        <td>
                                                            <span>{{ $user->subscriptions?->last()->start_date }}</span>
                                                        </td>
                                                        <td>
                                                            <span>{{ $user->subscriptions?->last()->end_date }}</span>
                                                        </td>
                                                        <td>
                                                            <span>{{ $user->properties_count }}</span>
                                                        </td>

                                                        <td>
                                                            <span>{{ $user->subscriptions?->last()->first_month == 1? 'Paid' : 'Not Paid' }}</span>
                                                        </td>

                                                        <td>
                                                            <span>{{ $user->subscriptions?->last()->second_month == 1? 'Paid' : 'Not Paid' }}</span>
                                                        </td>

                                                        <td>
                                                            <span>{{ $user->subscriptions?->last()->third_month == 1? 'Paid' : 'Not Paid' }}</span>
                                                        </td>
                                                        <td>
                                                            <span>{{ $user->subscriptions?->last()->total }}</span>
                                                        </td>

                                                        <td>
                                                            <span>{{ $user->subscriptions?->last()->paids }}</span>
                                                        </td>




                                                    </tr>

                                                @empty
                                                    <tr>
                                                        <th colspan="5">
                                                            <h5 class="text-center">There is No data</h5>
                                                        </th>
                                                    </tr>
                                                @endforelse

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="9">Sum:</th>

                                                        @php
                                                        $sumPaid = 0;
                                                        $sumTotal = 0;
                                                        foreach ($users as $user) {
                                                            $sumPaid += $user->subscriptions?->last()->paids;
                                                            $sumTotal += $user->subscriptions?->last()->total;
                                                        }

                                                        @endphp

                                                    <th>{{$sumTotal }}</th>
                                                    <th>{{$sumPaid}}</th>
                                                </tr>
                                            </tfoot>

                                        </table>
                                                </div>
                                             </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--**********************************
            Content body end
        ***********************************-->
<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Delete User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('admin.users.destroy','test') }}" method="post">
            {{ method_field('delete') }}
            @csrf
            <div class="modal-body">
                <p>Are you sure to delete?</p><br>
                <input type="hidden" name="id" id="id" value="">
                <input class="form-control" name="name" id="name" type="text" readonly>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                <button type="submit" class="btn btn-danger">Confirm</button>
            </div>
    </div>
    </form>
      </div>
    </div>
  </div>



  @push('javasc')
<script>
    $('#deleteModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var name = button.data('name')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #name').val(name);
    })
</script>
@endpush
</x-admin-layouts.admin-app>

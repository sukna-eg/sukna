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

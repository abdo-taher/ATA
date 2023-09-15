
    @foreach($data as $info )
        <tr class="align-items-center">
            <td><span class="badge badge-success float-left">{{$info->discount_rate->discount_rate}}%</span>{{$info->bill_code}}</td>
            <td>{{$info->bill_date}}</td>
            <td>{{$info->added->name}}</td>
            <td>{{$info->due_date}}</td>
            <td>{{$info->section->section_name}}</td>
            <td>{{$info->product->product_name}}</td>
            <td>{{$info->mount_collection}}</td>
            <td >
                <span class="
                        @if($info->status->id == 2)
                    badge badge-danger
                    @elseif($info->status->id == 1)
                    badge badge-success
                    @else
                    badge badge-secondary
                    @endif
                    ">{{$info->status->status_name}}
                </span>
        </tr>
        @endforeach



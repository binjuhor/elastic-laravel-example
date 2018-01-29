@if($data)
@foreach ($data as $item)
 <tr id="themeid-{{$item['_source']['id']}}">
    <td><a href="{{ action('ItemsController@edit', [$item['_source']['id']]) }}">{{ $item['_source']['name'] }}</a></td>
    <td>{{ $item['_source']['author'] }}</td>
    <td>Cat name</td>
    {{-- <td>61</td>
    <td>99</td> --}}
    <td class="text-right">
        <a href="#" class="btn btn-simple btn-info btn-icon like"><i class="fa fa-heart"></i></a>
        <a href="/items/edit/{{$item['_source']['id']}}" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>
        <a href="#" data-id="{{$item['_source']['id']}}" class="btn btn-simple btn-danger btn-icon remove"><i class="fa fa-times"></i></a>
    </td>
</tr>
@endforeach
@endif
@if(!$data)
<tr class="odd"><td valign="top" colspan="4" class="dataTables_empty">No data available in table</td></tr>
@endif
@php
    $dataSearchRequest = request()->toArray();
    $url = request()->root() .'/'. request()->path();
    if(isset($dataSearchRequest['raw']))
        unset($dataSearchRequest['raw']);
    $queryString = http_build_query($dataSearchRequest);

@endphp
<tr class="footable-paging">
    <td colspan="{{$column}}">
        <div class="w-100">
            <ul class="float-right p-t-5">
                {{$datas->appends($dataSearchRequest)->onEachSide(1)->links()}}
            </ul>
            <ul class="pagination float-left p-t-5">
                <p class="p-r-5 color-select-page">Hiển thị</p>
            </ul>
            <ul class="pagination float-left p-t-5">
                <select class="number_raw" onchange="window.location.href = $(this).val()">
                    @foreach(list_number_page() as $key => $value)
                        @if($value == $datas->perPage())
                            <option selected="selected" value="{{$url.'?'.$queryString.'&raw='.$value}}">{{$value}}</option>
                        @else
                            <option value="{{$url.'?'.$queryString.'&raw='.$value}}">{{$value}}</option>
                        @endif
                    @endforeach
                </select>
            </ul>
            <ul class="pagination float-left p-t-5">
                <p class="p-l-5 color-select-page"> / <strong>{{$datas->total()}}</strong> bản ghi</p>
            </ul>
        </div>
    </td>
</tr>

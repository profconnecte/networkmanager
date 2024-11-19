@foreach($tab as $key => $element)
                    <tr>
                        <td class="text-center">{{htmlspecialchars($loop->iteration)}}</td>
                        <td>{{ $key }}</td>
                        <td>{{ $element }}</td>
                        <td class="td-actions text-left">
                            <a href="{{ route('dns.edit' , ['data' => $key.'--'.$element.'--'.$type])}}" class="btn btn-success btn-round">
                                <i class="material-icons">edit</i>
                            </a>
                            <a href="{{ route('dns.delete' , ['name' => $key.'--'.$element.'--'.$type])}}"class="btn btn-danger btn-round">
                                <i class="material-icons">close</i>
                            </a>
                        </td>
                    </tr>
@endforeach
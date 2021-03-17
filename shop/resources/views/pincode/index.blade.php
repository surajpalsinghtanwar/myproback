@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('pincodes.create')}}" class="btn btn-rounded btn-info pull-right">{{translate('Add New pincode')}}</a>
    </div>
</div>
<br>

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{translate('Pincode')}}</h3>
        <div class="pull-right clearfix">
            <form class="" id="sort_categories" action="" method="GET">
                <div class="box-inline pad-rgt pull-left">
                    <div class="" style="min-width: 200px;">
                        <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type name & Enter') }}">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{translate('usertype')}}</th>
                    <th>{{translate('pincode')}}</th>
                    <th>{{translate('amount')}}</th>
                    <th>{{translate('status')}}</th>
                    <th width="10%">{{translate('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pincode as $key => $pincodes)
                    <tr>
                        <td>{{ ($key+1) + ($pincode->currentPage() - 1)*$pincode->perPage() }}</td>                    
                        <td> @if($pincodes->usertype==1){{('preuser')}}@else{{'primeuser'}}@endif</td>  
                             
                        </td>
                                <td>{{__($pincodes->pincode)}}</td>  
                                <td>{{__($pincodes->amount)}}</td>                      
                        <td><label class="switch">
                            <input onchange="update_status(this)" value="{{ $pincodes->id }}" type="checkbox" <?php if($pincodes->status == 1) echo "checked";?> >
                            <span class="slider round"></span></label></td>
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{translate('Actions')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{route('pincodes.edit', $pincodes->id)}}">{{translate('Edit')}}</a></li>
                                    <li><a onclick="confirm_modal('{{route('pincodes.destroy', $pincodes->id)}}');">{{translate('Delete')}}</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix">
            <div class="pull-right">
                {{ $pincode->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script type="text/javascript">
        function update_status(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }           
            $.post('{{ route('pincodes.status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){         
                if(data == 1){
                    showAlert('success', 'status updated successfully');
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }
    </script>
@endsection 

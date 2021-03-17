 
 @extends('layouts.app')
@section('content')

<div class="col-lg-6 col-lg-offset-3">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{translate('Pincode Information')}}</h3>
        </div>

        <!--Horizontal Form-->
        <!--===================================================-->
        <form class="form-horizontal" action="{{ route('pincodes.update',$pincode->id) }}" method="POST" enctype="multipart/form-data">
        	@csrf
        	@METHOD('PUT');
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{translate('pincode')}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="{{translate('pincode')}}" id="pincode" name="pincode" class="form-control" required="" value="{{$pincode->pincode}}">
  
                    </div>

                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{translate('User Type')}}</label>
                    <div class="col-sm-10">
                        <select name="usertype" required class="form-control demo-select2-placeholder">                         
                            <option value="1" <?php if($pincode->usertype='1'){echo 'selected'; }?>>Preuser</option>
                             <option value="2" <?php if($pincode->usertype='2'){echo 'selected'; }?>>Primeuser</option>
                        </select>
                    </div>
                    <p style="color:red;">@error('usertype'){{$message}}@enderror</p>
                </div>               
                <div class="form-group">
                    <label class="col-sm-2 control-label">{{translate('amount')}}</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="amount" placeholder="{{translate('amount')}}" required="" value="{{$pincode->amount}}">
                    </div>
                </div>                
            </div>
            <div class="panel-footer text-right">
                <button class="btn btn-purple" type="submit">{{translate('Save')}}</button>
            </div>
        </form>
        <!--===================================================-->
        <!--End Horizontal Form-->

    </div>
</div>

@endsection

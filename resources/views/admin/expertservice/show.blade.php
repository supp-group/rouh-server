@foreach ($selectedexperts as $selectedexpert)                                  
<form class="form-horizontal delete-expert-form" name="delete_expert_form"
action="{{ url('admin/service/expert/deleteselected', $selectedexpert->id) }}" method="POST"
id="delete_expert_form">
@csrf
<div class="mb-2">
    <div class="mb-3">
        <div class="service-field row">
            <div class="col-8">
                <p>{{ $selectedexpert->expert->first_name." ".$selectedexpert->expert->last_name }}</p>
            </div>   
                      <div class="col-4">
                <div class="form-horizontal d-inline-block">
                    <div class="form-group">
                        <button type="submit" class="btn ripple btn-danger btn-delete-expert"
                            id="expert-{{ $selectedexpert->expert->id }}"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endforeach



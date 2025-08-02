@if(session('success'))
<div class="alert alert-success alert-dismissible mb-2 auto-dismiss" role="alert">
    {{ session('success') }}
    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
</div>
@elseif(session('error'))
<div class="alert alert-danger alert-dismissible mb-2 auto-dismiss" role="alert">
    {{ session('error') }}
    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
</div>
@elseif($errors->has('deposit_amount'))
<div class="alert alert-danger alert-dismissible mb-2 auto-dismiss" role="alert">
    {{ $errors->first('deposit_amount') }}
    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
</div>
@elseif(isset($response['status']) && $response['status'] == false)
<div class="alert alert-danger alert-dismissible mb-2 auto-dismiss" role="alert">
    {{ $response['message'] }}
    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
</div>
@elseif(isset($response['status']) && $response['status'] == true)
<div class="alert alert-success alert-dismissible mb-2 auto-dismiss" role="alert">
    {{ $response['message'] }}
    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
</div>
@endif
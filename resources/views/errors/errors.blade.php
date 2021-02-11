@if ($errors->any())
<div class="alert alert-danger alert-validation-msg mx-1" role="alert">
  <h3 class="alert-heading"><strong><i style="font-size: 1.5rem;" class="feather icon-info"></i>&nbsp;&nbsp;Erreur</strong></h4>
  <div class="alert-body">
    @foreach ($errors->all() as $error)
      {{ $error }}
      @if(!$loop->last)
        <br>
      @endif
    @endforeach
  </div>
</div>

@endif
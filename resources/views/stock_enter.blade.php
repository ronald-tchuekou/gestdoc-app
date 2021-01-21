<?php
if($stock->id)
    $options = ['method' => 'put', 'action' => ['StockEnterController@update', $stock]];
else
    $options = ['method' => 'post', 'action' => ['StockEnterController@store', $stock]];
?>

<dic class="card-body" style="height: auto;">

{{Form::model($stock, $options)}}

<div class="item-title">
    <h3> Ajout d'un nouveau stock </h3>
</div>
<div class="card-body">
<div class="row">
    <div class=" col-xl-4 col-md-6 col-12 form-group">
        {{ Form::label('enter_id', 'N° Entré')}}
        {{ Form::text('enter_id', null, ['class' => 'select2 form-control', 'placeholder' => 'N° Entré...'])}}
    </div>
    <div class=" col-xl-4 col-md-6 col-12 form-group">
        {{ Form::label('fournisseur', 'Fournisseur')}}
        {{ Form::select('fournisseur', [2 => 'toto', 1 => 'tata'], null, ['class' => 'select2 form-control', 'placeholder' => 'Fournisseur...'])}}
    </div>
    <div class=" col-xl-4 col-md-6 col-12 form-group">
        {{ Form::label('magasin_id_o', "Magasin d'origine")}}
        {{ Form::select('magasin_id_o', [2 => 'toto', 1 => 'tata'], null, ['class' => 'select2 form-control', 'placeholder' => "Magasin d'origine..."])}}
    </div>
</div>

<div class="row">
    <div class="col-xl-6">
        <div class="form-group">
            {{Form::label('date', 'Date')}}
            {{Form::date('date', null, ['class' => 'form-control'])}}
        </div>
    </div>
    <div class="col-xl-3">
        <div class="form-group">
            {{Form::label('enter_motif_id', "Motif d'entré")}}
            {{Form::text('enter_motif_id', null, ['class' => 'form-control'])}}
        </div>
    </div>
</div>

<hr class="devider"/>

<div class="row">
    <div class=" col-xl-3 col-md-6 col-12 form-group">
        {{ Form::label('designation', 'Designation')}}
        {{ Form::select('designation', [1 => "Première entrée",
        2 => "Dexième entrée"], null, ['class' => 'select2 form-control', 'placeholder' => 'Designation...'])}}
    </div>
    <div class=" col-xl-2 col-md-6 col-12 form-group">
        {{ Form::label('sal_prise', "Prix d'achat")}}
        {{ Form::number('sal_prise', null, ['class' => 'form-control', 'placeholder' => "Prix d'achat..."])}}
    </div>
    <div class=" col-xl-2 col-md-6 col-12 form-group">
        {{ Form::label('qte_enter', "Quantité")}}
        {{ Form::number('qte_enter', null, ['class' => 'form-control', 'placeholder' => "Quantité..."])}}
    </div>
    <div class=" col-xl-3 col-md-6 col-12 form-group">
        {{ Form::label('magasin_id_d', "Magasin destination")}}
        {{ Form::select('magasin_id_d', [1 => "Première entrée",
        2 => "Dexième entrée"], null, ['class' => 'select2 form-control', 'placeholder' => "Magasin destination..."])}}
    </div>
    <div class=" col-xl-2 col-md-6 col-12 form-group">
    <button type="submit" id="add_designation" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">
        Ajouter
    </button>
    </div>
</div>

<div class="table-responsive">
    <table class="table display data-table text-nowrap" id="table_designation">
        <thead>
        <tr>
            <th>Designation</th>
            <th>Prix d'achat</th>
            <th>Qté Entrée</th>
            <th>Magasin destination</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

</div>

<div class="col-12 form-group mg-t-8">
    <button id="btn_save_stock" type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">
        Enregistrer
    </button>
    <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">
        Reset
    </button>
</div>
{{Form::close()}}

</div>
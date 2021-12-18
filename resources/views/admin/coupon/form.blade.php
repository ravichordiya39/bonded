<div class="row">
  <div class="col-md-8">
  		<div class="form-group{{ $errors->has('coupon_label') ? ' has-error' : ''}}">
	    	{!! Form::label('coupon_label', 'Coupon Label', ['class' => 'bmd-label-floating']) !!}
		      <select name="coupon_label" class="form-control selectpicker sub-category" data-style="select-with-transition">
			    <option value="all_user">All Users</option>
			    <option value="existing_user">Existing Users</option>
			    <option value="new_user">New User</option>
			  </select>
		    {!! $errors->first('coupon_label', '<p class="help-block">:message</p>') !!}
		</div>
		<div class="form-group{{ $errors->has('name') ? ' has-error' : ''}}">
		    {!! Form::label('name', 'Coupon Name: (Required)', ['class' => 'bmd-label-floating']) !!}
		    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required','placeholder' => 'Coupon Name']) !!}
		    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
		</div>
		<div class="form-group{{ $errors->has('code') ? ' has-error' : ''}}">
		    {!! Form::label('code', 'Coupon Code: (Required)', ['class' => 'bmd-label-floating']) !!}
		    {!! Form::text('code', null, ['class' => 'form-control', 'rows' => '3', 'required' => 'required','placeholder' => 'Coupon Code']) !!}
		    {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
		</div>
		<div class="row">
		  <div class="col-md-6">
		    <div class="form-group{{ $errors->has('type') ? ' has-error' : ''}}">
		    	{!! Form::label('type', 'Select Type', ['class' => 'bmd-label-floating']) !!}
			      <select name="type" class="form-control selectpicker sub-category" data-style="select-with-transition">
				    <option value="%">% (Percentage)</option>
				    <option value="value">Value (Amount)</option>
				  </select>
			    {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
			</div>
		  </div>
		  <div class="col-md-6">
		        <div class="form-group{{ $errors->has('per_amt') ? ' has-error' : ''}}">
				    {!! Form::label('per_amt', 'Percentage(%) Or Amount : (Required)', ['class' => 'bmd-label-floating']) !!}
				    {!! Form::number('per_amt', null, ['class' => 'form-control', 'rows' => '2', 'required' => 'required','placeholder' => 'Percentage Or Amount [% Or ₹]']) !!}
				    {!! $errors->first('per_amt', '<p class="help-block">:message</p>') !!}
				</div>
		  </div>
		</div>
		<div class="form-group{{ $errors->has('stock_value') ? ' has-error' : ''}}">
		    {!! Form::label('stock_value', 'Stock Value(Minimum Value)', ['class' => 'bmd-label-floating']) !!}
		    {!! Form::text('stock_value', null, ['class' => 'form-control','placeholder' => 'Stock Value']) !!}
		    {!! $errors->first('stock_value', '<p class="help-block">:message</p>') !!}
		</div>
		<div class="form-group{{ $errors->has('coupon_count') ? ' has-error' : ''}}">
		    {!! Form::label('coupon_count', 'How Many Time User', ['class' => 'bmd-label-floating']) !!}
		    {!! Form::number('coupon_count', null, ['class' => 'form-control','placeholder' => '1, 2, 3, 4, 5']) !!}
		    <p>If All time, Leave Empty?</p>
		    {!! $errors->first('coupon_count', '<p class="help-block">:message</p>') !!}
		</div>
		<div class="form-group{{ $errors->has('description') ? ' has-error' : ''}}">
		    {!! Form::label('description', 'Description', ['class' => 'bmd-label-floating']) !!}
		    {!! Form::textarea('description', null, ['class' => 'form-control' , 'rows' => '2', 'placeholder' => 'Description']) !!}
		    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
		</div>
		<div class="form-group {{ $errors->has('end_date') ? ' has-error' : ''}}">
        {!! Form::label('Expiry Date', 'Expiry Date', ['class' => 'bmd-label-floating']) !!}
        {!! Form::date('end_date', null, ['class' => 'form-control','placeholder' => 'Expiry Date']) !!}
    </div>
	
  </div> 
</div>

<div class="border-top">
    <div class="form-group card-body">
      {!! Form::submit($formMode === 'edit' ? 'Update' : 'Save', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
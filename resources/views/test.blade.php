@php
    $records = [60, 70, 80];
@endphp
@if (count($records) == 1)
    <div>I have one record! </div>
@elseif (count($records) > 1)
    <div>I have multiple records!</div>
@else
    <div>I don't have any records!</div>
@endif


<?php
$records = [60, 70, 80];
?>
<?php if (count($records) == 1) { ?>
<div>I have one record! </div>
<?php }elseif (count($records) > 1) { ?>
<div>I have multiple records!</div>
<?php }else{ ?>
<div>I don't have any records!</div>
<?php } ?>

@php
    $record1 = 'Chavalit';
    $record2 = '';
    $record3 = null;
@endphp

@isset($record1)
    $record1 is defined and is not null... <br>
@endisset

@empty($record2)
    $record2 is "empty" with empty string <br>
@endempty

@empty($record3)
    $record3 is "empty" with null <br>
@endempty

@switch($i)
    @case(1)
        //do First case...
    @break

    @case(2)
        //do Second case...
    @break

    @case('helloworld')
        //do String case...
    @break

    @default
        //Default case...
@endswitch

@switch($order_status)
    @case(1)
        <span class="badge badge-pill badge-primary" title="รอเบิกสินค้า">Y</span>
    @break

    @case(2)
        <span class="badge badge-pill badge-warning" title="รอเปิด Invoice">W</span>
    @break

    @case(3)
        <span class="badge badge-pill badge-success" title="Invoice แล้ว">IV</span>
    @break
@endswitch

@php
    // Caculation + Print
	$a = 5 + 6;
	echo $a;
@endphp


<?php
   	// Caculation + Print
	$a = 5 + 6;
	echo $a;
?>

<form action="{{ route('form.submit') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name:</label>
        <input type="text" name="name" id="name" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<form action="/submit-form" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name:</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name">
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email">
    </div>

    <div class="mb-3">
        <label for="gender" class="form-label">Gender:</label>
        <select name="gender" id="gender" class="form-select">
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Submit</button>
</form>


<form action="/search" method="GET">
    <input type="text" name="query" placeholder="Search">
    <button type="submit">Search</button>
</form>
<form action="/submit-form" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Enter your name">
    <button type="submit">Submit</button>
</form>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<input type="text" name="name" value="{{ old('name') }}">
@if ($errors->has('name'))
    <span class="text-danger">{{ $errors->first('name') }}</span>
@endif

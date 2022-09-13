@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <form method="get">
                <div class="row">
                    <div class="col-4 form-group">
                        <label class="control-label" for="y">{{ trans('global.year') }}</label>
                        <select name="y" id="y" class="form-control">
                            @foreach(array_combine(range(date("Y"), 1900), range(date("Y"), 1900)) as $year)
                                <option value="{{ $year }}" @if($year===old('y', Request::get('y', date('Y')))) selected @endif>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4 form-group">
                        <label class="control-label" for="m">{{ trans('global.month') }}</label>
                        <select name="m" for="m" class="form-control">
                            @foreach(cal_info(0)['months'] as $month)
                                <option value="{{ $month }}" @if($month===old('m', Request::get('m', date('m')))) selected @endif>
                                    {{ $month }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <label class="control-label">&nbsp;</label><br>
                        <button class="btn btn-primary" type="submit">{{ trans('global.filterDate') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <div class="card-header">
            Stock Report
            </div>
            <table class="table table-bordered">
                <tr>
                    <th>Asset Name</th>
                    <th>Quantity</th>
                </tr>
                <tbody>
                    @foreach($stocks as $key => $stock)
                        <tr>
                            <td>
                                {{ $stock->asset->name ?? '' }}
                            </td>
                            <td>
                                {{ $stock->current_stock ?? '' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.min.js"></script>
<script>
    $('.date').datepicker({
        autoclose: true,
        dateFormat: "{{ config('panel.date_format_js') }}"
      })
</script>
@endsection

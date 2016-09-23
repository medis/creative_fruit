@extends('layouts.app')

@section('content')
    @if (!empty($skills))
        <form action="{{ route('admin_skills_store') }}" method="post" class="inner-container">
            <input type="hidden" class="token" name="_token" value="{{ csrf_token() }}">
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Text</th>
                        <th>Percent</th>
                        <th>Colours</th>
                        <th>Preview</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($skills as $i => $skill)
                        <tr>
                            <td><i class="fa fa-hand-rock-o handle" aria-hidden="true"></i></td>
                            <td><button class="delete" name="delete"><i class="fa fa-minus-circle" aria-hidden="true"></i></button></td>
                            <td><input class="text" required="required" placeholder="Enter text" type="text" name="text[{{$i}}]" value="@if(!old('text[{{$i}}]')){{$skill->text}}@endif{{ old('text[{$i}]') }}" /></td>
                            <td><input class="percent" required="required" placeholder="Enter percent" type="number" step="1" name="percent[{{$i}}]" value="@if(!old('percent[{{$i}}]')){{$skill->percent}}@endif{{ old('percent[{$i}]') }}" /></td>
                            <td>
                                <label for="color-{{$i}}0">
                                    <input class="color-0" id="color-{{$i}}0" required="required" placeholder="Enter border colour" type="color" name="color[{{$i}}][0]" value="@if(!old('color[{$i}][0]')){{$skill->colors[0]}}@endif{{ old('color[{$i}][0]') }}" />
                                    Border colour
                                </label>
                                <label for="color-{{$i}}1">
                                    <input class="color-1" id="color-{{$i}}1" required="required" placeholder="Enter background colour" type="color" name="color[{{$i}}][1]" value="@if(!old('color[{$i}][1]')){{$skill->colors[1]}}@endif{{ old('color[{$i}][1]') }}" />
                                    Background colour
                                </label>
                            </td>
                        </tr>
                  @endforeach
                </tbody>
            </table>
            <button name="add-skill"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add skill</button>
            <input type="submit" name='update' class="button button-update" value="Update" />
        </form>
    @endif
@endsection

@section('assets')
  <script src="//code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
@endsection

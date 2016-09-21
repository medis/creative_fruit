@extends('layouts.app')

@section('content')
    @if (!empty($skills))
        <form action="{{ route('admin_skills_store') }}" method="post" class="inner-container">
            <input type="hidden" class="token" name="_token" value="{{ csrf_token() }}">
            <table>
                <thead>
                    <tr>
                        <th>Text</th>
                        <th>Percent</th>
                        <th>Colours</th>
                        <th>Preview</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($skills as $i => $skill)
                        <tr>
                            <td><input required="required" placeholder="Enter text" type="text" name="text[{{$i}}]" value="@if(!old('text[{{$i}}]')){{$skill->text}}@endif{{ old('text[{$i}]') }}" /></td>
                            <td><input required="required" placeholder="Enter percent" type="number" step="1" name="percent[{{$i}}]" value="@if(!old('percent[{{$i}}]')){{$skill->percent}}@endif{{ old('percent[{$i}]') }}" /></td>
                            <td>
                                <label for="color-{{$i}}0">
                                    <input id="color-{{$i}}0" required="required" placeholder="Enter border colour" type="color" name="color[{{$i}}][0]" value="@if(!old('color[{$i}][0]')){{$skill->colors[0]}}@endif{{ old('color[{$i}][0]') }}" />
                                    Border colour
                                </label>
                                <label for="color-{{$i}}1">
                                    <input id="color-{{$i}}1" required="required" placeholder="Enter background colour" type="color" name="color[{{$i}}][1]" value="@if(!old('color[{$i}][1]')){{$skill->colors[1]}}@endif{{ old('color[{$i}][1]') }}" />
                                    Background colour
                                </label>
                            </td>
                        </tr>
                  @endforeach
                </tbody>
            </table>
            <input type="submit" name='update' class="button button-update" value="Update" />
        </form>
    @endif
@endsection

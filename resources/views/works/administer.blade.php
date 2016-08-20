@if (!$works->count())
    <p>There are no works created.</p>
@else
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Published</th>
                <th>Last edited</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($works as $work)
            <tr>
                <td><a href="{{ $work->slug }}">{{ $work->title }}</a></td>
                <td>@if ($work->active == 1) { YES } @else { NO } @endif</td>
            </tr>
        @endforeach
        </tbody>
  </table>
@endif

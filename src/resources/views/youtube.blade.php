@if (count($youtube) > 0)
    <table class="table table-striped">
        <thead>
            <tr>
                <th>image</th>
                <th>title</th>
                <th>viewCount</th>
                <th>likeCount</th>
                <th>dislikeCount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($youtube as $youtube)
                <tr>
                    <td>
                        <iframe id="ytplayer" type="text/html" width="320" height="180" src={{ $youtube[0] }}
                            frameborder="0"></iframe>
                    </td>
                    <td>{{ $youtube[1]['title'] }}</td>
                    <td>{{ $youtube[2]['viewCount'] }}</td>
                    <td>{{ $youtube[2]['likeCount'] }}</td>
                    <td>{{ $youtube[2]['dislikeCount'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

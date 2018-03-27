<table class="table"><thead>
    <tr>
        <th>Nom</th>
        <th>Dernière modification</th>
        <th>En ligne</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
        @foreach($vhosts as $vhost)
            <tr>
                <td>{{ $vhost->name }}</td>
                <td>{{ $vhost->last_modified }}</td>
                <td>{{ $vhost->active ? "Oui" : "Non" }}</td>
                <td>
                    <a href="{{ route('websites.vhost', ['key' => $vhost->name]) }}">Voir</a>
                    <a href="{{ route('websites.vhost.edit', ['key' => $vhost->name]) }}">Modifier</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
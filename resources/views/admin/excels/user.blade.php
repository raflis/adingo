<table>
    <thead>
    <tr>
        <th><strong>N°</strong></th>
        <th><strong>Nombres</strong></th>
        <th><strong>Apellidos</strong></th>
        <th><strong>Empresa</strong></th>
        <th><strong>Email</strong></th>
        <th><strong>Fecha de registro</strong></th>
    </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td >{{ $loop->iteration }}</td>
                <td >{{ $user->name }}</td>
                <td >{{ $user->lastname }}</td>
                <td >{{ $user->company }}</td>
                <td >{{ $user->email }}</td>
                <td >{!! \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') !!}</td>
            </tr>
        @endforeach
    </tbody>
</table>
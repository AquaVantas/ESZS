<table>
    <thead>
        <tr>
            <th>Ime</th>
            <th>Priimek</th>
            <th>E-pošta</th>
            <th>Discord</th>
            <th>Uporabniško ime</th>
            <th>Dirkalnik</th>
            <th>Ekipa</th>
            <th>Zatopa</th>
            <th>Datum rojstva</th>
            <th>Poštna številka</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach(tournament::getPlayerDirtRally20($game['apply_end_time'], $game['apply_start_time']) as $application) { ?>
        <tr>
            <td><?= $application['player_name'] ?></td>
            <td><?= $application['surname'] ?></td>
            <td><?= $application['email'] ?></td>
            <td><?= $application['discord'] ?></td>
            <td><?= $application['race_username'] ?></td>
            <td><?= $application['racecar'] ?></td>
            <td><?= $application['team'] ?></td>
            <td><?= $application['raceteam'] ?></td>
            <td><?= $application['date_of_birth'] ?></td>
            <td><?= $application['postal_code'] ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>